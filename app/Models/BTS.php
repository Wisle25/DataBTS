<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BTS extends Model
{
    use HasFactory;

    protected $table = 'bts';

    // Mass assignable attributes
    protected $fillable = [
        'nama',
        'alamat',
        'id_jenis_bts',
        'latitude',
        'longitude',
        'tinggi_tower',
        'panjang_tanah',
        'lebar_tanah',
        'ada_genset',
        'ada_tembok_batas',
        'id_user',
        'id_pemilik',
        'id_wilayah',
        'path_foto',
        'created_by',
        'edited_by',
    ];

    // Attribute casting
    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'ada_genset' => 'boolean',
        'ada_tembok_batas' => 'boolean',
    ];

    public function jenisBts()
    {
        return $this->belongsTo(JenisBts::class, 'id_jenis_bts');
    }

    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'id_pemilik');
    }

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'id_wilayah');
    }

    public function monitoring()
    {
        return $this->hasMany(Monitoring::class, 'id_bts');
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
