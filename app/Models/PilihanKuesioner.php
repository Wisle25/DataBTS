<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PilihanKuesioner extends Model
{
    use HasFactory;

    protected $table = 'pilihan_kuesioner';

    protected $fillable = [
        'id_kuesioner',
        'id_kuesioner_jawaban',
        'created_by',
        'edited_by',
    ];
    
    public function kuesioner()
    {
        return $this->belongsTo(Kuesioner::class, 'id_kuesioner');
    }

    public function jawaban()
    {
        return $this->belongsTo(KuesionerJawaban::class, 'id_kuesioner_jawaban');
    }
}
