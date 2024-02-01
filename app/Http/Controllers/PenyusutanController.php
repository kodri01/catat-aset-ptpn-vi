<?php

namespace App\Http\Controllers;

use App\DataTables\PenyusutanDataTable;
use App\Models\Aset;
use App\Models\Penyusutan;
use Illuminate\Http\Request;

class PenyusutanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PenyusutanDataTable $dataTable)
    {
        $title = 'Penyusutan Aset';
        $judul = 'Penyusutan Aset';
        return $dataTable->render('pages.penyusutan.index', compact('title', 'judul'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Penyusutan $penyusutan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = 'Edit Penyusutan Aset';
        $judul = 'Edit Penyusutan Aset';
        $penyusutan = Penyusutan::with('aset')->find($id);
        return view('pages.penyusutan.edit', compact('title', 'judul', 'penyusutan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $penyusutan = Penyusutan::find($id);

        $tahunPemakaian = $request->tahun;
        $harga = $request->harga;
        $penyusutanTahun = $request->nilai_penyusutan;

        $nilai_buku = $harga - ($tahunPemakaian * $penyusutanTahun);
        $nilai_pelepasan = $harga - $nilai_buku;


        $penyusutan->update([
            'nilai_pelepasan' => $nilai_pelepasan,
            'nilai_buku' => $nilai_buku,
            'tahun_pakai' => $tahunPemakaian,
        ]);

        return redirect()->route('penyusutan')
            ->with('success', 'Aset Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penyusutan $penyusutan)
    {
        //
    }
}
