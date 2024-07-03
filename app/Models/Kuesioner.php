<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuesioner extends Model
{
    use HasFactory;

    protected $table = 'kuesioner';

    // Mass assignable attributes
    protected $fillable = [
        'subjek',
        'pertanyaan',
        'created_by',
        'edited_by',
    ];

    // Attribute casting
    protected $casts = [
        'created_by' => 'integer',
        'edited_by' => 'integer',
    ];

    // Relationships (if any)
    public function creator()
    {
        return $this->belongsTo(Pengguna::class, 'created_by');
    }

    public function editor()
    {
        return $this->belongsTo(Pengguna::class, 'edited_by');
    }

    public function answers()
    {
        return $this->hasMany(KuesionerJawaban::class, 'id_kuesioner');
    }

    public function bestAnswer()
    {
        return $this->hasOneThrough(
            KuesionerJawaban::class,
            PilihanKuesioner::class,
            'id_kuesioner', // Foreign key on PilihanKuesioner table
            'id', // Foreign key on KuesionerJawaban table
            'id', // Local key on Kuesioner table
            'id_kuesioner_jawaban' // Local key on PilihanKuesioner table
        );
    }
}
