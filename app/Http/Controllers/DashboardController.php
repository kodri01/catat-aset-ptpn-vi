<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Lokasi;
use App\Models\Penyusutan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // public function __construct()
    // {
    //     # code...
    //     $this->middleware(['permission:dashboards']);
    // }

    public function index()
    {
        $title = 'Dashboard';
        $judul = 'Selamat Datang, ' . auth()->user()->name;
        $modelrole = DB::table('model_has_roles')->where('model_id', auth()->user()->id)->first();
        $role = Role::where('id', $modelrole->role_id)->first();

        if ($role->name == 'ketua' || $role->name == 'anggota') {
            $kondisi = Aset::with('lokasi')->orderByRaw("CASE WHEN kondisi = 'Rusak Berat' THEN 1 WHEN kondisi = 'Rusak Ringan' THEN 2 WHEN kondisi = 'Baik' THEN 3 ELSE 4 END")->get();
            $aset = Aset::count();
            $baik = Aset::where('kondisi', 'Baik')->count();
            $ringan = Aset::where('kondisi', 'Rusak Ringan')->count();
            $berat = Aset::where('kondisi', 'Rusak Berat')->count();
            return view('pages.dashboard.dashboardKetua', compact('title', 'judul', 'baik', 'ringan', 'berat', 'aset', 'kondisi'));
        } elseif ($role->name == 'bendahara') {
            $penyusutan = Penyusutan::with('aset')->orderBy('nilai_buku', 'desc')->get();
            return view('pages.dashboard.dashboardBendahara', compact('title', 'judul', 'penyusutan'));
        }

        // if ($role->name == 'superadmin') {
        //     $obrik = Obrik::count();
        //     $temuan = Temuans::count();
        //     $tindakan = TindakLanjut::count();
        //     $selesai = TindakLanjut::where('status_tl', 'Selesai')->count();
        //     $dalamProses = TindakLanjut::where('status_tl', 'Dalam Proses')->count();
        //     return view('pages.dashboard.index', compact('title', 'judul', 'obrik', 'temuan', 'tindakan', 'selesai', 'dalamProses'));
        // } else {
        //     $obrik = Obrik::where('wilayah_id', Auth::user()->wilayah_id)->count();
        //     $temuan = Temuans::where('wilayah_id', Auth::user()->wilayah_id)->count();
        //     $tindakan = TindakLanjut::where('wilayah_id', Auth::user()->wilayah_id)->count();
        //     $selesai = TindakLanjut::where('wilayah_id', Auth::user()->wilayah_id)->where('status_tl', 'Selesai')->count();
        //     $dalamProses = TindakLanjut::where('wilayah_id', Auth::user()->wilayah_id)->where('status_tl', 'Dalam Proses')->count();
        //     return view('pages.dashboard.index', compact('title', 'judul', 'obrik', 'temuan', 'tindakan', 'selesai', 'dalamProses'));
        // }
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
