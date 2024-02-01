<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penyusutan extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'id_aset',
        'tahun_peroleh',
        'harga_peroleh',
        'penyusutan_pertahun',
        'nilai_penyusutan',
        'nilai_pelepasan',
        'nilai_buku',
        'tahun_pakai',
    ];

    public function aset()
    {
        return $this->belongsTo(Aset::class, 'id_aset');
    }
}
