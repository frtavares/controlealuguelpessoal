<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Client;
use App\Http\Models\Ship;
use App\Http\Models\Booking;

use App\Http\Models\UGallery;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
use App\Http\Middleware\UserStatus;
use Validator, Str, Config, Image, Auth, PDF, DateTime, DB;
use Dompdf\Dompdf;
use Dompdf\Options;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');




    }

    public function getHome($status){

    	switch ($status) {
            case '0':
                $bookings = Booking::with(['ships','clis'])->where('status', '0')->orderBy('id', 'desc')->paginate(5);
                break;
            case '1':
                $bookings = Booking::with(['ships','clis'])->where('status', '1')->orderBy('id', 'desc')->paginate(5);
               //
                break;
            case 'all':
                $bookings = Booking::with(['ships','clis'])->orderBy('id', 'desc')->paginate(5);
                break;
            case 'trash':
                $bookings = Booking::with(['ships','clis'])->onlyTrashed()->orderBy('id', 'desc')->paginate(5);
                break;

        }


        $data = ['bookings' => $bookings];


        return view('admin.bookings.home', $data);

    }

    public function getBookingAdd()
    {
        $ships  = Ship::where('status', '1')->pluck('name', 'id');
        $clis   = Client::where('status', '1')->pluck('fantasia', 'id');

        $data = [
        			'ships' => $ships,
        			'clis' => $clis
        		];

        return view('admin.bookings.add', $data);
    }

    public function postBookingAdd(Request $request)
    {

        $rules = [
            'codigo'      => 'required',
            'container' => 'min:11',
            'codigo'      => 'required|unique:bookings',
        ];

        $messages = [

            'codigo.required'    => 'O campo booking não pode ficar vazio!',
            'container.min'    => 'Campo container tem que ter no mínimo 11 caracteres!',
            'codigo.unique'      => 'Já existe este booking no banco de dados!'
        ];

        $now = new DateTime();

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Houve um erro.')->with('typealert', 'danger')->withInput();
        else:

            $booking = new Booking;
            $booking->status        = '1';
            $booking->codigo        = Str::upper(e($request->input('codigo')));
            $booking->container     = Str::upper(e($request->input('container')));
            $booking->client_id     = e($request->input('client'));
            $booking->ship_id       = e($request->input('ship'));
            $booking->slug          = Str::slug($request->input('codigo'));
            $booking->userlog       = e($request->input('userlog'));


            if($booking->save()):
                // if($request->hasFile('img')):
                //     $fl = $request->img->storeAs($path, $filename, 'uploads');
                //     $img = Image::make($file_file);
                //     $img->fit(1280, 958, function($constraint){
                //         $constraint->upsize();
                //     });
                //     $img->save($upload_path.'/'.$path.'/t_'.$filename);
                // endif;
                return redirect('/admin/bookings/1')->with('message', 'Salvo com sucesso.')->with('typealert', 'success');
            endif;
        endif;
    }

    public function getBookingEdit($id){

        $p = Booking::findOrFail($id);

        $ships          = Ship::where('status', '1')->pluck('name', 'id');
        $clis           = Client::where('status', '1')->pluck('fantasia', 'id');

        $fotos =  Booking::leftJoin("id", function($join) {
			$join->on("bookings.id", "=", "booking_gallery.booking_id");
			})

			->select("bookings.id", "booking_gallery.booking_id", "sum(booking_gallery.deleted_at,  NULL)")
			->groupBy("booking_gallery.booking_id");




        $data = [
        			'ships' => $ships,
        			'clis' => $clis,
                    'fotos' => $fotos,
        			'p' => $p

        		];


        return view('admin.bookings.edit', $data);
    }

    public function postBookingEdit($id, Request $request)
    {

        $rules = [
            'codigo'      => 'required',
            'container' => 'min:11',


           // 'codigo'      => 'required|unique:bookings',
        ];

        $messages = [

            'codigo.required'    => 'O campo booking não pode ficar vazio!',
            'container.min'    => 'Campo container tem que ter no mínimo 11 caracteres!',

            //'codigo.unique'      => 'Já existe este booking no banco de dados!'
        ];



        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Ocorreu um ou mais erros:')->with(
                'typealert', 'danger')->withInput();
        else:

            $booking                   = Booking::findOrFail($id);

            $ipp = $booking->file_path;
            $ip = $booking->image;

            $booking->status        = '1';

            $booking->codigo        = Str::upper(e($request->input('codigo')));
            $booking->client_id     = e($request->input('client'));
            $booking->ship_id       = e($request->input('ship'));
            $booking->slug          = Str::slug($request->input('codigo'));
            $booking->userlog       = e($request->input('userlog'));

            if($request->hasFile('img')):
                $path       = '/'.date('d-m-Y');
                $fileExt    = trim($request->file('img')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::codigo(str_replace($fileExt, '', $request->file('img')->getClientOriginalName()));

                $filename = rand(1,999999).'-'.$name.'.'.$fileExt;
                $file_file = $upload_path.'/'.$path.'/'.$filename;
                $booking->file_path     = date('d-m-Y').'-'.$booking->codigo;
                $booking->image         = $filename;

            endif;


            if ($booking->save()):

                if($request->hasFile('img')):

                    $f1 = $request->img->storeAs($path, $filename, 'uploads');
                    $img = Image::make($file_file);
                    $img->fit(1280, 958, function($constraint){
                        $constraint->upsize();
                    });
                    $img->save($upload_path.'/'.$path.'/t_'.$filename)->count();
                    unlink($upload_path.'/'.$ipp.'/'.$ip);
                    unlink($upload_path.'/'.$ipp.'/t_'.$ip);

                endif;
                    return back()->with('message', 'Alterado com sucesso.')->with('typealert', 'success');
                endif;
            endif;

    }

    public function postBookingGalleryAdd($id, Request $request){
        $rules = [
            'file_image' => 'required'
        ];

        $messages = [
            'file_image.required' => 'Seleccione una imagen'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error.')->with('typealert', 'danger')->withInput();
        else:
            if($request->hasFile('file_image')):
                $path = '/'.date('Y-m-d');
                $fileExt = trim($request->file('file_image')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('file_image')->getClientOriginalName()));

                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $file_file = $upload_path.'/'.$path.'/'.$filename;


                $g = new UGallery;
                $g->booking_id = $id;
                $g->file_path = date('Y-m-d');
                $g->file_name = $filename;

                if($g->save()):
                    if($request->hasFile('file_image')):
                        $fl = $request->file_image->storeAs($path, $filename, 'uploads');
                        $img = Image::make($file_file);
                        $img->fit(1280, 958, function($constraint){
                            $constraint->upsize();
                        });
                        $img->save($upload_path.'/'.$path.'/t_'.$filename);
                    endif;
                    return back()->with('message', 'Imagem inclusa com sucesso.')->with('typealert', 'success');
                endif;

            endif;

        endif;
    }

    function getBookingGalleryDelete($id, $gid){
        $g = UGallery::findOrFail($gid);
        $path = $g->file_path;
        $file = $g->file_name;
        $upload_path = Config::get('filesystems.disks.uploads.root');
        if($g->booking_id != $id){
            return back()->with('message', 'A imagem não pode ser excluída.')->with('typealert', 'danger');
        }else{
            if($g->delete()):
                unlink($upload_path.'/'.$path.'/'.$file);
                unlink($upload_path.'/'.$path.'/t_'.$file);
                return back()->with('message', 'Imagem excluída com sucesso.')->with('typealert', 'success');
            endif;
        }
    }


    public function postBookingSearch(Request $request){

        $rules = [
            // 'search'  => 'required'
        ];

        $messages = [
            // 'search.required'    => 'O campo de busca deve ser preenchido!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Ocorreu um ou mais erros:')->with(
                'typealert', 'danger')->withInput();
        else:
            switch ($request->input('filter')):
                case '0':

                    $bookings = Booking::where('container', 'LIKE', '%'.$request->input('search').'%')->where('status', $request->input('status'))->orderBy('id', 'desc')->get();
                    break;

                case '1':
                    $bookings = Booking::where('booking', $request->input('search'))->orderBy('id', 'desc')->get();
                    break;
                endswitch;

                $data = ['bookings' => $bookings];
                return view('admin.bookings.search', $data);



        endif;
    }


    public function getBookingDelete($id){
        $booking = Booking::find($id);
        if ($booking->delete()):
           return back()->with('message', 'Excluído com sucesso!')->with('typealert', 'success');
       endif;
   }

   public function getBookingRestore($id){
        $booking = Booking::onlyTrashed()->where('id', $id)->first();
        if($booking->restore()):
           return redirect('/admin/booking/'.$booking->id.'/edit')->with('message', 'Registro restaurado com sucesso!')->with('typealert', 'success');
       endif;
   }

   public function getBookingPdf($id=null){

    $p = Booking::findOrFail($id);
    $bookings = Booking::where('codigo', 'id');
    $data = ['bookings' => $bookings, 'p' => $p];

    //$pdf = PDF::loadView('admin.bookings.pdf', compact('p'))->setOptions(['defaultFont' => 'sans-serif']);
   // return $pdf->setPaper('a4')->stream('admin.bookings.pdf', $data);
    return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.bookings.pdf', compact('p'))->stream('admin.bookings.pdf', $data);



    // $p = Booking::findOrFail($id);
    // $bookings = Booking::where('codigo', 'id');
    // $data = ['bookings' => $bookings, 'p' => $p];
    // return view('admin.bookings.pdf', $data);

    //$pdf = PDF::loadView('admin.products.pdf', compact('p'));
    //return $pdf->setPaper('a4')->stream('admin.products.pdf', $data);


  // $client = Client::all();
  // $pdf = PDF::loadView('admin.clients.pdf', compact('client'));
  // return $pdf->setPaper('a4')->stream('clients.pdf');

  }

  public function getBookingGallery($id=null){
    $p = Booking::findOrFail($id);
    $bookings = Booking::where('codigo', 'id');
    $data = ['bookings' => $bookings, 'p' => $p];
    return view('admin.bookings.gallery', $data);

  }


    public function getBookingExcel(){
        return view('admin.bookings.excel');
    }

    public function postBookingExcel(Request $request){


        Excel::import(new Booking, $request->file('file'));
        return back()->with('message', 'Excluído com sucesso!')->with('typealert', 'success');


        // Excel::import($request->file('file'), function($reader){
        //     $reader->each(function($sheet){
        //         foreach($sheet->toArray() as $row){
        //             Booking::firstOrCreate($sheet->toArray());
        //         }
        //     });
        // });
        // return view('admin.bookings.excel');
    }

}
