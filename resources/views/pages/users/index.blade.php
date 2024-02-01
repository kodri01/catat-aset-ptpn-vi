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



        <div class="card">
            <div class="row">
                <div class="col-lg-12">
                    <a href="{{ route('users.add') }}" class="btn btn-primary float-right mt-3 mx-3">
                        <i class="fas fa-fw fa-plus"></i>
                        Data Users
                    </a>
                </div>

            </div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>

        </div>

    </section>

    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
@endSection;
