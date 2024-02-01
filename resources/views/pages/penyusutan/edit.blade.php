@extends('layouts.main')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1><?= $judul ?></h1>
        </div>


        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- <h4>Basic DataTables</h4> -->
                            <a href="{{ route('penyusutan') }}" type="button"
                                class="btn btn-primary daterange-btn icon-left btn-icon">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                        <div class="card-body">
                            <!-- Tambah Data -->
                            <form action="{{ route('penyusutan.update', $penyusutan->id) }}" method="POST">
                                @csrf
                                <div class="modal-body row">
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Nama Aset</label>
                                            <input type="text" class="form-control " disabled
                                                value="{{ $penyusutan->aset->nama_aset }}" autocomplete="off">

                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Harga Aset</label>
                                            <input type="text" class="form-control " disabled
                                                value="{{ 'Rp ' . number_format($penyusutan->harga_peroleh, 0, ',', '.') }}"
                                                autocomplete="off" placeholder="Masukan Nama Aset">
                                            <input type="hidden" name="harga" value="{{ $penyusutan->harga_peroleh }}">

                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Waktu Pembelian</label>
                                            <input type="text" class="form-control " disabled
                                                value="{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $penyusutan->tgl_perolehan)->format('d F Y') }}"
                                                autocomplete="off" placeholder="Masukan Nama Aset">

                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Penyusutan Pertahun</label>
                                            <input type="text" class="form-control " disabled
                                                value="{{ $penyusutan->penyusutan_pertahun }}" autocomplete="off">

                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Nilai Penyusutan</label>
                                            <input type="text" class="form-control" disabled
                                                value="{{ 'Rp ' . number_format($penyusutan->nilai_penyusutan, 0, ',', '.') }}">
                                            <input type="hidden" name="nilai_penyusutan"
                                                value="{{ $penyusutan->nilai_penyusutan }}">

                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Nilai Pelepasan</label>
                                            <input type="text" class="form-control " disabled
                                                value="{{ 'Rp ' . number_format($penyusutan->nilai_pelepasan, 0, ',', '.') }}"
                                                autocomplete="off" placeholder="Masukan Nama Aset">

                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Nilai Buku</label>
                                            <input type="text" class="form-control" disabled
                                                value="{{ 'Rp ' . number_format($penyusutan->nilai_buku, 0, ',', '.') }}"
                                                autocomplete="off" placeholder="Masukan Nama Aset">

                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Tahun Penggunaan Aset</label>
                                            @if (!empty($penyusutan->tahun_pakai))
                                                <input type="number"
                                                    class="form-control @error('tahun') is-invalid @enderror" name="tahun"
                                                    value="{{ $penyusutan->tahun_pakai }}" autocomplete="off"
                                                    placeholder="Masukan Tahun Penggunaan Aset">
                                                <span class="text-danger">* Lama Penggunaan Aset Setelah
                                                    Tahun
                                                    Pembelian</span>
                                            @else
                                                <input type="number"
                                                    class="form-control @error('tahun') is-invalid @enderror" name="tahun"
                                                    value="{{ old('tahun') }}" autocomplete="off"
                                                    placeholder="Masukan Tahun Penggunaan Aset">
                                                <span class="text-danger">* Lama Penggunaan Aset Setelah
                                                    Tahun
                                                    Pembelian</span>
                                            @endif
                                            @error('tahun')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer bg-whitesmoke gap-3">
                                    <a href="{{ route('kategori') }}" type="button" class="btn btn-danger">Batal</a>
                                    <button class="btn btn-primary" name="tambahData">Simpan</button>
                                </div>
                            </form>
                            <!-- penutup Tambah Data -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
