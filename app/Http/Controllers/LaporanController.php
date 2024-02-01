<?php

namespace App\Http\Controllers;

use App\DataTables\LaporanDataTable;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LaporanDataTable $dataTable)
    {
        $title = 'Laporan Aset';
        $judul = 'Laporan Aset';
        return $dataTable->render('pages.laporan.index', compact('title', 'judul'));
    }

    public function export(LaporanDataTable $dataTable)
    {
        return $dataTable->excelCustom();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
