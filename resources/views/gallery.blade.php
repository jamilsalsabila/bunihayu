@extends('layouts/layout')

@section('title', $title)

@section('header')
    @include('layouts/header')
@endsection

@section('content')
    <div class="container" style="margin-top: 70px;">
        <a href="{{ url('product') }}">kembali</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Foto</th>
                    <th scope="col">aksi</th>
                </tr>
            </thead>
            <tbody>
                <div class="alert alert-warning">
                    <h3>Sedang dalam pengembangan</h3>
                </div>
                @php
                    $line = 1;
                @endphp

                @foreach ($data as $item)
                    <tr>
                        <th scope="row">{{ $line++ }}</th>
                        <td> {{ $item->nama }}</td>
                        <td> <img src="{{ asset('storage/images') }}/{{ $item->idproduk }}/{{ $item->foto }}"
                                style="height: auto; width: 10%;"></td>
                        <td>

                            <a href="#" style="color: blue">edit</a>
                            <br /><br />
                            <form action="#" method="post" id="applications" data-parsley-validate
                                onsubmit="if(!confirm('apakah anda ingin menghapus gallery ini?')){return false;}">
                                @method('delete')
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <button type="submit" class="btn btn-danger btn-sm">hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if (!$data->isNotEmpty())
            <p>Belum ada gallery</p>
        @endif


        <div class="alert alert-warning">
            <h3>Sedang dalam pengembangan</h3>
        </div>
        <!-- Form tambah gallery -->
        <div class="row">
            <div class="col-sm-3">
                <form action="#" method="post" id="applications" data-parsley-validate enctype="multipart/form-data">
                    @method('post')
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid
                        @enderror" name="nama" id="nama" value="{{ old('nama') }}" required disabled>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control @error('foto') is-invalid
                        @enderror" name="foto" id="foto" accept="image/*" required disabled>
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm" disabled>tambah</button>
                </form>
            </div>
        </div>

    </div>
@endsection

@section('footer')
    @include('layouts/footer')
@endsection