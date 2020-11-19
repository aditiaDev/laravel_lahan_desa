<?php

namespace App\Exports;

use App\model\lahan;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class LahanReport implements FromView
{
    use Exportable;

    public function __construct( $provinsi_id,  $kabupaten_id,  $kecamatan_id,  $status)
    {
        $this->provinsi_id = $provinsi_id;
        $this->kabupaten_id = $kabupaten_id;
        $this->kecamatan_id = $kecamatan_id;
        $this->status = $status;
    }
    
    public function view(): View
    {
        $url = URL::to('/').'/images/';
        $userData = DB::select(DB::raw("SELECT E.`name` provinsi, D.`name` kabupaten, C.`name` kecamatan, B.`name` desa, A.luas, 
                                A.tampak_depan, A.lebar_jalan, A.jaringan_listrik, A.keterangan, A.lat, A.lng, concat('".$url."' ,F.photo) photo, DATE_FORMAT(A.date, '%d-%b-%Y') as date, A.harga, A.tim, A.status
                                FROM lahan A LEFT JOIN desa B ON A.desa=B.id 
                                LEFT JOIN kecamatan C ON B.kecamatan_id=C.id 
                                LEFT JOIN kabupaten D ON C.kabupaten_id=D.id
                                LEFT JOIN provinsi E on D.provinsi_id=E.id 
                                LEFT JOIN gambar_lahan F ON A.id=F.lahan_id
                                WHERE 
                                D.id like '%".$this->kabupaten_id."%'
                                AND E.id like '%".$this->provinsi_id."%'
                                AND C.id like '%".$this->kecamatan_id."%'
                                AND A.status like '%".$this->status."%'
                                order by D.provinsi_id, C.kabupaten_id, B.kecamatan_id, A.desa ASC"));
        return view('export.lahan_exp', [
            'lahans' => $userData
        ]);
    }
}