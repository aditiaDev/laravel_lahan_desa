<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class lahan extends Model
{
    protected $table = 'lahan';

    public function photos()
    {
        return $this->hasMany(gambar_lahan::class, 'lahan_id', 'id');
    }

    // public function kecamatan()
    // {
    //     return $this->belongsTo(kecamatan::class, 'kecamatan_id', 'id');
    // }

    protected $fillable = [
        'kecamatan_id',
        'desa',
        'lat',
        'lng',
        'luas',
        'tampak_depan',
        'lebar_jalan',
        'jaringan_listrik',
        'zona_lahan',
    ];
}
