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

                <form action="{{ url('acara') }}" method="post" id="applications" data-parsley-validate
                    enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <input type="hidden" name="fotolama" value="{{ $data->foto }}">
                        <input type="text" class="form-control @error('judul') is-invalid
                        @enderror" name="judul" id="judul" value="{{ old('judul', $data->judul) }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid
                        @enderror" name="deskripsi" id="deskripsi">{{ $data->deskripsi }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control @error('foto') is-invalid
                        @enderror" name="foto" id="foto" accept="image/*">
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <img src="{{ asset('storage/images/acara') }}/{{ $data->foto }}" style="height: auto; width: 30%;">
                    </div>

                    <div class="mb-3">
                        <label for="mulai" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control @error('mulai') is-invalid
                        @enderror" name="mulai" id="mulai" value="{{ old('mulai', $data->mulai) }}" required>
                        @error('mulai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="selesai" class="form-label">Tanggal Selesai</label>
                        <input type="date" class="form-control @error('selesai') is-invalid
                        @enderror" name="selesai" id="selesai" value="{{ old('selesai', $data->selesai) }}" required
                            onchange="validateDate()">
                        @error('selesai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div id="validateselesai" style="color: orangered;"></div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm">edit</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function validateDate() {
            document.getElementById('validateselesai').innerHTML = '';

            let hariini = new Date();
            let mulai = new Date(document.getElementById('mulai').value);
            let selesai = new Date(document.getElementById('selesai').value);

            console.log(hariini);
            console.log(mulai);
            console.log(selesai);

            console.log(selesai < mulai);
            console.log(mulai < hariini);

            if (mulai < hariini || selesai < mulai) {
                document.getElementById('validateselesai').innerHTML = "Tanggal selesai harus lebih dari atau sama dengan tanggal mulai"
            }
        }
    </script>
@endsection

@section('footer')
    @include('layouts/footer')
@endsection