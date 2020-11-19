<?php

namespace App\Http\Controllers;

use App\model\desa;
use App\model\lahan;
use App\model\provinsi;
use App\model\kabupaten;
use App\model\kecamatan;
use App\model\gambar_lahan;
use App\Exports\LahanExport;
use App\Exports\LahanReport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
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

    public function datalahan(){
        return view('contents.datalahan');
    }

    public function export_excel(Request $request){
        $provinsi_id = ($request->provinsi_id) ? null : '';
        $kabupaten_id = ($request->kabupaten_id) ? null : '';
        $kecamatan_id = ($request->kecamatan_id) ? null : '';
        $status = $request->status;
        $lahan_report = new LahanReport($provinsi_id, $kabupaten_id, $kecamatan_id, $status);
        return ($lahan_report)->download('lahan.xlsx');
    }

    public function getlahandata(Request $request){
        $provinsi_id = $request->provinsi_id;
        $kabupaten_id = $request->kabupaten_id;
        $kecamatan_id = $request->kecamatan_id;
        $status = $request->status;

        $userData = DB::select(DB::raw("SELECT A.id, E.`name` provinsi, D.`name` kabupaten, C.`name` kecamatan, 
                                B.`name` desa, A.luas, A.tampak_depan, A.lebar_jalan, A.jaringan_listrik, A.status
                                FROM lahan A, desa B, kecamatan C, kabupaten D, provinsi E
                                WHERE A.desa=B.id
                                AND B.kecamatan_id=C.id
                                AND C.kabupaten_id=D.id
                                AND D.provinsi_id=E.id
                                AND E.id LIKE '%".$provinsi_id."%'
                                AND D.id LIKE '%".$kabupaten_id."%'
                                AND C.id LIKE '%".$kecamatan_id."%'
                                AND A.`status` LIKE '%".$status."%'"));
        return json_encode(array('data'=>$userData));
    }

    public function getdetaillahandata(Request $request){
        // dd($request->id_lahan);
        // $userData = DB::select(DB::raw("SELECT E.`name` provinsi, D.`name` kabupaten, C.`name` kecamatan, B.`name` desa, A.luas, 
        //                         A.tampak_depan, A.lebar_jalan, A.jaringan_listrik, A.keterangan, A.lat, A.lng
        //                         FROM lahan A, desa B, kecamatan C, kabupaten D, provinsi E
        //                         WHERE A.desa=B.id
        //                         AND B.kecamatan_id=C.id
        //                         AND C.kabupaten_id=D.id
        //                         AND D.provinsi_id=E.id
        //                         AND A.id='".$request->id_lahan."'"));
        $userData = DB::select(DB::raw("SELECT E.`name` provinsi, D.`name` kabupaten, C.`name` kecamatan, B.`name` desa, A.luas, 
                                A.tampak_depan, A.lebar_jalan, A.jaringan_listrik, A.keterangan, A.lat, A.lng, F.photo, DATE_FORMAT(A.date, '%d-%b-%Y') as date, A.harga, A.tim
                                FROM lahan A LEFT JOIN desa B ON A.desa=B.id 
                                LEFT JOIN kecamatan C ON B.kecamatan_id=C.id 
                                LEFT JOIN kabupaten D ON C.kabupaten_id=D.id
                                LEFT JOIN provinsi E on D.provinsi_id=E.id 
                                LEFT JOIN gambar_lahan F ON A.id=F.lahan_id
                                WHERE 
                                A.id='".$request->id_lahan."'"));
        return json_encode(array('data'=>$userData));
    }

    public function getprovinsiData(Request $request){
        // dd($request->term);
        $cari = $request->term;
        // $data = DB::table('provinsi')->select('id', 'name')->get();
        // return response()->json($data);
        $userDatas = provinsi::where('name','like','%'.$cari.'%')->orderBy('name')->get();

        $response = array();
        $response[] = array(
            "id"=>'',
            "name"=>'ALL'
        );
        foreach($userDatas as $userData){
            $response[] = array(
                "id"=>$userData->id,
                "name"=>$userData->name
            );
        }

        return json_encode(array('items'=>$response));

        // return json_encode(array('items'=>$userData));
        // dd($userData);
    }

    public function getkabupatenData(Request $request){
        $cari = $request->term;
        $id_provinsi = $request->id_provinsi;
        $userDatas = kabupaten::where('name','like','%'.$cari.'%')
                                ->where('provinsi_id','like','%'.$id_provinsi.'%')
                                ->orderBy('name')
                                ->get();
        // return json_encode(array('items'=>$userData));

        $response = array();
        $response[] = array(
            "id"=>'',
            "name"=>'ALL'
        );
        foreach($userDatas as $userData){
            $response[] = array(
                "id"=>$userData->id,
                "name"=>$userData->name
            );
        }
        return json_encode(array('items'=>$response));
        // dd($userData);
    }

    public function getkecamatanData(Request $request){
        $cari = $request->term;
        $id_kabupaten = $request->id_kabupaten;
        $userDatas = kecamatan::where('name','like','%'.$cari.'%')
                                ->where('kabupaten_id','like','%'.$id_kabupaten.'%')
                                ->orderBy('name')
                                ->get();
        // return json_encode(array('items'=>$userData));

        $response = array();
        $response[] = array(
            "id"=>'',
            "name"=>'ALL'
        );
        foreach($userDatas as $userData){
            $response[] = array(
                "id"=>$userData->id,
                "name"=>$userData->name
            );
        }
        return json_encode(array('items'=>$response));
        // dd($userData);
    }

    public function getdesaData(Request $request){
        $cari = $request->term;
        $id_kecamatan = $request->id_kecamatan;
        $userData = desa::where('name','like','%'.$cari.'%')
                                ->where('kecamatan_id',$id_kecamatan)
                                ->orderBy('name')
                                ->get();
        return json_encode(array('items'=>$userData));
        // dd($userData);
    }

    public function confirm_lahan(Request $request){
        $validation = Validator::make($request->all(), [
            'id_lahan' => 'required',
        ]);

        if($validation->passes()){
            $data = Lahan::where('id', $request->id_lahan)
                            ->update(['status' => 'verified']);

            return response()->json([
                'status'     => 'success',
                'message'   => 'Data Berhasil di Update',
            ]);
        }else{
            return response()->json([
                'status'     => 'error',
                'message'   => $validation->errors()->all(),
            ]);
        }
    }

    public function delete_lahan(Request $request){
        $validation = Validator::make($request->all(), [
            'id_lahan' => 'required',
        ]);

        if($validation->passes()){
            $data = Lahan::where('id', $request->id_lahan)
                            ->delete();

            return response()->json([
                'status'     => 'success',
                'message'   => 'Data Berhasil di Update',
            ]);
        }else{
            return response()->json([
                'status'     => 'error',
                'message'   => $validation->errors()->all(),
            ]);
        }
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
        $validation = Validator::make($request->all(), [
            'kecamatan' => 'required',
            'desa' => 'required|unique:lahan',
            'lat' => 'required',
            'lng' => 'required',
            'luas' => 'required',
            'tampak_depan' => 'required',
            'lebar_jalan' => 'required',
            'jaringan_listrik' => 'required',
            'keterangan' => 'required',
            'date' => 'required',
            'harga' => 'required',
            'tim' => 'required',
            'photo' => 'required',
            'photo.*' => ['mimes:jpeg,png,jpg','max:2048']
        ]);
       

        if($validation->passes()){
            $now = date('d-M-Y'); //Fomat Date and time
            $now = $request->date;

            $lahan = new lahan;
            $lahan->kecamatan_id = $request->kecamatan;
            $lahan->desa = $request->desa;
            $lahan->lat = $request->lat;
            $lahan->lng = $request->lng;
            $lahan->luas = $request->luas;
            $lahan->tampak_depan = $request->tampak_depan;
            $lahan->lebar_jalan = $request->lebar_jalan;
            $lahan->jaringan_listrik = $request->jaringan_listrik;
            $lahan->keterangan = $request->keterangan;
            $lahan->tim = $request->tim;
            $lahan->status = 'under_verification';
            $lahan->date = Carbon::parse($request->date)->format('Y-m-d');
            $lahan->harga = str_replace(',', '',$request->harga);
            $lahan->user_id = Auth::user()->id;
            $lahan->save();

            $image = $request->file('photo');
            
            $i = 0;
            foreach ($request->file('photo') as $file) {
                $new_name = date('Ymd').rand() . '.' . $image[$i]->getClientOriginalExtension();
                // $image[$i]->move(public_path('images'), $image[$i]->getClientOriginalName());

                $gambar_lahan = new gambar_lahan;
                $gambar_lahan->lahan_id = $lahan->id;
                $gambar_lahan->photo = $new_name;
                $gambar_lahan->save();

                $image[$i]->move(public_path('images'), $new_name);

                
                $i++;
            }


            return response()->json([
                'status'     => 'success',
                'message'   => 'Data Berhasil di Simpan',
            ]);
 
        }else{
            return response()->json([
                'status'     => 'error',
                'message'   => $validation->errors()->all(),
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
