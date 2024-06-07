<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuesioner extends Model
{
    use HasFactory;

    protected $table = "kuesioner";

    // Mass assignable attributes
    protected $fillable = [
        'pertanyaan',
        'created_by',
        'edited_by',
    ];

    // Attribute casting
    protected $casts = [
        'created_by' => 'integer',
        'edited_by' => 'integer',
    ];
}