<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aset extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'id_kategori',
        'kode_aset',
        'nama_aset',
        'brand',
        'umur_aset',
        'tgl_peroleh',
        'qty',
        'harga_peroleh',
        'kondisi',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function lokasi()
    {
        return $this->hasOne(Lokasi::class, 'id_aset');
    }

    public function penyusutan()
    {
        return $this->hasOne(Penyusutan::class, 'id_aset');
    }
}
