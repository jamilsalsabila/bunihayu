@extends('layouts/layout')

@section('title', $title)

@section('header')
    @include('layouts/header')
@endsection

@section('content')
    <div class="container" style="margin-top: 150px;">
        @foreach ($data as $item)
            <div class="row">
                <div class="col">
                    <a href="{{ uri("product/show/$item->id") }}">
                        {{ $item->nama }}
                    </a>
                </div>
                <div class="col">{{ $item->deskripsi }}</div>
                <div class="col">{{ $item->harga }}</div>
            </div>
        @endforeach
    </div>
@endsection

@section('footer')
    @include('layouts/footer')
@endsection