<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BTS extends Model
{
    use HasFactory;

    protected $table = 'bts';

    // Mass assignable attributes
    protected $fillable = [
        'nama',
        'alamat',
        'id_jenis_bts',
        'latitude',
        'longitude',
        'tinggi_tower',
        'panjang_tanah',
        'lebar_tanah',
        'ada_genset',
        'ada_tembok_batas',
        'id_user_pic',
        'id_pemilik',
        'id_wilayah',
        'created_by',
        'edited_by',
    ];

    // Attribute casting
    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'ada_genset' => 'boolean',
        'ada_tembok_batas' => 'boolean',
    ];
}
