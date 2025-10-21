@extends('../layouts/layout')

@section('title', $title)


@section('header')
    @include('../layouts/header')
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset("css/rating.css") }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <div class="parent container" style="margin-top: 150px;">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="row d-flex align-items-start">
            <div class="col-lg-5">
                @if ($data->foto)
                    <img src="{{ asset("storage/images/$data->foto") }}" alt="" height="200">
                @else
                    <img src="{{ asset("storage/images/No_Image_Available.jpg") }}" alt="" height="200">
                @endif
            </div>
            <div class="col-lg-7">
                <a href="{{ url('product') }}">kembali</a>
                <div class="row align-items-start">
                    <div class="col-md-3">
                        Nama
                    </div>

                    <div class="col-md-9">
                        <h3> {{ $data->nama }} </h3>
                    </div>
                    <div class="col-md-3">
                        Deskripsi
                    </div>
                    <div class="col-md-9">
                        <p class="lead"> {{ $data->deskripsi}} </p>
                    </div>
                    <div class="col-md-3">
                        Harga
                    </div>
                    <div class="col-md-9">
                        <p class="lead"> Rp. {{ number_format($data->harga, 2)}} </p>
                    </div>
                    <div class="col-md-3">
                        Kapasitas
                    </div>
                    <div class="col-md-9">
                        <p class="lead"> {{ $data->kapasitas}} </p>
                    </div>
                    <div class="col-md-3">
                        Fasilitas
                    </div>
                    <div class="col-md-9">
                        <ul class="list-unstyled">

                            @foreach (array_filter(explode(",", $data->fasilitas)) as $item)
                                <li class="list-item">
                                    <p class="lead">&#9745; {{ $item }}
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- rating -->
                    <div class="col-md-3">
                        Rating
                    </div>
                    <div class="col-md-9">
                        @php
                            $n = 0;
                            $total = 0;
                            foreach ($comments as $item) {
                                $total = $total + intval($item->rating);
                                $n++;
                            }
                            $rating = number_format($total / ($n + 0.00001), 1);
                        @endphp
                        @if ($rating >= 3.5)
                            <span
                                style="background-color: #97e47dff; font-weight: 650; padding-top: 6px; padding-bottom: 6px; padding-left: 10px; padding-right: 10px;">
                                {{ $rating }}
                                / 5 </span>
                        @elseif ($rating >= 2.5)
                            <span
                                style="background-color: #e4dd7dff; font-weight: 650; padding-top: 6px; padding-bottom: 6px; padding-left: 10px; padding-right: 10px;">{{  $rating }}
                                / 5 </span>
                        @else
                            <span
                                style="background-color: #e47d7dff; font-weight: 650; padding-top: 6px; padding-bottom: 6px; padding-left: 10px; padding-right: 10px;">
                                {{ $rating }} / 5 </span>
                        @endif
                    </div>

                </div>
            </div>
        </div>
        <div class="row d-flex align-items-start" style="margin-top: 40px; border-top: 1px #000 solid;">
            COMMENTS

            @if (Auth::check())
                <p>{{  auth()->user()->name }}</p>
                <form action="{{ url('product/show') }}/{{ $data->id }}" method="post" id="applications" data-parsley-validate>
                    @csrf
                    @method('post')
                    <div class="form-floating mb-3">

                        <div class="star-rating animated-stars @error('rating') is-invalid
                        @enderror">
                            <input type="radio" id="star5" name="rating" value="5">
                            <label for="star5" class="bi bi-star-fill"></label>
                            <input type="radio" id="star4" name="rating" value="4">
                            <label for="star4" class="bi bi-star-fill"></label>
                            <input type="radio" id="star3" name="rating" value="3">
                            <label for="star3" class="bi bi-star-fill"></label>
                            <input type="radio" id="star2" name="rating" value="2">
                            <label for="star2" class="bi bi-star-fill"></label>
                            <input type="radio" id="star1" name="rating" value="1">
                            <label for="star1" class="bi bi-star-fill"></label>
                            <!-- <input type="hidden" name="rating" id="star0" value="0"> -->
                        </div>
                        @error('rating')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <textarea name="konten" id="konten" style="padding: 10px" class="@error('konten') is-invalid
                        @enderror"></textarea>
                        @error('konten')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <button type=" submit" class="btn btn-primary btn-sm">Kirim</button>
                    </div>
                </form>
            @else
                <p class="text-muted">You must be logged in to post a comment.</p>
                <div class="row d-flex align-items-start mb-3">
                    <div class="col-sm-3">
                        <a href="{{ url('login') }}" class="btn btn-primary btn-sm child-element w-100">Login</a>
                    </div>
                </div>

                <div class="row d-flex align-items-start mb-3">
                    <div class="col-sm-3">
                        <a href="{{ url('register') }}" class="btn btn-secondary btn-sm child-element w-100">Register</a>
                    </div>
                </div>
            @endif
        </div>
        <div class="container" style="margin-bottom: 30px;">
            @if(!$comments->isNotEmpty())
                <p>No comment yet</p>
            @else

                @foreach ($comments as $item)
                    <div class="row d-flex align-items-start">
                        <div class="col-md-4">
                            {{  $item->user->name }}
                        </div>
                        <div class="col-md-4">

                            @for ($i = 1; $i <= intval($item->rating); $i++)
                                <span class="fa fa-star checked"></span>
                            @endfor
                            @for ($i = 1; $i <= 5 - intval($item->rating); $i++)

                                <span class="fa fa-star" style="color: #ccc;"></span>
                            @endfor

                        </div>
                        <div class="col-md-4">
                            {{  $item->konten }}
                        </div>
                    </div>

                @endforeach

            @endif
        </div>
    </div>
    </div>

    </div>
    <script>
        document.querySelectorAll('.star-rating:not(.readonly) label').forEach(star => {
            star.addEventListener('click', function () {
                this.style.transform = 'scale(1.2)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 200);
            });
        });
    </script>
@endsection

@section('footer')
    @include('../layouts/footer')
@endsection