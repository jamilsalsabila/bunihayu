<!DOCTYPE html>
<html lang="en" style="scroll-behavior: smooth;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bunihayu Forest</title>

    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Mapbox JS -->
    <script src="https://api.mapbox.com/mapbox-gl-js/v3.14.0/mapbox-gl.js"></script>
    <!-- Mapbox CSS -->
    <link href="https://api.mapbox.com/mapbox-gl-js/v3.14.0/mapbox-gl.css" rel="stylesheet" />

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>


    <!-- Local CSS -->
    <!-- <link rel="stylesheet" href="{{ asset('css/landing.css') }}"> -->
    <style>
        .checked {
            color: orange;
        }

        #map {
            height: 450px;
            width: 100%;
        }
    </style>
</head>

<body style=" zoom: 0.90; /* For Webkit and some other browsers */
  -moz-transform: scale(0.75); /* For Mozilla Firefox */
  -moz-transform-origin: top left; /* For Mozilla Firefox */
  margin-top: 70px;
  ">

    <div class="container h-100" style="width: 70%;">

        <!-- Navbar -->
        <div class="row" style="border-bottom: 1px solid #5555552d; padding-bottom: 30px; margin-bottom: 30px">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">

                <nav class="navbar justify-content-center text-center">

                    <a href="#">
                        <img src="{{ asset('storage/images/bunihayu-forest-logo-black.png') }}" class="d-block w-100">
                    </a>

                </nav>
            </div>
            <div class="col-sm-3"></div>
        </div>



        <!-- Hero section -->
        <div class="row justify-content-center text-center">
            <div class="col-sm-6 align-self-center">
                <h1>
                    <span>Reconnect with Nature ☘️</span> <br />
                </h1>

                <h5>
                    <span>Private Glamping & Hot Spring Getaway</span>
                </h5>
                <h1><span>⛺️</span></h1>
                <p class="lead">
                    &quot;Manjakan diri Anda dan jelajahi Bunihayu Forest sambil menikmati pemandangan hijau
                    sungai dan air terjun yang dapat menciptakan suasana yang menenangkan mendengar
                    nyanyian
                    merdu dari alam&QUOT;
                </p>
            </div>
        </div>

        @if (Auth::check())
            <div class="row justify-content-center text-center">
                <div class="col-sm-6 align-self-center">
                    <a href="{{ url('product') }}"><button class="btn btn-danger btn-md">List Product</button></a>
                </div>
            </div>
        @endif

        <!-- Roadmap -->

        <div class="d-flex" id="peta">
            <img src="{{ asset('storage/images/peta.png') }}" class="img-fluid">
        </div>


        <!-- <div class="row justify-content-center">
                <div class="col-sm-10">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe autofocus class="embed-responsive-item" src="{{ asset('video/video-bg.mp4') }}"
                            frameborder="1" allowfullscreen
                            style="width: fit-content; height: fit-content; aspect-ratio: 16 / 9;"></iframe>
                    </div>
                </div>
            </div> -->



        <!-- produk section -->
        <div class="row">
            <div class="col text-center">
                <h2>Wahana</h2>
            </div>
        </div>
        <div class="row" style="margin-bottom: 30px; margin-top: 30px;">
            <div class="col align-self-start"></div>
            <div class="col-lg-10 align-self-center">
                <div class="scrollable-div"
                    style="height: 600px; overflow-y: auto; border: 1px dotted #5555552d; padding: 5px;">

                    @php
                        $carousel = 1;
                    @endphp

                    @foreach ($products as $product)

                        <div class="d-flex justify-content-center">
                            <div class="card" style="width: 70%; height: auto;">
                                <div id="productCarousel{{ $carousel }}" class="carousel slide" data-ride="carousel"
                                    data-bs-target="#productCarousel{{ $carousel }}">
                                    <div class="carousel-inner" style="padding: 3px;">
                                        @php
                                            $n = 1;
                                        @endphp
                                        @foreach ($product->foto as $foto)
                                            <div class="carousel-item {{ $n == 1 ? 'active' : '' }}">
                                                <img class="d-block w-100 img-thumbnail"
                                                    src="{{ asset('storage/images') }}/{{ $product->nama }}/{{ $foto->nama }}"
                                                    alt="First slide">
                                            </div>
                                            {{ $n++ }}
                                        @endforeach
                                    </div>

                                    <a class="carousel-control-prev" href="#productCarousel{{ $carousel }}" role="button"
                                        data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#productCarousel{{ $carousel++ }}" role="button"
                                        data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">

                                        <a href="{{ url('product/show') }}/{{ $product->id }}">

                                            {{ $product->nama }}

                                        </a>

                                    </h5>
                                    <p class="card-text">{{ $product->deskripsi }}</p>

                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <p class="card-text">Kapasitas: {{ $product->kapasitas }} orang</p>
                                    </li>
                                </ul>
                                <div class="card-body">
                                    <span>
                                        <p>Rp. {{ number_format($product->harga, 2) }} / malam</p>
                                    </span>
                                    <a href="https://api.whatsapp.com/send?phone=6282320151391&text='Halo%20%F0%9F%91%8B,%20saya%20ingin%20booking%20%3C{{ $product->nama }}%3E,%20apakah%20masih%20tersedia?'"
                                        target="_blank" class="card-link"><button class="btn btn-primary btn-sm">Pesan Lewat
                                            whatsapp</button></a>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
            <div class="col align-self-end"></div>
        </div>


        <!-- Fasilitas section  -->
        <div class="row" style="margin-top: 30px;">
            <div class="col text-center">
                <h2>Fasilitas</h2>
            </div>
        </div>
        <div class="container text-center" style="width: 60%; margin-top: 30px;">
            @foreach ($fasilitas as $item)
                <div class="row" style="margin-bottom: 10px; margin-top: 10px; align-items: center;">
                    @foreach($item as $data)
                        <div class="col-sm">
                            <img src=" {{ asset('storage/images/fasilitas') }}/{{ $data["foto"] }}"
                                style="width: 30%; height: auto;">
                            <h4>{{ $data['nama'] }}</h4>
                        </div>
                    @endforeach

                </div>
            @endforeach

            <!-- <div class="row" style="margin-bottom: 30px; margin-top: 30px;">
                <div class="col-sm">
                    <img src="{{ asset('storage/images/barbecue.png') }}" style="width: 30%; height: auto;">
                    <h4>BBQ Package</h4>
                </div>
                <div class="col-sm">
                    <img src="{{ asset('storage/images/toilet.png') }}" style="width: 30%; height: auto;">
                    <h4>Toilet</h4>
                </div>
            </div> -->
        </div>


        <!-- Gallery section -->
        <div class="row" style="margin-top: 30px;">
            <div class="col text-center">
                <h2>Gallery</h2>
            </div>
        </div>
        <div class="d-flex float-right row">
            <div class="col-sm"></div>
            <div class="col-sm-6">
                <div id="gallery" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($gallery as $data)

                            <div class="carousel-item {{ $i++ == 1 ? 'active' : '' }}">
                                <img src="{{ asset('storage/images') }}/{{ $data->idproduk }}/{{ $data->nama }}"
                                    class="d-block w-100">
                            </div>

                        @endforeach
                    </div>
                    <button class=" carousel-control-prev" type="button" data-bs-target="#gallery" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#gallery" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-sm"></div>
        </div>

        <!-- Apa kata mereka -->
        <div class="row" style="margin-top: 30px;">
            <div class="col text-center">
                <h2>Apa Kata Mereka</h2>
            </div>
        </div>
        @foreach ($comments as $comment)
            <div class="row text-center">
                <div class="col-sm-3"></div>
                <div class="col-sm-6" style="border-bottom: 1px dashed #555;">
                    <span>
                        <p>{{ $comment->user->name }}</p>
                    </span>
                    <p>
                        @for ($i = 0; $i < $comment->rating; $i++)
                            <span class="fa fa-star checked"></span>
                        @endfor
                        @for ($i = $comment->rating; $i < 5; $i++)
                            <span class="fa fa-star"></span>
                        @endfor
                    </p>
                    <p>{{ $comment->konten }}</p>
                    </span>
                </div>
                <div class=" col-sm-3"></div>
            </div>
        @endforeach

        <!-- Contact us section -->
        <div class="row" style="margin-top: 30px;">
            <div class="col text-center">
                <h2 id="contactus">Kontak Kami</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6" style="border: 1px dotted #5555552d; padding: 10px">
                @if (session()->has('contactUsSuccess'))
                    <div class="alert alert-success">
                        <p>{{ session('contactUsSuccess') }}</p>
                    </div>
                @endif
                <form action="{{ url('contactus') }}" data-parsley-validate id="applications" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input class="form-control" type="email" name="email" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="hp">No. Hp (WA)</label>
                        <input class="form-control" type="text" name="hp" id="hp"
                            placeholder="dimulai dengan angka 0, contoh 0852xxx" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="pesan">Pesan</label>
                        <textarea class="form-control" name="pesan" id="pesan"></textarea>
                    </div>
                    <button class="btn btn-primary btn-sm">Kirim</button>
                </form>
            </div>
            <div class="col-sm-3"></div>
        </div>

        <!-- mapbox -->
        <div class="row" style="margin-top: 30px;">
            <div class="col text-center">
                <h2 id="lokasi">Lokasi</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">

                <!-- Mapbox -->
                <div id="map"></div>
                <div class="row justify-content-center">
                    <button class="btn btn-primary btn-sm" onclick="getNav()">Temukan rute</button>
                </div>
                <div class="row mt-3">
                    <div class="col">

                        <p>Jarak tempuh: <span id="distance"></span></p>
                    </div>
                    <div class="col">

                        <p>Waktu tempuh: <span id="duration"></span></p>
                    </div>
                </div>

            </div>
            <div class="col-sm-3"></div>
        </div>

        <!-- Social icons -->
        <div class="row" style="margin-top: 30px;">
            <div class="col text-center">
                <h2 id="lokasi">Temukan Kami</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 align-items-center">
                <div class="container d-flex justify-content-center align-items-center flex-column">
                    <table class="table">
                        <tbody>
                            <tr>
                                <img src="{{ asset('storage/images/instagram.png') }}" width="30">
                                <a href="https://www.instagram.com/bunihayu.forest/?hl=en">
                                    bunihayu.forest
                                </a>
                            </tr>
                            <tr>

                                <img src="{{ asset('storage/images/website.png') }}" width="30">
                                <a href="https://www.bunihayu.com/">
                                    https://www.bunihayu.com/
                                </a>

                            </tr>
                            <tr>

                                <img src="{{ asset('storage/images/whatsapp.png') }}" width="30">
                                <a href="https://wa.me/6285729296893">
                                    Admin
                                </a>


                            </tr>
                            <tr>

                                <img src="{{ asset('storage/images/email.png') }}" width="30">
                                <a href="mailto:RM.bunihayuforest@temp.co.id">email us</a>

                            </tr>
                            <tr>
                                <img src="{{ asset('storage/images/office-building.png') }}" width="30">
                                <a href="https://maps.app.goo.gl/uGyc94LTMFd5TvdZA" target="_blank">
                                    Alamat Kantor
                                </a>
                            </tr>

                            <tr>

                                @if(Auth::check())

                                    <img src="{{ asset('storage/images/close.png') }}" width="30">


                                    <a href="{{ url('logout') }}">Logout</a>

                                @else

                                    <img src="{{ asset('storage/images/login2.png') }}" width="30">

                                    <a href="{{ url('login') }}">Login</a>

                                @endif
                            </tr>

                        </tbody>
                    </table>

                </div>

            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>


    <script>
        // Leaflet Map

        // var map = L.map('map').setView([-6.6465303, 107.6719448], 13);
        // L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        //     maxZoom: 19,
        //     attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        // }).addTo(map);
        // var marker = L.marker([-6.6465303, 107.6719448]).addTo(map);


        // Mapbox Map

        mapboxgl.accessToken = "{{ config('mapbox.mapbox_token') }}";
        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v12',
            center: [107.6693699, -6.646525], // LongLat Bunihayu
            zoom: 12,
        });

        const marker = new mapboxgl.Marker().setLngLat([107.6693699, -6.646525]).addTo(map);

        // const bounds = [[108.6352581, -6.5960258], [107.3352581, -6.9860258]];
        // map.setMaxBounds(bounds);

        // const start = [107.6352581, -6.8960258]; // start, bisa diganti dengan koordinate posisi sekarang, [long, lat]
        const end = [107.6693699, -6.646525]; // LongLat Bunihayu (utara)
        //const end = [107.5005077, -7.0314948]; // LongLat Soreang  (selatan)
        //const end = [107.8667725, -6.85351]; // LongLat  Sumedang (timur)
        //const end = [107.8667725, -6.8222798]; // LongLat Cianjur (barat)
        //const end = [95.3124251, 5.5534109]; // LongLat Masjid Raya Baiturrahman


        function getNav() {
            if ("geolocation" in navigator) {
                // Geolocation is supported by the browser

                navigator.geolocation.getCurrentPosition(
                    // Success callback function
                    (position) => {
                        const latitude = position.coords.latitude;
                        const longitude = position.coords.longitude;
                        const accuracy = position.coords.accuracy; // Accuracy in meters

                        // console.log(`Latitude: ${latitude}`);
                        // console.log(`Longitude: ${longitude}`);
                        // console.log(`Accuracy: ${accuracy} meters`);

                        getRoute([longitude, latitude], end);

                        // You can now use these coordinates, e.g., display them on a map
                        // or send them to a server.
                    },
                    // Error callback function
                    (error) => {
                        switch (error.code) {
                            case error.PERMISSION_DENIED:
                                console.error("User denied the request for Geolocation.");
                                break;
                            case error.POSITION_UNAVAILABLE:
                                console.error("Location information is unavailable.");
                                break;
                            case error.TIMEOUT:
                                console.error("The request to get user location timed out.");
                                break;
                            case error.UNKNOWN_ERROR:
                                console.error("An unknown error occurred.");
                                break;
                        }
                    },
                    // Optional options object
                    {
                        enableHighAccuracy: true, // Request a more precise location
                        timeout: 5000, // Maximum time (in milliseconds) to wait for a location
                        maximumAge: 0 // Don't use a cached position, get a fresh one
                    }
                );

            } else {
                // Geolocation is not supported by the browser
                console.error("Geolocation is not supported by this browser.");
            }
        }

        async function getRoute(start, end) {

            let api = `https://api.mapbox.com/directions/v5/mapbox/driving/${start[0]},${start[1]};${end[0]},${end[1]}?steps=true&geometries=geojson&access_token=${mapboxgl.accessToken}`;

            const query = await fetch(api);

            const json = await query.json();

            const data = json.routes[0];

            const route = data.geometry;

            const geojson = {
                'type': 'Feature',
                'properties': {},
                'geometry': data.geometry
            };

            if (map.getSource('route')) {
                map.getSource('route').setData(geojson);
            } else {
                map.addLayer({
                    id: 'route',
                    type: 'line',
                    source: {
                        type: 'geojson',
                        data: geojson,
                    },
                    layout: {
                        'line-join': 'round',
                        'line-cap': 'round',
                    },
                    paint: {
                        'line-color': 'red',
                        'line-width': 5,
                        'line-opacity': 0.75
                    }
                });
            }

            //const [longM, latM] = haversineFormula(start, end)
            const [longM, latM] = naiveFormula(start, end);
            const distance = Math.floor(data['distance'] / 1000);
            const duration = data["duration"];
            const [h, m, s] = secondsToHMS(duration);

            let zoomLevel = 10; // default;


            if (distance >= 4000) {
                zoomLevel = 3; // you can see earth
            }
            else if (distance >= 2000) {
                zoomLevel = 4; // continent
            }
            else if (distance >= 1000) {
                zoomLevel = 5; // large island
            }
            else if (distance >= 100) {
                zoomLevel = 7;
            }
            else if (distance >= 70) {
                zoomLevel = 8;
            }
            else if (distance >= 40) {
                zoomLevel = 9;
            }
            else if (distance >= 20) {
                zoomLevel = 10;
            }
            else if (distance >= 10) {
                zoomLevel = 11;
            }
            else {
                zoomLevel = 12;
            }

            console.log(zoomLevel);

            map.easeTo({ center: [longM, latM], zoom: zoomLevel, duration: 5000 });

            document.getElementById('distance').innerHTML = `${distance} km`;

            document.getElementById('duration').innerHTML = `${h} jam ${m} menit`;

        }

        function naiveFormula(start, end) {
            const longM = (start[0] + end[0]) / 2;
            const latM = (start[1] + end[1]) / 2;
            return [longM, latM];
        }

        function secondsToHMS(totalSeconds) {
            const hours = Math.floor(totalSeconds / 3600);
            const minutes = Math.floor((totalSeconds / 60) % 60);
            const seconds = totalSeconds % 60;

            // Format the output with leading zeros if needed
            return [hours, minutes, seconds];

        }

        // function haversineFormula(start, end) {
        //     const alpha = end[0] - start[0];
        //     const bx = Math.cos(end[1]) * Math.cos(alpha);
        //     const by = Math.cos(end[1]) * Math.sin(alpha);

        //     const longM = Math.atan2(by, Math.cos(start[1]) + bx);
        //     const latM = Math.atan2(Math.sin(start[1]) + Math.sin(end[1]), Math.sqrt((Math.cos(start[1]) + bx) * (Math.cos(start[1]) + bx) + (by * by)));

        //     return [longM, latM];
        // }

    </script>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>



</body>

</html>