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

                            <ul class="list-unstyled list-unstyled-border">
                                <li class="media">
                                    <div class="media-body">
                                        <div class="media-title text-uppercase"><b>{{ $aset->nama_aset }}
                                                {{ $aset->brand }}</b></div>
                                        <div class="row my-3">
                                            <div class="col-sm-4">
                                                <span class="">Kode Aset : <br>
                                                    <label for=""
                                                        class="badge badge-info">{{ $aset->kode_aset }}</label>
                                                </span>
                                            </div>
                                            <div class="col-sm-4">
                                                </span><span class=""> Tanggal Peroleh : <br>
                                                    {{ \Carbon\Carbon::parse($aset->tgl_peroleh)->format('d F Y') }}</span>
                                            </div>

                                            <div class="col-sm-4">
                                                </span><span class=""> Quantity : <br>
                                                    {{ $aset->qty }} </span>
                                            </div>

                                        </div>
                                        <div class="row my-4">

                                            <div class="col-sm-4">
                                                <span class="">Harga Aset : <br>
                                                    {{ 'Rp ' . number_format($aset->harga_peroleh, 0, ',', '.') }}
                                                </span>
                                            </div>
                                            <div class="col-sm-4">
                                                </span><span class=""> Massa Pakai : <br>
                                                    {{ $aset->umur_aset }} Tahun</span>
                                            </div>
                                            <div class="col-sm-4">
                                                @if ($aset->kondisi == 'Baik')
                                                    </span><span class=""> Kondisi : <br>
                                                    </span>
                                                    <span class="badge rounded-pill bg-success">
                                                        {{ $aset->kondisi }}</span>
                                                @elseif ($aset->kondisi == 'Rusak Ringan')
                                                    </span><span class=""> Kondisi : <br>
                                                    </span>
                                                    <span class="badge rounded-pill bg-warning">{{ $aset->kondisi }}</span>
                                                @else
                                                    </span><span class=""> Kondisi : <br>
                                                    </span>
                                                    <span class="badge rounded-pill bg-danger">{{ $aset->kondisi }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row my-4">
                                            <div class="col-sm-4">
                                                </span><span class=""> Penyusutan Pertahun : <br>
                                                    {{ $aset->penyusutan->penyusutan_pertahun }}</span>
                                            </div>
                                            <div class="col-sm-4">
                                                </span><span class=""> Nilai Penyusutan : <br>
                                                    {{ 'Rp ' . number_format($aset->penyusutan->nilai_penyusutan, 0, ',', '.') }}
                                                </span>
                                            </div>
                                            <div class="col-sm-4">
                                                </span><span class=""> Nilai Pelepasan : <br>
                                                    {{ 'Rp ' . number_format($aset->penyusutan->nilai_pelepasan, 0, ',', '.') }}
                                                </span>
                                            </div>

                                        </div>
                                        <div class="row my-4">
                                            <div class="col-sm-4">
                                                </span><span class=""> Nilai Buku : <br>
                                                    {{ 'Rp ' . number_format($aset->penyusutan->nilai_buku, 0, ',', '.') }}
                                                </span>
                                            </div>
                                            <div class="col-sm-4">
                                                </span><span class=""> Lokasi Aset : <br>
                                                    {{ $aset->lokasi->lokasi }}</span>
                                            </div>
                                            <div class="col-sm-4">
                                                </span><span class=""> Penanggung Jawab : <br>
                                                    {{ $aset->lokasi->penanggung_jawab }}</span>
                                            </div>

                                        </div>
                                        <div class="row my-4">
                                            <div class="col-sm-4">
                                                </span><span class=""> Kontak : <br>
                                                    {{ $aset->lokasi->kontak }}</span>
                                            </div>
                                            <div class="col-sm-4">
                                                </span><span class=""> Keterangan : <br>
                                                    {{ $aset->lokasi->keterangan }}</span>
                                            </div>
                                        </div>

                                    </div>
                                </li>
                            </ul>
                            <!-- penutup Tambah Data -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
