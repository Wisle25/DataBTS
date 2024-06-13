<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBTS extends Model
{
    use HasFactory;

    protected $table = "jenis_bts";

    // Mass assignable attributes
    protected $fillable = [
        'nama',
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
        'created_by' => 'integer',
        'edited_by' => 'integer',
        'created_at' => 'datetime',
        'edited_at' => 'datetime',
    ];

    // Define relationships
    public function bts()
    {
        return $this->belongsToMany(BTS::class);
    }
}
