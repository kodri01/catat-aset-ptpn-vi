<?php

namespace App\Http\Controllers;

use App\DataTables\CategoriesDataTable;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        # code...
        $this->middleware(['permission:kategori-list|kategori-create|kategori-edit|kategori-delete']);
    }

    public function index(CategoriesDataTable $dataTable)
    {
        $title = 'Kategori Aset';
        $judul = 'Kategori Aset';
        return $dataTable->render('pages.kategori.index', compact('title', 'judul'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Kategori Aset';
        $judul = 'Kategori Aset';
        return view('pages.kategori.add', compact('title', 'judul'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
        ];

        $messages = [
            'name.required'  => 'Nama Kategori wajib diisi',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Kategori::create([
            'name' => $request->name,
        ]);

        return redirect()->route('kategori')
            ->with('success', 'Kategori Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = 'Kategori Aset';
        $judul = 'Kategori Aset';
        $kategori = Kategori::find($id);

        return view('pages.kategori.edit', compact('title', 'judul', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
        ];

        $messages = [
            'name.required'  => 'Nama Kategori wajib diisi',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $kategori = Kategori::find($id);
        $kategori->update([
            'name' => $request->name,
        ]);
        return redirect()->route('kategori')
            ->with('success', 'Kategori Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Kategori::find($id)->delete();
        return redirect()->route('kategori')
            ->with('error', 'Kategori Deleted Successfully');
    }
}
