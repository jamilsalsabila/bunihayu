@php
    date_default_timezone_set('Asia/Jakarta'); // Set your desired timezone

    $hour = date('G'); // 'G' returns the hour in 24-hour format (0-23) without leading zeros

    if ($hour >= 5 && $hour < 12) {
        $greeting = "Morning";
    } elseif ($hour >= 12 && $hour < 18) {
        $greeting = "Afternoon";
    } else {
        $greeting = "Evening";
    }

@endphp

<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
    <div class="navbar-nav">
        <div class="nav-item" style="color: aliceblue; margin-left: 30px; padding:5px">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="navbar-brand">
                <img src="{{ asset('/storage/images/logo-bunihayu.png') }}" width="200" height="40" class="img-fluid">
            </a>
        </div>
    </div>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <div class="navbar-nav mr-auto mt-2 mt-lg-0">
            @if (Auth::check())
                <div class="nav-item" style="color: aliceblue; margin-right: 10px;">
                    <p>Good {{ $greeting }}, {{ auth()->user()->name }}</p>
                </div>

                <div class="nav-item" style="color: aliceblue; margin-right: 10px;">
                    <p id="digitalClock"></p>
                </div>


            @else
                <div class="nav-item" style="color: aliceblue; margin-right: 10px;">

                    <p>Good {{ $greeting }}, Guest</p>
                </div>
            @endif

        </div>
    </div>


    @can('auth')
        <!-- Search -->
        <div class="navbar-nav">
            <div class="nav-item" style="color: aliceblue; padding: 5px; margin: auto">
                <a href="{{ url('product') }}" class="nav-link px-3">List of Product</a>
            </div>
            <div class="nav-item" style="margin-left: 100px; margin-right: 100px;">
                <form action="{{ uri('search') }}" method="post" data-parsley-validate id="applications">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <input type="text" name="query" id="query" class="form-control" aria-describedby="search"
                                placeholder="search...">
                            <i class="bi bi-search"></i>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endcan

    <div class="navbar-nav">
        <div class="nav-item text-nowrap" style="margin-left: 0px; margin-right: 40px;">
            @if (Auth::check())
                <a href="{{ url('logout') }}" class="nav-link px-3">Sign Out</a>
            @else
                <a href="{{ url('login') }}" class="nav-link px-3">Sign In</a>
            @endif
        </div>
    </div>
</nav>

<script>
    function updateClock() {
        const now = new Date();
        let hours = now.getHours();
        let minutes = now.getMinutes();
        let seconds = now.getSeconds();

        // Add leading zero if less than 10
        hours = hours < 10 ? '0' + hours : hours;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;

        const timeString = `${hours}:${minutes}:${seconds}`;
        document.getElementById('digitalClock').textContent = timeString;
    }

    // Update the clock every second
    setInterval(updateClock, 1000);

    // Initial call to display the clock immediately
    updateClock();

</script>