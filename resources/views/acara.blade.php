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
                    <th scope="col">Judul</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Flyer/Poster</th>
                    <th scope="col">Tanggal Mulai</th>
                    <th scope="col">Tanggal Selesai</th>

                    <th scope="col">aksi</th>
                </tr>
            </thead>
            <tbody>

                @php
                    $line = 1;
                @endphp

                @foreach ($data as $item)
                    <tr>
                        <th scope="row">{{ $line++ }}</th>
                        <td> {{ $item->judul }} </td>
                        <td> {{ $item->deskripsi }} </td>
                        <td>
                            <a href="{{ asset('storage/images/acara') }}/{{ $item->foto }}">
                                <img src="{{ asset('storage/images/acara') }}/{{ $item->foto }}"
                                    style="height: auto; width: 10%;">
                            </a>
                        </td>
                        <td> {{ $item->mulai }} </td>
                        <td> {{ $item->selesai }} </td>
                        <td>
                            <a href="{{ url('acara/edit') }}/{{ $item->id }}" style="color: blue">edit</a>
                            <br /><br />
                            <form action="{{ url('acara') }}" method="post" id="applications" data-parsley-validate
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
            <p>Belum ada acara/event</p>
        @endif


        <!-- Form tambah gallery -->
        <div class="row">
            <div class="col-sm-3">
                <form action="{{ url('acara') }}" method="post" id="applications" data-parsley-validate
                    enctype="multipart/form-data">
                    @method('post')
                    @csrf
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control @error('judul') is-invalid
                        @enderror" name="judul" id="judul" value="{{ old('judul') }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid
                        @enderror" name="deskripsi" id="deskripsi" value="{{ old('deskripsi') }}"></textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Flyer / Poster</label>
                        <input type="file" class="form-control @error('foto') is-invalid
                        @enderror" name="foto" id="foto" accept="image/*" required>
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- mulai acara -->
                    <div class="mb-3">
                        <label for="mulai" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control @error('mulai') is-invalid
                        @enderror" name="mulai" id="mulai" value="{{ old('mulai') }}" required>
                        @error('mulai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- selesai acara -->
                    <div class="mb-3">
                        <label for="selesai" class="form-label">Tanggal Selesai</label>
                        <input type="date" class="form-control @error('selesai') is-invalid
                        @enderror" name="selesai" id="selesai" value="{{ old('selesai') }}" required
                            onchange="validateDate()">
                        @error('selesai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div id="validatedate" style="color: orangered;"></div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">tambah</button>
                </form>
            </div>
        </div>

    </div>

    <script>
        function validateDate() {
            document.getElementById('validatedate').innerHTML = '';

            let hariini = new Date();
            let mulai = new Date(document.getElementById('mulai').value);
            let selesai = new Date(document.getElementById('selesai').value);

            console.log(mulai);
            console.log(selesai);

            console.log(selesai < mulai);

            if (mulai < hariini || selesai < mulai) {
                document.getElementById('validatedate').innerHTML = "Tanggal selesai harus lebih dari atau sama dengan tanggal mulai"
            }
        }
    </script>
@endsection

@section('footer')
    @include('layouts/footer')
@endsection