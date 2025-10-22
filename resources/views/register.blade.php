@extends('../layouts/layout')

@section('title', $title)

@section('header')
    @include('../layouts/header')
@endsection

@section('content')
    <div class="container-md" style="margin-top: 100px;">
        <div class="row">
            <div class="col">
                <img src="{{ asset('storage/images/register.png') }}" style="width: 100%; height: auto;">
            </div>
            <div class="col text-end">
                <a href="{{ url()->previous()}}">Kembali</a>
            </div>
            <div class="col d-grid gap-2 col-6 mx-auto">
                <form action="{{ url('register') }}" method="post" id="applications" data-parsley-validate>
                    @method('post')
                    @csrf
                    <!-- name -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                            placeholder="" value="{{ old('name') }}" required>
                        <label for="name" class="form-label">Name</label>
                        @error('name')
                            <div class="invalid-feedback">{{ $message  }}</div>
                        @enderror
                    </div>
                    <!-- email -->
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control @error('email') is-invalid
                        @enderror" name="email" id="email" placeholder="" value="{{ old('email') }}" required>
                        <label for="email" class="form-label"> Email Address </label>
                        @error('email')
                            <div class="invalid-feedback">{{ $message  }}</div>
                        @enderror
                    </div>
                    <!-- password -->
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control @error('password') is-invalid
                        @enderror" name="password" id="password" placeholder="" required>
                        <label for="password" class="form-label"> Password </label>

                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="bi bi-eye-slash"></i> <!-- Initial icon for hidden password -->
                        </button>

                        @error('password')
                            <div class="invalid-feedback">{{ $message  }}</div>
                        @enderror
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
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
@endsection

@section('footer')
    @include('../layouts/footer')
@endsection