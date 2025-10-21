@extends('../layouts/layout')

@section('title', $title)

@section('header')
    @include('../layouts/header')
@endsection

@section('content')
    <div class="parent container" style="margin-top: 90px; ">
        <div class="row-sm-3"></div>
        <div class="row">
            <div class="col">
                <img src="{{ asset('storage/images/product-development.png') }}" style="width: 100%; height: auto;">
            </div>
            <div class="col text-end">
                <a href="{{ url('product') }}">Kembali</a>
            </div>
            <div class="col d-grid gap-2 col-6 mx-auto">
                <form action="{{ url('product') }}" enctype="multipart/form-data" method="post" id="applications"
                    data-parsley-validate>
                    @method('post')
                    @csrf
                    <!-- NAMA PRODUK -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama"
                            placeholder="" value="{{ old('nama') }}">
                        <label for="nama" class="form-label"> Nama Produk </label>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message  }}</div>
                        @enderror
                    </div>
                    <!-- HARGA -->
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control @error('harga') is-invalid
                        @enderror" name="harga" id="harga" placeholder="" value="{{ old('harga') }}">
                        <label for="harga" class="form-label"> Harga </label>
                        @error('harga')
                            <div class="invalid-feedback">{{ $message  }}</div>
                        @enderror
                    </div>
                    <!-- KAPASITAS -->
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control @error('kapasitas') is-invalid
                        @enderror" name="kapasitas" id="kapasitas" placeholder="" value="{{ old('kapasitas') }}">
                        <label for="kapasitas" class="form-label"> Kapasitas </label>
                        @error('kapasitas')
                            <div class="invalid-feedback">{{ $message  }}</div>
                        @enderror
                    </div>
                    <!-- DESKRIPSI -->
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label"> deskripsi </label>
                        <textarea class="form-control @error('deskripsi') is-invalid
                        @enderror" name="deskripsi" id="deskripsi" placeholder="">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message  }}</div>
                        @enderror
                    </div>
                    <!-- FASILITAS -->
                    <div class="mb-3">
                        <label for="fasilitas" class="form-label"> Fasilitas </label>
                        <textarea class="form-control @error('fasilitas') is-invalid
                        @enderror" name="fasilitas" id="fasilitas" placeholder="">{{ old('fasilitas') }}</textarea>
                        @error('fasilitas')
                            <div class="invalid-feedback">{{ $message  }}</div>
                        @enderror
                    </div>
                    <!-- FOTO -->
                    <div class="mb-3">
                        <label for="foto" class="form-label"> Foto </label>
                        <input type="file" class="form-control @error('foto') is-invalid
                        @enderror" name="foto" id="foto">
                        @error('foto')
                            <div class="invalid-feedback">{{ $message  }}</div>
                        @enderror
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection

@section('footer')
    @include('../layouts/footer')
@endsection