<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'id_kondisi_bts',
        'id_user',
        'created_by',
        'edited_by',
        'created_at',
        'edited_at'
    ];

    // Attribute casting
    protected $casts = [
        'id_bts' => 'integer',
        'id_user' => 'integer',
        'created_at' => 'datetime',
        'edited_at' => 'datetime',
    ];

    // Define relationships
    public function bts()
    {
        return $this->belongsTo(BTS::class, 'id_bts');
    }
    public function kondisi_bts()
    {
        return $this->belongsTo(KondisiBts::class, 'id_kondisi_bts');
    }
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_user');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (Auth::check()) {
                $model->created_by = Auth::user()->username;
                $model->edited_by = Auth::user()->username;
                $model->created_at = Carbon::now()->setTimezone('Asia/Jakarta');
                $model->updated_at = Carbon::now()->setTimezone('Asia/Jakarta');
            }
        });

        static::updating(function ($model) {
            if (Auth::check()) {
                $model->edited_by = Auth::user()->username;
                $model->updated_at = Carbon::now()->setTimezone('Asia/Jakarta');
            }
        });
    }
}
