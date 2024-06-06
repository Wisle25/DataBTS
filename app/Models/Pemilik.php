<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    use HasFactory;

    protected $table = 'pemilik'; // Specify the table name

    // Mass assignable attributes
    protected $fillable = [
        'name',
        'alamat',
        'telepon',
        'created_by',
        'edited_by',
    ];

    // Attribute casting
    protected $casts = [
        'created_by' => 'integer',
        'edited_by' => 'integer',
    ];

    // Relationships
    public function creator()
    {
        return $this->belongsTo(Pengguna::class, 'created_by');
    }

    public function editor()
    {
        return $this->belongsTo(Pengguna::class, 'edited_by');
    }
}