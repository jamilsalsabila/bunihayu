<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(255, 255, 255, 0.1);
            border: solid rgba(255, 255, 255, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(255, 255, 255, .1), inset 0 .125em .5em rgba(255, 255, 255, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body class="text-center">
    <main class="form-signin w-100 m-auto">
        @if (session()->has('loginerror'))
            <div class="alert alert-danger face show">
                {{ session('loginerror') }}
            </div>
        @elseif(session()->has('success'))
            <div class="alert alert-success face show">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-flex mt-5 mb-5">

            <a href="{{ uri('/') }}"><img src="{{ asset('/storage/images/logo-bunihayu.png') }}" alt=""
                    class="img-fluid"></a>
        </div>
        <form data-parsley-validate id="applications" action="{{ url('login') }}" method="post">
            @csrf
            <h1 class="h3 mb-3 fw-normal">Sign In</h1>
            <div class="form-floating">
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid
                @enderror" placeholder="name@example.com" required>
                <label class="form-label" for="email">email address</label>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating">
                <input type="password" name="password" id="password" placeholder="password" class="form-control @error('password') is-invalid
                @enderror" required>
                <label class="form-label" for="password">password</label>
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                    <i class="bi bi-eye-slash"></i> <!-- Initial icon for hidden password -->
                </button>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <p>don't have account yet? <a href="{{ url('register') }}" style="color: white;">Register Here</a></p>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Masuk</button>

            <p class="mt-5 mb-3" style="color: aliceblue;">&copy; 2025 Website Pariwisata</p>
        </form>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

    <script>
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Toggle the eye icon

            this.querySelector('i').classList.toggle('bi-eye');
            this.querySelector('i').classList.toggle('bi-eye-slash');
        });
    </script>
</body>

</html>