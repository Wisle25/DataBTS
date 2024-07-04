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
        'path_foto',
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
//     public function created_by_user()
// {
//     return $this->belongsTo(Pengguna::class, 'created_by_user_id');
// }

// public function edited_by_user()
// {
//     return $this->belongsTo(Pengguna::class, 'edited_by_user_id');
// }


    // Define relationships
    public function jenisBts()
    {
        return $this->belongsTo(JenisBts::class, 'id_jenis_bts');
    }

    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'id_pemilik');
    }

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'id_wilayah');
    }

    public function monitoring()
    {
        return $this->hasMany(Monitoring::class, 'id_bts');
    }
}
