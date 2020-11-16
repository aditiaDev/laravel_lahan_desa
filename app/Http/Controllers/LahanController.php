<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Provinsi;
use App\model\Kabupaten;
use App\model\Kecamatan;
use App\model\Lahan;
use App\model\Gambar_Lahan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function index()
    {
        return view('contents.lahan');
    }

    public function getProvinsiData(Request $request){
        // dd($request->term);
        $cari = $request->term;
        // $data = DB::table('provinsi')->select('id', 'name')->get();
        // return response()->json($data);
        $userData = Provinsi::where('name','like','%'.$cari.'%')->orderBy('name')->get();
        return json_encode(array('items'=>$userData));
        // dd($userData);
    }

    public function getKabupatenData(Request $request){
        $cari = $request->term;
        $id_provinsi = $request->id_provinsi;
        $userData = Kabupaten::where('name','like','%'.$cari.'%')
                                ->where('provinsi_id',$id_provinsi)
                                ->orderBy('name')
                                ->get();
        return json_encode(array('items'=>$userData));
        // dd($userData);
    }

    public function getKecamatanData(Request $request){
        $cari = $request->term;
        $id_kabupaten = $request->id_kabupaten;
        $userData = Kecamatan::where('name','like','%'.$cari.'%')
                                ->where('kabupaten_id',$id_kabupaten)
                                ->orderBy('name')
                                ->get();
        return json_encode(array('items'=>$userData));
        // dd($userData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request);
        // $validation = $request->validate([
        //     'kecamatan' => ['required'],
        //     'desa' => ['required'],
        //     'lat' => ['required'],
        //     'lng' => ['required'],
        //     'luas' => ['required'],
        //     'tampak_depan' => ['required'],
        //     'lebar_jalan' => ['required'],
        //     'jaringan_listrik' => ['required'],
        //     'zona_lahan' => ['required'],
        //     'photo' => ['required'],
        //     // 'photo.*' => ['mimes:jpeg,png,jpg','max:2048']
        // ]);

        $validation = Validator::make($request->all(), [
            'kecamatan' => 'required',
            'desa' => 'required|unique:lahan',
            'lat' => 'required',
            'lng' => 'required',
            'luas' => 'required',
            'tampak_depan' => 'required',
            'lebar_jalan' => 'required',
            'jaringan_listrik' => 'required',
            'zona_lahan' => 'required',
            'photo' => 'required',
            'photo.*' => ['mimes:jpeg,png,jpg','max:2048']
        ]);

        // $lahan = Lahan::create($request->except('photo'));
        // dd($request->file('photo'));

        // $lahan = new Lahan;
        // $lahan->kecamatan_id = $request->kecamatan;
        // $lahan->desa = $request->desa;
        // $lahan->lat = $request->lat;
        // $lahan->lng = $request->lng;
        // $lahan->luas = $request->luas;
        // $lahan->tampak_depan = $request->tampak_depan;
        // $lahan->lebar_jalan = $request->lebar_jalan;
        // $lahan->jaringan_listrik = $request->jaringan_listrik;
        // $lahan->zona_lahan = $request->zona_lahan;
        // $lahan->save();

        // return response()->json([
        //     "message" => "DATA HAVE BEEN SAVED"
        // ], 201);
        

        if($validation->passes())
        {
            $lahan = new Lahan;
            $lahan->kecamatan_id = $request->kecamatan;
            $lahan->desa = $request->desa;
            $lahan->lat = $request->lat;
            $lahan->lng = $request->lng;
            $lahan->luas = $request->luas;
            $lahan->tampak_depan = $request->tampak_depan;
            $lahan->lebar_jalan = $request->lebar_jalan;
            $lahan->jaringan_listrik = $request->jaringan_listrik;
            $lahan->zona_lahan = $request->zona_lahan;
            $lahan->save();

            // https://www.webslesson.info/2018/09/upload-image-in-laravel-using-ajax.html
            $image = $request->file('photo');
            // $new_name = rand() . '.' . $image->getClientOriginalExtension();
            // $gambar = $image->getClientOriginalExtension();
            // $image->move(public_path('images'), $new_name);
            $i = 0;
            foreach ($request->file('photo') as $file) {
                $new_name = date('Ymd').rand() . '.' . $image[$i]->getClientOriginalExtension();
                // $image[$i]->move(public_path('images'), $image[$i]->getClientOriginalName());

                $gambar_lahan = new Gambar_Lahan;
                $gambar_lahan->lahan_id = $lahan->id;
                $gambar_lahan->photo = $new_name;
                $gambar_lahan->save();

                $image[$i]->move(public_path('images'), $new_name);

                
                $i++;
            }


            return response()->json([
                'status'     => 'success',
                'message'   => 'Data Have Been Saved',
                // 'uploaded_image' => '<img src="/images/'.$new_name.'" class="img-thumbnail" width="300" />',
                // 'class_name'  => 'alert-success'
            ]);
            // foreach ($request->file('photo') as $file) {
            //     $path = Storage::disk('public')->putFile('gambar_lahan', $file);
            //     // $spacePhotos[] = [
            //     //     'space_id' => $space->id,
            //     //     'path' => $path
            //     // ];
            // }
        }
        else
        {
            return response()->json([
                'status'     => 'error',
                'message'   => $validation->errors()->all(),
                // 'uploaded_image' => '',
                // 'class_name'  => 'alert-danger'
            ]);
        }

        // dd($lahan);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
