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
                            <a href="{{ route('aset') }}" type="button"
                                class="btn btn-primary daterange-btn icon-left btn-icon">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                        <div class="card-body">
                            <!-- Tambah Data -->
                            <form action="{{ route('aset.store') }}" method="POST">
                                @csrf
                                <div class="modal-body row">
                                    <div class="section-title mb-4">Informasi Aset</div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="inputState">Kategori</label>
                                            <select id="inputState" class="form-control" name="kategori">
                                                <option selected disabled>- Pilih Kategori Aset -</option>
                                                @foreach ($kategori as $list)
                                                    <option value="{{ $list->id }}" class="text-capitalize">
                                                        {{ $list->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Nama Aset</label>
                                            <input type="text"
                                                class="form-control @error('nama_aset') is-invalid @enderror"
                                                name="nama_aset" autocomplete="off" value="{{ old('nama_aset') }}"
                                                placeholder="Masukan Nama Aset">
                                            @error('nama_aset')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Merek</label>
                                            <input type="text" class="form-control @error('brand') is-invalid @enderror"
                                                name="brand" autocomplete="off" value="{{ old('brand') }}"
                                                placeholder="Masukan Merek Aset">
                                            @error('brand')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Harga Aset</label>
                                            <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                                name="harga" autocomplete="off" value="{{ old('harga') }}"
                                                placeholder="Rp. 123.123.123">
                                            @error('harga')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Massa Pakai</label>
                                            <input type="number"
                                                class="form-control @error('umur_aset') is-invalid @enderror"
                                                name="umur_aset" autocomplete="off" value="{{ old('umur_aset') }}"
                                                placeholder="Massa Pakai Aset (Tahun)">
                                            @error('umur_aset')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Tanggal Peroleh</label>
                                            <input type="date"
                                                class="form-control @error('tgl_peroleh') is-invalid @enderror"
                                                name="tgl_peroleh" autocomplete="off" value="{{ old('tgl_peroleh') }}">
                                            @error('tgl_peroleh')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Qty</label>
                                            <input type="number" class="form-control @error('qty') is-invalid @enderror"
                                                name="qty" autocomplete="off" value="{{ old('qty') }}"
                                                placeholder="Banyak Aset (pcs)">
                                            @error('qty')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="section-title mb-4">Alokasi Aset</div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Lokasi Aset</label>
                                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror"
                                                name="lokasi" autocomplete="off" value="{{ old('lokasi') }}"
                                                placeholder="Lokasi Penempatan Aset">
                                            @error('lokasi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Penanggung Jawab</label>
                                            <input type="text"
                                                class="form-control @error('penanggung_jawab') is-invalid @enderror"
                                                name="penanggung_jawab" autocomplete="off"
                                                placeholder="Orang yang bertanggung Jawab"
                                                value="{{ old('penanggung_jawab') }}">
                                            @error('penanggung_jawab')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Kontak Person</label>
                                            <input type="number" class="form-control @error('kontak') is-invalid @enderror"
                                                name="kontak" autocomplete="off" value="{{ old('kontak') }}">
                                            @error('kontak')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                class="form-control @error('keterangan') is-invalid @enderror"
                                                name="keterangan" autocomplete="off" placeholder="Keterangan"
                                                value="{{ old('keterangan') }}">
                                            @error('keterangan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-whitesmoke gap-3">
                                        <a href="{{ route('kategori') }}" type="button"
                                            class="btn btn-danger">Batal</a>
                                        <button class="btn btn-primary" name="tambahData">Simpan</button>
                                    </div>
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
