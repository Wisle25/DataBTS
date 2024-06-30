<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;

    protected $table = "monitoring";

    // Mass assignable attributes
    protected $fillable = [
        'tahun',
        'id_bts',
        'tgl_generate',
        'tgl_kunjungan',
        'kondisi_bts',
        'id_user_surveyor',
        'created_by',
        'edited_by',
        'created_at',
        'edited_at'
    ];

    // Hidden attributes
    protected $hidden = [
        'created_by',
        'edited_by'
    ];

    // Attribute casting
    protected $casts = [
        'id_bts' => 'integer',
        'id_user_surveyor' => 'integer',
        'created_by' => 'integer',
        'edited_by' => 'integer',
        'created_at' => 'datetime',
        'edited_at' => 'datetime',
    ];

    // Define relationships
    public function bts()
    {
        return $this->belongsTo(BTS::class, 'id_bts');
    }
}
