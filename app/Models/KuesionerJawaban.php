<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuesionerJawaban extends Model
{
    use HasFactory;

    protected $table = 'kuesioner_jawaban';

    // Mass assignable attributes
    protected $fillable = [
        'id_kuesioner',
        'jawaban',
        'created_by',
        'edited_by',
    ];

    // Attribute casting
    protected $casts = [
        'id_kuesioner' => 'integer',
        'created_by' => 'integer',
        'edited_by' => 'integer',
    ];

    // Relationships
    public function kuesioner()
    {
        return $this->belongsTo(Kuesioner::class, 'id_kuesioner');
    }

    public function creator()
    {
        return $this->belongsTo(Pengguna::class, 'created_by');
    }

    public function editor()
    {
        return $this->belongsTo(Pengguna::class, 'edited_by');
    }
}
