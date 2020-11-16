<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class gambar_lahan extends Model
{
    protected $table = 'gambar_lahan';
    public $timestamps = false;
    protected $fillable = [
        'lahan_id',
        'photo',
    ];
}
