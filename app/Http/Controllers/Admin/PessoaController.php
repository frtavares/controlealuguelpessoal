<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Pessoa;
use App\Http\Models\Occupation;

use App\Http\Middleware\UserStatus;

use DataTables;
use JetBrains\PhpStorm\Pure;
use Validator, Str, Config, Image;

class PessoaController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }


    // public function getPessoaAutocomplete( Request $request ) {
    //     $paises = Pessoa::select( "name" )
    //       ->where( "name", "LIKE", "%{$request->input('query')}%" )
    //       ->get();
    //     return response()->json($paises);
    //  }


    public function getHome($status){
        switch ($status) {
            case '0':
                $pessoas = Pessoa::with(['occs'])->where('status', '0')->orderBy('id', 'desc')->paginate(5);
                break;
            case '1':
                $pessoas = Pessoa::with(['occs'])->where('status', '1')->orderBy('id', 'desc')->paginate(5);
                break;
            case 'all':
                $pessoas = Pessoa::with(['occs'])->orderBy('id', 'desc')->paginate(5);
                break;
            case 'trash':
                $pessoas = Pessoa::with(['occs'])->onlyTrashed()->orderBy('id', 'desc')->paginate(5);
                break;
        }

        $data = ['pessoas' => $pessoas];
        return view('admin.pessoas.home', $data);
    }

    public function getPessoaAdd(Request $request){

        if($request->has('term'))
        return Pessoa::where('name','like','%'.$request->input('term').'%')->get();


        $occs = Occupation::where('status', '1')->pluck('name', 'id');
        $data = ['occs' => $occs];
        return view('admin.pessoas.add', $data);
    }

    public function postPessoaAdd(Request $request){
        $rules = [
            'name'     => 'required',
            'cpf'      => 'cpf|unique:pessoas',
        ];

        $messages = [
            'name.required'   => 'O campo nome não pode ficar vazio!',
            'cpf.required'    => 'O campo CPF não pode ficar vazio!',
            'cpf.unique'      => 'Exisite um registro com este CPF, informe outro!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Houve um erro!')->with('typealert', 'danger')->withInput();
        else:
            // $path = '/'.date('d-m-Y');
            // $fileExt = trim($request->file('img')->getClientOriginalExtension());
            // $upload_path = Config::get('filesystems.disks.uploads.root');
            // $name = Str::slug(str_replace($fileExt, '', $request->file('img')->getClientOriginalName()));

            // $filename = rand(1,999).'-'.$name.'.'.$fileExt;
            // $file_file = $upload_path.'/'.$path.'/'.$filename;

            $pessoa = new Transportador2;
            $pessoa->status        = '1';
            $pessoa->cpf           = e($request->input('cpf'));
            $pessoa->name          = Str::upper(e($request->input('name')));
            $pessoa->namecpf       = e($request->input('name')) .'- CPF:'. e($request->input('cpf'));
            $pessoa->occupation_id = e($request->input('occupation'));
            $pessoa->matricula     = e($request->input('matricula'));
            $pessoa->userlog       = e($request->input('userlog'));
            $pessoa->slug          = Str::slug($request->input('name'));

            
            if($pessoa->save()):
                // if($request->hasFile('img')):
                //     $fl = $request->img->storeAs($path, $filename, 'uploads');
                //     $img = Image::make($file_file);
                //     $img->fit(256, 256, function($constraint){
                //         $constraint->upsize();
                //     });
                //     $img->save($upload_path.'/'.$path.'/t_'.$filename);
                // endif;
                return redirect('/admin/pessoa/'.$pessoa->id. '/edit')->with('message', 'Gravado com sucesso!')->with('typealert', 'success');
            endif;
        endif;

    }

    public function getPessoaEdit($id){

        $p = Pessoa::findOrFail($id);
        $occs = Occupation::where('status', '1')->pluck('name', 'id');
        $data = ['occs' => $occs, 'p' => $p];
        
        return view('admin.pessoas.edit', $data);
    }

    public function postPessoaEdit($id, Request $request){
        $rules = [
            'name'      => 'required',
        ];

        $messages = [

            'name.required'    => 'O campo nome não pode ficar vazio!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Houve um erro!')->with('typealert', 'danger')->withInput();
        else:

            $pessoa = Pessoa::findOrFail($id);
            // $ipp = $product->file_path;
            // $ip = $product->image;
            // $product->status        = $request->input('status');
            // $product->code          = e($request->input('code'));
            // $product->name          = e($request->input('name'));
            // $product->category_id   = $request->input('category');
            // $product->subcategory_id   = $request->input('subcategory');
            // if($request->hasFile('img')):
            //     $path = '/'.date('d-m-Y');
            //     $fileExt = trim($request->file('img')->getClientOriginalExtension());
            //     $upload_path = Config::get('filesystems.disks.uploads.root');
            //     $name = Str::slug(str_replace($fileExt, '', $request->file('img')->getClientOriginalName()));

            //     $filename = rand(1,999).'-'.$name.'.'.$fileExt;
            //     $file_file = $upload_path.'/'.$path.'/'.$filename;
            //     $product->file_path = date('d-m-Y');
            //     $product->image = $filename;
            // endif;
            
            $pessoa->status        = '1';
            $pessoa->cpf           = e($request->input('cpf'));
            $pessoa->name          = Str::upper(e($request->input('name')));
            $pessoa->namecpf       = e($request->input('name')) .'- CPF:'. e($request->input('cpf'));
            $pessoa->occupation_id = e($request->input('occupation'));
            $pessoa->matricula     = e($request->input('matricula'));
            $pessoa->userlog       = e($request->input('userlog'));
            $pessoa->slug          = Str::slug($request->input('name'));

            if($pessoa->save()):
                // if($request->hasFile('img')):
                //     $fl = $request->img->storeAs($path, $filename, 'uploads');
                //     $img = Image::make($file_file);
                //     $img->fit(256, 256, function($constraint){
                //         $constraint->upsize();
                //     });
                //     $img->save($upload_path.'/'.$path.'/t_'.$filename);
                //     unlink($upload_path.'/'.$ipp.'/'.$ip);
                //     unlink($upload_path.'/'.$ipp.'/t_'.$ip);
                // endif;
                return back()->with('message', 'Atualizado com sucesso!')->with('typealert', 'success');
            endif;
        endif;
    }

    // public function postProductGalleryAdd($id, Request $request){
    //     $rules = [
    //         'file_image' => 'required'
    //     ];

    //     $messages = [
    //         'file_image.required' => 'Selecione um imagem'
    //     ];

    //     $validator = Validator::make($request->all(), $rules, $messages);
    //     if($validator->fails()):
    //         return back()->withErrors($validator)->with('message', 'Ocorreu um erro!')->with('typealert', 'danger')->withInput();
    //     else:
    //         if($request->hasFile('file_image')):
    //             $path = '/'.date('d-m-Y');
    //             $fileExt = trim($request->file('file_image')->getClientOriginalExtension());
    //             $upload_path = Config::get('filesystems.disks.uploads.root');
    //             $name = Str::slug(str_replace($fileExt, '', $request->file('file_image')->getClientOriginalName()));

    //             $filename = rand(1,999).'-'.$name.'.'.$fileExt;
    //             $file_file = $upload_path.'/'.$path.'/'.$filename;


    //             $g = new PGallery;
    //             $g->product_id = $id;
    //             $g->file_path = date('d-m-Y');
    //             $g->file_name = $filename;

    //             if($g->save()):
    //                 if($request->hasFile('file_image')):
    //                     $fl = $request->file_image->storeAs($path, $filename, 'uploads');
    //                     $img = Image::make($file_file);
    //                     $img->fit(510, 510, function($constraint){
    //                         $constraint->upsize();
    //                     });
    //                     $img->save($upload_path.'/'.$path.'/t_'.$filename);
    //                 endif;
    //                 return back()->with('message', 'Imagem carregada com sucesso!')->with('typealert', 'success');
    //             endif;

    //         endif;

    //     endif;
    // }

    // function getProductGalleryDelete($id, $gid){
    //     $g = PGallery::findOrFail($gid);
    //     $path = $g->file_path;
    //     $file = $g->file_name;
    //     $upload_path = Config::get('filesystems.disks.uploads.root');
    //     if($g->product_id != $id){
    //         return back()->with('message', 'A imagem não pode ser excluída!')->with('typealert', 'danger');
    //     }else{
    //         if($g->delete()):
    //             unlink($upload_path.'/'.$path.'/'.$file);
    //             unlink($upload_path.'/'.$path.'/t_'.$file);
    //             return back()->with('message', 'Imagem excluída com sucesso!')->with('typealert', 'success');
    //         endif;
    //     }
    // }

    public function postPessoaSearch(Request $request){
        $rules = [
            'search' => 'required'
        ];

        $messages = [
            'search.required' => 'O campo consulta é requerido!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return redirect('/admin/pessoas/1')->withErrors($validator)->with('message', 'Ocorreu um erro!')->with('typealert', 'danger')->withInput();
        else:
            switch ($request->input('filter')):
                case '0':
                    $pessoas = Pessoa::with(['occs'])->where('name', 'LIKE',  '%'.$request->input('search').'%')->where('status', $request->input('status'))->orderBy('id', 'desc')->get();
                    break;
                case '1':
                    $pessoas = Pessoa::with(['occs'])->where('cpf', $request->input('search'))->orderBy('id', 'desc')->get();
                    break;
            endswitch;

            $data = ['pessoas' => $pessoas];
        return view('admin.pessoas.search', $data);
        endif;
    }

    public function getPessoaDelete($id){
         $p = Pessoa::findOrFail($id);
         if($p->delete()):
            return redirect('/admin/pessoas/1')->with('message', 'Produto enviado para lixeira!')->with('typealert', 'success');
        endif;
    }
    public function getPessoaRestore($id){
         $p = Pessoa::onlyTrashed()->where('id', $id)->first();
         if($p->restore()):
            return redirect('/admin/pessoa/'.$p->id.'/edit')->with('message', 'O produto selecionado foi restaurado com sucesso!')->with('typealert', 'success');
        endif;
    }

   
}
