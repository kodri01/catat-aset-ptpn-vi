<?php

namespace App\Http\Controllers;

use App\DataTables\AsetDataTable;
use App\Models\Aset;
use App\Models\Kategori;
use App\Models\Lokasi;
use App\Models\Penyusutan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AsetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AsetDataTable $dataTable)
    {
        $title = 'Data Aset';
        $judul = 'Data Aset';
        return $dataTable->render('pages.aset.index', compact('title', 'judul'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Data Aset';
        $judul = 'Tambah Data Aset';
        $kategori = Kategori::get();
        return view('pages.aset.add', compact('title', 'judul', 'kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'nama_aset' => 'required',
            'brand' => 'required',
            'harga' => 'required',
            'umur_aset' => 'required',
            'tgl_peroleh' => 'required',
            'qty' => 'required',
            'lokasi' => 'required',
            'penanggung_jawab' => 'required',
            'kontak' => 'required',
            'keterangan' => 'required',
        ];

        $messages = [
            'nama_aset.required'  => 'Nama Aset wajib diisi',
            'brand.required'  => 'Merek Aset wajib diisi',
            'harga.required'  => 'Harga Aset wajib diisi',
            'umur_aset.required'  => 'Massa Pakai Aset wajib diisi',
            'tgl_peroleh.required'  => 'Tanggal Peroleh wajib diisi',
            'qty.required'  => 'Banyak Aset wajib diisi',
            'lokasi.required'  => 'Lokasi Aset wajib diisi',
            'penanggung_jawab.required'  => 'yang Bertanggung Jawab wajib diisi',
            'kontak.required'  => 'Kontak Orang yang Bertanggung Jawab wajib diisi',
            'keterangan.required'  => 'Keterangan wajib diisi',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $count = Aset::count();
        $awal = 'K3PN6';
        $tengah = date('Y');
        $akhir = str_pad($count + 1, 5, 'AC00', STR_PAD_LEFT);
        $kode_aset = $awal . $tengah . $akhir;

        $harga = $request->harga;
        $umur = $request->umur_aset;


        $aset = Aset::create([
            'id_kategori' => $request->kategori,
            'kode_aset' => $kode_aset,
            'nama_aset' => $request->nama_aset,
            'brand' => $request->brand,
            'umur_aset' => $umur,
            'harga_peroleh' => $harga,
            'tgl_peroleh' => $request->tgl_peroleh,
            'qty' => $request->qty,
            'kondisi' => 'Baik',
        ]);

        Lokasi::create([
            'id_aset' => $aset->id,
            'lokasi' => $request->lokasi,
            'penanggung_jawab' => $request->penanggung_jawab,
            'kontak' => $request->kontak,
            'keterangan' => $request->keterangan,
        ]);

        $pertahun = 100 / $umur;
        $persen = 1 / $umur;
        $penyusutan = $harga * $persen;

        $format_pertahun = number_format($pertahun) . '%';

        Penyusutan::create([
            'id_aset' => $aset->id,
            'tgl_peroleh' => $request->tgl_peroleh,
            'harga_peroleh' => $harga,
            'penyusutan_pertahun' => $format_pertahun,
            'nilai_penyusutan' => $penyusutan,
            'nilai_pelepasan' => 0,
            'nilai_buku' => 0,
        ]);

        return redirect()->route('aset')
            ->with('success', 'Aset Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $title = 'Details Aset';
        $judul = 'Details Aset';
        $kategori = Kategori::get();
        $aset = Aset::with('lokasi', 'penyusutan')->find($id);

        return view('pages.aset.show', compact('title', 'judul', 'aset',  'kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = 'Edit Data Aset';
        $judul = 'Edit Data Aset';
        $kategori = Kategori::get();
        $aset = Aset::find($id);
        $lokasi = $aset->lokasi;

        return view('pages.aset.edit', compact('title', 'judul', 'aset', 'lokasi', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'nama_aset' => 'required',
            'brand' => 'required',
            'harga' => 'required',
            'umur_aset' => 'required',
            'tgl_peroleh' => 'required',
            'qty' => 'required',
            'lokasi' => 'required',
            'penanggung_jawab' => 'required',
            'kontak' => 'required',
            'keterangan' => 'required',
        ];

        $messages = [
            'nama_aset.required'  => 'Nama Aset wajib diisi',
            'brand.required'  => 'Merek Aset wajib diisi',
            'harga.required'  => 'Harga Aset wajib diisi',
            'umur_aset.required'  => 'Massa Pakai Aset wajib diisi',
            'tgl_peroleh.required'  => 'Tanggal Peroleh wajib diisi',
            'qty.required'  => 'Banyak Aset wajib diisi',
            'lokasi.required'  => 'Lokasi Aset wajib diisi',
            'penanggung_jawab.required'  => 'yang Bertanggung Jawab wajib diisi',
            'kontak.required'  => 'Kontak Orang yang Bertanggung Jawab wajib diisi',
            'keterangan.required'  => 'Keterangan wajib diisi',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $aset = Aset::find($id);
        $lokasi = Lokasi::where('id_aset', $id)->first();
        $susut = Penyusutan::where('id_aset', $id)->first();

        $umur = $request->umur_aset;
        $harga = $request->harga;

        $aset->update([
            'id_kategori' => $request->kategori,
            'nama_aset' => $request->nama_aset,
            'brand' => $request->brand,
            'umur_aset' => $umur,
            'harga_peroleh' => $harga,
            'tgl_peroleh' => $request->tgl_peroleh,
            'qty' => $request->qty,
            'kondisi' => $request->kondisi,
        ]);

        $lokasi->update([
            'id_aset' => $aset->id,
            'lokasi' => $request->lokasi,
            'penanggung_jawab' => $request->penanggung_jawab,
            'kontak' => $request->kontak,
            'keterangan' => $request->keterangan,
        ]);

        $pertahun = 100 / $umur;
        $persen = 1 / $umur;
        $penyusutan = $harga * $persen;

        $format_pertahun = number_format($pertahun) . '%';

        $susut->update([
            'id_aset' => $aset->id,
            'harga_peroleh' => $harga,
            'penyusutan_pertahun' => $format_pertahun,
            'nilai_penyusutan' => $penyusutan,
        ]);



        return redirect()->route('aset')
            ->with('success', 'Aset Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $aset = Aset::find($id);

        // Hapus data terkait dari relasi 'lokasi'
        if ($aset->lokasi) {
            $aset->lokasi->delete();
        }

        // Hapus data terkait dari relasi 'penyusutan'
        if ($aset->penyusutan) {
            $aset->penyusutan->delete();
        }

        // Hapus aset
        $aset->delete();
        return redirect()->route('aset')
            ->with('error', 'Aset Deleted Successfully');
    }
}
