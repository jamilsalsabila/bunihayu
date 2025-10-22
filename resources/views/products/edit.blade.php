@extends('../layouts/layout')

@section('title', $title)

@section('header')
    @include('../layouts/header')
@endsection

@section('content')

    <div class="parent container" style="margin-top: 50px">
        <div class="row ">
            <div class="d-grid gap-2 col-6 mx-auto">
                <form action="{{ url('product') }}" enctype="multipart/form-data" method="post" id="applications"
                    data-parsley-validate>
                    @method('patch')
                    @csrf
                    <!-- NAMA PRODUK -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('nama') is-invalid
                        @enderror" name="nama" id="nama" placeholder="" value="{{ old('nama', $data->nama) }}"
                            required>
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <label for="nama" class="form-label"> Nama Produk </label>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- HARGA -->
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control @error('harga') is-invalid
                        @enderror" name="harga" id="harga" placeholder="" value="{{ old('harga', $data->harga) }}"
                            required>
                        <label for="harga" class="form-label"> Harga </label>
                        @error('harga')
                            <div class="invalid-feedback"> {{ $message }}</div>
                        @enderror
                    </div>
                    <!-- KAPASITAS -->
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control @error('kapasitas') is-invalid
                        @enderror" name="kapasitas" id="kapasitas" placeholder=""
                            value="{{ old('kapasitas', $data->kapasitas) }}" required>
                        <label for="kapasitas" class="form-label"> Kapasitas </label>
                        @error('kapasitas')
                            <div class="invalid-feedback"> {{ $message }}</div>
                        @enderror
                    </div>
                    <!-- DESKRIPSI -->
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label"> deskripsi </label>
                        <textarea class="form-control @error('deskripsi') is-invalid
                        @enderror" name="deskripsi" id="deskripsi" placeholder=""
                            required>{{ old('deskripsi', $data->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback"> {{ $message }}</div>
                        @enderror
                    </div>
                    <!-- FASILITAS -->
                    <div class="mb-3">
                        <label for="fasilitas" class="form-label"> Fasilitas </label>
                        <textarea class="form-control @error('fasilitas') is-invalid
                        @enderror" name="fasilitas" id="fasilitas"
                            placeholder="">{{ old('fasilitas', $data->fasilitas) }}</textarea>
                        @error('fasilitas')
                            <div class="invalid-feedback"> {{ $message }}</div>
                        @enderror
                    </div>

                    <!-- TERSEDIA -->
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input type="checkbox" name="tersedia" id="tersedia" role="switch" class="form-check-input"
                                value="1" {{ old('tersedia', $data->tersedia == '1' ? 'checked' : '') }}>
                            <label for="tersedia" class="form-label"> Tersedia? </label>
                        </div>
                    </div>

                    <!-- FOTO -->
                    <div class="mb-3">
                        <label for="foto" class="form-label"> Foto </label>
                        <input type="file" class="form-control @error('foto') is-invalid
                        @enderror" name="foto" id="foto" accept="image/*" required>
                        @error('foto')
                            <div class="invalid-feedback"> {{ $message }}</div>
                        @enderror
                        @if ($data->foto)
                            <img src="{{ asset("storage/images/$data->foto") }}" alt="" height="200">
                        @else
                            <img src="{{ asset("storage/images/No_Image_Available.jpg") }}" alt="" height="200">
                        @endif
                    </div>
                    <!-- SUBMIT -->
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection

@section('footer')
    @include('../layouts/footer')
@endsection