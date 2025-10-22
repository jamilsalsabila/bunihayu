@extends('layouts/layout')

@section('title', $title)

@section('header')
    @include('layouts/header')
@endsection

@section('content')
    <div class="container" style="margin-top: 70px;">
        <div class="row">
            <div class="col-sm-3">

                <a href="{{ url('gallery') }}">kembali</a>

                <form action="{{ url('gallery') }}" method="post" id="applications" data-parsley-validate
                    enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <input type="hidden" name="fotolama" value="{{ $data->foto }}">
                        <input type="text" class="form-control @error('nama') is-invalid
                        @enderror" name="nama" id="nama" value="{{ old('nama', $data->nama) }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control @error('foto') is-invalid
                        @enderror" name="foto" id="foto" accept="image/*" required>
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <img src="{{ asset('storage/images/gallery') }}/{{ $data->foto }}"
                            style="height: auto; width: 30%;">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">edit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('layouts/footer')
@endsection