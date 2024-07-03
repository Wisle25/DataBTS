<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KondisiBts extends Model
{
    protected $table = "kondisi_bts";

    // Mass assignable attributes
    protected $fillable = [
        'nama',
        'created_by',
        'edited_by',
        'created_at',
        'edited_at'
    ];

    public function monitoring()
    {
        return $this->hasMany(Monitoring::class, 'id_kondisi_bts');
    }
}
