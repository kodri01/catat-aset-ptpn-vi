@extends('layouts.main')

@section('content')
    <section class="section">

        <div class="section-header">
            <h1>{{ $judul }}</h1>
        </div>
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-columns"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Aset</h4>
                        </div>
                        <div class="card-body">
                            {{ $aset }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-fw fa-check-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Kondisi Baik</h4>
                        </div>
                        <div class="card-body">
                            {{ $baik }}

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-fw fa-exclamation-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Kondisi Rusak Ringan</h4>
                        </div>
                        <div class="card-body">
                            {{ $ringan }}

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-fw fa-times-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Kondisi Rusak Berat</h4>
                        </div>
                        <div class="card-body">
                            {{ $berat }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Kondisi Aset</h4>
                    </div>
                    <div class="card-body">
                        @foreach ($kondisi as $key => $berat)
                            <ul class="list-unstyled list-unstyled-border">
                                <li class="media">
                                    <div class="media-body">
                                        <div class="media-title">{{ $berat->nama_aset }} {{ $berat->brand }}</div>
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <span class="text-small text-muted">Harga Aset : <br>
                                                    {{ 'Rp ' . number_format($berat->harga_peroleh, 0, ',', '.') }}
                                                </span>
                                            </div>
                                            <div class="col-sm-2">
                                                </span><span class="text-small text-muted"> Massa Pakai : <br>
                                                    {{ $berat->umur_aset }} Tahun</span>
                                            </div>
                                            <div class="col-sm-2">
                                                </span><span class="text-small text-muted"> Penanggung Jawab : <br>
                                                    {{ $berat->lokasi->penanggung_jawab }}</span>
                                            </div>
                                            <div class="col-sm-3">
                                                </span><span class="text-small text-muted"> Kontak : <br>
                                                    {{ $berat->lokasi->kontak }}</span>
                                            </div>
                                            <div class="col-sm-3">
                                                @if ($berat->kondisi == 'Baik')
                                                    </span><span class="text-small text-muted"> Kondisi : <br>
                                                    </span>
                                                    <span class="badge rounded-pill bg-success">
                                                        {{ $berat->kondisi }}</span>
                                                @elseif ($berat->kondisi == 'Rusak Ringan')
                                                    </span><span class="text-small text-muted"> Kondisi : <br>
                                                    </span>
                                                    <span
                                                        class="badge rounded-pill bg-warning">{{ $berat->kondisi }}</span>
                                                @else
                                                    </span><span class="text-small text-muted"> Kondisi : <br>
                                                    </span>
                                                    <span class="badge rounded-pill bg-danger">{{ $berat->kondisi }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                        <div class="text-center mt-5 pb-1">
                            <a href="{{ route('aset') }}" class="btn btn-primary  btn-round">
                                Lihat Semua Aset
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
