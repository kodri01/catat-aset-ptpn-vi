<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lokasi extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'id_aset',
        'lokasi',
        'penanggung_jawab',
        'kontak',
        'keterangan',
    ];

    public function aset()
    {
        return $this->belongsTo(Aset::class, 'id_aset');
    }
}
