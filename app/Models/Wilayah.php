<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    use HasFactory;

    protected $table = 'wilayah';

    protected $fillable = [
        'nama',
        'id_parent',
        'level',
        'created_by',
        'edited_by',
        'created_at',
        'updated_at'
    ];

    public function bts()
    {
        return $this->hasMany(BTS::class);
    }

    // Relasi self-referential untuk parent dan children
    public function parent()
    {
        return $this->belongsTo(Wilayah::class, 'id_parent');
    }

    public function children()
    {
        return $this->hasMany(Wilayah::class, 'id_parent');
    }
}
