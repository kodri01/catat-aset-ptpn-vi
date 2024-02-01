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
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Informasi Penyusutan Aset</h4>
                    </div>
                    <div class="card-body">
                        @foreach ($penyusutan as $key => $susut)
                            <ul class="list-unstyled list-unstyled-border">
                                <li class="media">
                                    <div class="media-body">
                                        <div class="media-title">{{ $susut->aset->nama_aset }} {{ $susut->aset->brand }}
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-2">
                                                </span><span class="text-small text-muted"> Tanggal Perolehan : <br>
                                                    {{ \Carbon\Carbon::parse($susut->aset->tgl_peroleh)->format('d F Y') }}</span>
                                            </div>
                                            <div class="col-sm-2">
                                                <span class="text-small text-muted">Harga Aset : <br>
                                                    {{ 'Rp ' . number_format($susut->aset->harga_peroleh, 0, ',', '.') }}
                                                </span>
                                            </div>
                                            <div class="col-sm-2">
                                                </span><span class="text-small text-muted"> Penyusutan Pertahun : <br>
                                                    {{ $susut->penyusutan_pertahun }}</span>
                                            </div>
                                            <div class="col-sm-2">
                                                <span class="text-small text-muted">Nilai Penyusutan : <br>
                                                    {{ 'Rp ' . number_format($susut->nilai_penyusutan, 0, ',', '.') }}
                                                </span>
                                            </div>
                                            <div class="col-sm-2">
                                                <span class="text-small text-muted">Nilai Pelepasan : <br>
                                                    {{ 'Rp ' . number_format($susut->nilai_pelepasan, 0, ',', '.') }}
                                                </span>
                                            </div>
                                            <div class="col-sm-2">
                                                <span class="text-small text-muted">Nilai Buku : <br>
                                                    {{ 'Rp ' . number_format($susut->nilai_buku, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                        <div class="text-center mt-5 pb-1">
                            <a href="{{ route('penyusutan') }}" class="btn btn-primary  btn-round">
                                Lihat Semua Penyusutan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
