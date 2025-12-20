@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center align-items-center my-5">
        <div class="col-12 col-md-6 col-lg-4">

            <div class="card shadow-sm border-0 p-4">

                <h3 class="fw-semibold mb-2 text-center">Sign Up</h3>
                <p class="text-muted text-center mb-4">Create your account to get started!</p>

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
                    <div class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted small">
                        Or
                    </div>
                </div>

                <!-- Register Form -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label fw-medium">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                            placeholder="Enter your name">
                        <x-input-error :messages="$errors->get('name')" class="mt-1 small text-danger" />
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label fw-medium">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                            placeholder="info@gmail.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-1 small text-danger" />
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label fw-medium">Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Enter your password">
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password')">
                                Show
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1 small text-danger" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label class="form-label fw-medium">Confirm Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control" placeholder="Confirm your password">
                            <button class="btn btn-outline-secondary" type="button"
                                onclick="togglePassword('password_confirmation')">
                                Show
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 small text-danger" />
                    </div>

                    <!-- Terms -->
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="terms">
                        <label class="form-check-label small">
                            I agree to the
                            <a href="#" class="text-primary">Terms & Conditions</a>
                            and
                            <a href="#" class="text-primary">Privacy Policy</a>
                        </label>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                        Sign Up
                    </button>
                </form>

                <p class="text-center mt-4 small">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-primary fw-semibold">Sign In</a>
                </p>

            </div>

        </div>
    </div>

    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
@endsection
