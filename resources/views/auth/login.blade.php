@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center my-5">
    <div class="col-12 col-md-6 col-lg-4">

        <div class="card shadow-sm border-0 p-4">

            <h3 class="fw-semibold mb-2 text-center">Sign In</h3>
            <p class="text-muted text-center mb-4">Enter your email and password to sign in!</p>

            <!-- Social Buttons -->
            <div class="row g-2 mb-3">
                <div class="col-6">
                    <button class="btn btn-light w-100 d-flex align-items-center justify-content-center gap-2 border">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" width="20">
                        Google
                    </button>
                </div>
                <div class="col-6">
                    <button class="btn btn-light w-100 d-flex align-items-center justify-content-center gap-2 border">
                        <img src="https://www.svgrepo.com/show/475689/x.svg" width="20">
                        X
                    </button>
                </div>
            </div>

            <div class="position-relative my-3">
                <hr>
                <div class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted small">Or</div>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" placeholder="info@gmail.com">
                    <x-input-error :messages="$errors->get('email')" class="mt-1 small text-danger" />
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Password <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Enter your password">
                        <button class="btn btn-outline-secondary" type="button"
                            onclick="togglePassword()">Show</button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1 small text-danger" />
                </div>

                <!-- Remember + Forgot -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember">
                        <label class="form-check-label">Keep me logged in</label>
                    </div>

                    @if (Route::has('password.request'))
                        <a href="/reset-password.html" class="small text-primary">Forgot password?</a>
                    @endif
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                    Sign In
                </button>

            </form>

            <p class="text-center mt-4 small">
                Don’t have an account?
                <a href="{{ route('register') }}" class="text-primary fw-semibold">Sign Up</a>
            </p>

        </div>

    </div>
</div>

<script>
function togglePassword() {
    let pass = document.getElementById("password");
    pass.type = pass.type === "password" ? "text" : "password";
}
</script>

@endsection
