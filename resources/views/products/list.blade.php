@extends('../layouts/layout')

@section('title', $title)

@section('header')
    @include('../layouts/header')
@endsection

@section('content')
    <main style="margin-top:71px;">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="container">
            @can('onlyadmin')
            <div style="margin-bottom: 20px;">
                
            <!-- Produk -->
                    <button class="btn btn-md" style="background-color: #640D5F; color: whitesmoke;" onclick="document.location='{{ url('product/create') }}'">Tambah produk
                    </button>
                
                <!-- Fasilitas -->
                    <button class="btn btn-md" style="background-color: #B12C00; color: whitesmoke;" onclick="document.location='{{ url('fasilitas') }}'"> Tambah fasilitas</button>
                
                
            <!-- Acara -->
                    <button role="link" class="btn btn-md" style="background-color: #EB5B00; color: whitesmoke;" onclick="document.location='{{ url('acara') }}'"> Tambah acara/event</button>
                
                
                <!-- gallery -->
                    <button class="btn btn-md" style="background-color: #FFCC00; color: black;" onclick="document.location='{{ url('gallery') }}'">Lihat g4|_|_3ry</button>
                
            </div>
            @endcan
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($data as $item)
                    <div class="col">
                        <div class="card h-100">  <!-- h-100 -->
                            <div class="embed-responsive embed-responsive-16by9" style="padding: 17px">
                            @if ($item->foto)
                                <img src="{{ asset("/storage/images") }}/{{ $item->nama }}/{{ $item->foto }}" class="card-img-top embed-responsive-item" style=".card-img-top {object-fit: cover;}">
                            @else
                                <img src="{{ asset('/storage/images') }}/No_Image_Available.jpg" class="card-img-top embed-responsive-item" style=".card-img-top {object-fit: cover;}">
                            @endif
                            </div>
                            
                            <div class="card-body">
                                <!-- nama -->
                                <h5 class="card-title" style="padding: 5px;"><a href="{{ url('product/show') }}/{{ $item->id }}">{{ $item->nama }}</a></h5>

                                <!-- deskripsi -->
                                <div style="width: 100%; height: 200px; overflow: auto; margin-bottom: 10px; padding: 5px; border: 1px solid #ccc">
                                {{ $item->deskripsi }} </div>

                                <!-- fasilitas -->

                                <!-- tersedia? -->
                                @if ($item->tersedia == '1')
                                    <div style="background-color: #41A67E;width: 100%; font-weight: bolder; color: white;"
                                        class="card-text"><p style="padding: 5px;">KOSONG</p></div>
                                @else
                                    <div style="background-color: #FF3F7F;width: 100%; font-weight: bolder; color: white;"
                                        class="card-text"><p style="padding: 5px;">TERISI</p></div>
                                @endif

                            </div>

                            @can('onlyadmin')
                                <div class="row" style="margin: 3px; padding: 3px">
                                    <div class="col">
                                        <a href="{{ url("product/edit") }}/{{ $item->id }}"><button class="btn btn-primary btn-sm"> Edit
                                            </button></a>
                                    </div>
                                    <div class="col">
                                        <form onsubmit="if(!confirm('apakah anda yakin mau menghapus data ini?')){return false;}"
                                            action="{{ url('product') }}" data-parsley-validate id="application" method="post">
                                            @method('delete')
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <button type="submit" class="btn btn-danger btn-sm"> Delete </button>
                                        </form>
                                    </div>
                                </div>
                            @endcan
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-center">
            {{ $data->links() }}
        </div>
    </main>

@endsection

@section('footer')
    @include('../layouts/footer')
@endsection