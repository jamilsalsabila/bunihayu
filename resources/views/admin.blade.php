@extends('layouts/layout')

@section('header')
    @include('layouts/header')
@endsection

@section('content')
    @php
        date_default_timezone_set('Asia/Jakarta'); // Set your desired timezone

        $hour = date('G'); // 'G' returns the hour in 24-hour format (0-23) without leading zeros

        if ($hour >= 5 && $hour < 12) {
            $greeting = "Good Morning";
        } elseif ($hour >= 12 && $hour < 18) {
            $greeting = "Good Afternoon";
        } else {
            $greeting = "Good Evening";
        }

    @endphp
    <div class="container text-center">
        <div class="row">
            <div class="col align-self-center">
                <h3>{{ $greeting }}, Admin</h3>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('layouts/footer')
@endsection