<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Category, App\Http\Models\Product, App\Http\Models\PGallery, App\Http\Models\Inventory;

use Validator, Str, Config, Image;

class ProductController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }

    public function getHome($status){
        switch ($status) {
            case '0':
                $products = Product::with(['cat', 'getSubcategory'])->where('status', '0')->orderBy('id', 'desc')->paginate(5);
                break;
            case '1':
                $products = Product::with(['cat', 'getSubcategory'])->where('status', '1')->orderBy('id', 'desc')->paginate(5);
                break;
            case 'all':
                $products = Product::with(['cat', 'getSubcategory'])->orderBy('id', 'desc')->paginate(5);
                break;
            case 'trash':
                $products = Product::with(['cat', 'getSubcategory'])->onlyTrashed()->orderBy('id', 'desc')->paginate(5);
                break;
        }

        $data = ['products' => $products];
        return view('admin.products.home', $data);
    }

    public function getProductAdd(){
        $cats = Category::where('module', '0')->where('parent', '0')->pluck('name', 'id');
        $data = ['cats' => $cats];
        return view('admin.products.add', $data);
    }

    public function postProductAdd(Request $request){
        $rules = [
            'name' => 'required',
            'img' => 'required',
            'price' => 'required',
            'content' => 'required'
        ];

        $messages = [
            'name.required' => 'Campo nome é requerido!',
            'img.required' => 'Selecione uma imagem.',
            'img.image' => 'O arquivo não é uma imagem!',
            'price.required' => 'Inclua um valor para o preço.',
            'content.required' => 'Informe um descrição do produto!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Houve um erro!')->with('typealert', 'danger')->withInput();
        else:
            $path = '/'.date('d-m-Y');
            $fileExt = trim($request->file('img')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.uploads.root');
            $name = Str::slug(str_replace($fileExt, '', $request->file('img')->getClientOriginalName()));

            $filename = rand(1,999).'-'.$name.'.'.$fileExt;
            $file_file = $upload_path.'/'.$path.'/'.$filename;

            $product = new Product;
            $product->status        = '0';
            $product->code          = e($request->input('code'));
            $product->name          = e($request->input('name'));
            $product->slug          = Str::slug($request->input('name'));
            $product->category_id   = $request->input('category');
            $product->subcategory_id= $request->input('subcategory');
            $product->file_path     = date('d-m-Y');
            $product->image         = $filename;
            $product->price         = $request->input('price');
            $product->inventory     = e($request->input('inventory'));
            $product->in_discount   = $request->input('indiscount');
            $product->discount      = $request->input('discount');
            $product->content       = e($request->input('content'));

            if($product->save()):
                if($request->hasFile('img')):
                    $fl = $request->img->storeAs($path, $filename, 'uploads');
                    $img = Image::make($file_file);
                    $img->fit(256, 256, function($constraint){
                        $constraint->upsize();
                    });
                    $img->save($upload_path.'/'.$path.'/t_'.$filename);
                endif;
                return redirect('/admin/products/'.$product->id. '/edit')->with('message', 'Gravado com sucesso!')->with('typealert', 'success');
            endif;
        endif;

    }

    public function getProductEdit($id){
        $p = Product::findOrFail($id);
        $cats = Category::where('module', '0')->where('parent', '0')->pluck('name', 'id');
        $data = ['cats' => $cats, 'p' => $p];
        return view('admin.products.edit', $data);
    }

    public function postProductEdit($id, Request $request){
        $rules = [
           'name' => 'required',
            //'img' => 'required',
            'price' => 'required',
            'content' => 'required'
        ];

        $messages = [
        	'name.required' => 'Campo nome é requerido!',
            //'img.required' => 'Selecione uma imagem.',
            //'img.image' => 'O arquivo não é uma imagem!',
            'price.required' => 'Inclua um valor para o preço.',
            'content.required' => 'Informe um descrição do produto!'

        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Houve um erro!')->with('typealert', 'danger')->withInput();
        else:

            $product = Product::findOrFail($id);
            $ipp = $product->file_path;
            $ip = $product->image;
            $product->status        = $request->input('status');
            $product->code          = e($request->input('code'));
            $product->name          = e($request->input('name'));
            $product->category_id   = $request->input('category');
            $product->subcategory_id   = $request->input('subcategory');
            if($request->hasFile('img')):
                $path = '/'.date('d-m-Y');
                $fileExt = trim($request->file('img')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('img')->getClientOriginalName()));

                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $file_file = $upload_path.'/'.$path.'/'.$filename;
                $product->file_path = date('d-m-Y');
                $product->image = $filename;
            endif;
            $product->price         = $request->input('price');
            $product->inventory     = e($request->input('inventory'));
            $product->in_discount   = $request->input('indiscount');
            $product->discount      = $request->input('discount');
            $product->content       = e($request->input('content'));

            if($product->save()):
                if($request->hasFile('img')):
                    $fl = $request->img->storeAs($path, $filename, 'uploads');
                    $img = Image::make($file_file);
                    $img->fit(256, 256, function($constraint){
                        $constraint->upsize();
                    });
                    $img->save($upload_path.'/'.$path.'/t_'.$filename);
                    unlink($upload_path.'/'.$ipp.'/'.$ip);
                    unlink($upload_path.'/'.$ipp.'/t_'.$ip);
                endif;
                return back()->with('message', 'Atualizado com sucesso!')->with('typealert', 'success');
            endif;
        endif;
    }

    public function postProductGalleryAdd($id, Request $request){
        $rules = [
            'file_image' => 'required'
        ];

        $messages = [
            'file_image.required' => 'Selecione um imagem'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Ocorreu um erro!')->with('typealert', 'danger')->withInput();
        else:
            if($request->hasFile('file_image')):
                $path = '/'.date('d-m-Y');
                $fileExt = trim($request->file('file_image')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('file_image')->getClientOriginalName()));

                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $file_file = $upload_path.'/'.$path.'/'.$filename;


                $g = new PGallery;
                $g->product_id = $id;
                $g->file_path = date('d-m-Y');
                $g->file_name = $filename;

                if($g->save()):
                    if($request->hasFile('file_image')):
                        $fl = $request->file_image->storeAs($path, $filename, 'uploads');
                        $img = Image::make($file_file);
                        $img->fit(510, 510, function($constraint){
                            $constraint->upsize();
                        });
                        $img->save($upload_path.'/'.$path.'/t_'.$filename);
                    endif;
                    return back()->with('message', 'Imagem carregada com sucesso!')->with('typealert', 'success');
                endif;

            endif;

        endif;
    }

    function getProductGalleryDelete($id, $gid){
        $g = PGallery::findOrFail($gid);
        $path = $g->file_path;
        $file = $g->file_name;
        $upload_path = Config::get('filesystems.disks.uploads.root');
        if($g->product_id != $id){
            return back()->with('message', 'A imagem não pode ser excluída!')->with('typealert', 'danger');
        }else{
            if($g->delete()):
                unlink($upload_path.'/'.$path.'/'.$file);
                unlink($upload_path.'/'.$path.'/t_'.$file);
                return back()->with('message', 'Imagem excluída com sucesso!')->with('typealert', 'success');
            endif;
        }
    }

    public function postProductSearch(Request $request){
        $rules = [
            'search' => 'required'
        ];

        $messages = [
            'search.required' => 'O campo consulta é requerido!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return redirect('/admin/products/1')->withErrors($validator)->with('message', 'Ocorreu um erro!')->with('typealert', 'danger')->withInput();
        else:
            switch ($request->input('filter')):
                case '0':
                    $products = Product::with(['cat'])->where('name', 'LIKE',  '%'.$request->input('search').'%')->where('status', $request->input('status'))->orderBy('id', 'desc')->get();
                    break;
                case '1':
                    $products = Product::with(['cat'])->where('code', $request->input('search'))->orderBy('id', 'desc')->get();
                    break;
            endswitch;

            $data = ['products' => $products];
        return view('admin.products.search', $data);
        endif;
    }

    public function getProductDelete($id){
         $p = Product::findOrFail($id);
         if($p->delete()):
            return redirect('/admin/products/1')->with('message', 'Produto enviado para lixeira!')->with('typealert', 'success');
        endif;
    }
    public function getProductRestore($id){
         $p = Product::onlyTrashed()->where('id', $id)->first();
         if($p->restore()):
            return redirect('/admin/product/'.$p->id.'/edit')->with('message', 'O produto selecionado foi restaurado com sucesso!')->with('typealert', 'success');
        endif;
    }

    public function getProductInventory($id){
        $product = Product::findOrFail($id);
        $data = ['product' => $product];
        return view('admin.products.inventory', $data);
    }

    public function postProductInventory($id, Request $request){
        $rules = [
            'name' => 'required',
             'price' => 'required'

         ];

         $messages = [
             'name.required' => 'Campo nome é requerido!',
             'price.required' => 'Inclua o preço.'

         ];

         $validator = Validator::make($request->all(), $rules, $messages);
         if($validator->fails()):
             return back()->withErrors($validator)->with('message', 'Houve um erro!')->with('typealert', 'danger')->withInput();
         else:
            $inventory              = new Inventory;
            $inventory->product_id  = $id;
            $inventory->name        = e($request->input('name'));
            $inventory->quantity    = $request->input('inventory');
            $inventory->price       = $request->input('price');
            $inventory->limited     = $request->input('limited');
            $inventory->minimum     = $request->input('minimum');
            if($inventory->save()):
                return back()->with('message', 'Gravado com sucesso!')->
                with('typealert', 'success');
            endif;

        endif;
    }

    public function getProductInventoryEdit($id){
        $inventory = Inventory::findOrFail($id);
        $data = ['inventory' => $inventory];
        return view('admin.products.inventory_edit', $data);
    }

    public function postProductInventoryEdit($id, Request $request){
        $rules = [
            'name' => 'required',
             'price' => 'required'

         ];

         $messages = [
             'name.required' => 'Campo nome é requerido!',
             'price.required' => 'Inclua o preço.'

         ];

         $validator = Validator::make($request->all(), $rules, $messages);
         if($validator->fails()):
             return back()->withErrors($validator)->with('message', 'Houve um erro!')->with('typealert', 'danger')->withInput();
         else:
            $inventory              = Inventory::find($id);

            $inventory->name        = e($request->input('name'));
            $inventory->quantity    = $request->input('inventory');
            $inventory->price       = $request->input('price');
            $inventory->limited     = $request->input('limited');
            $inventory->minimum     = $request->input('minimum');
            if($inventory->save()):
                return back()->with('message', 'Gravado com sucesso!')->
                with('typealert', 'success');
            endif;

        endif;
    }

    public function getProductInventoryDeleted($id){
        $inventory = Inventory::findOrFail($id);
         if($inventory->delete()):
            return back()->with('message', 'Registro excluído com sucesso!')->with('typealert', 'success');
        endif;
    }
}
