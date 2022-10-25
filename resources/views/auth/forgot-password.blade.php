<x-guest-layout>
    <!-- Password recovery form -->
    <form class="login-form" method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="card mb-0">
            <div class="card-body">
                <div class="text-center mb-3">
                    <div class="d-inline-flex bg-primary bg-opacity-10 text-primary lh-1 rounded-pill p-3 mb-3 mt-1">
                        <i class="ph-arrows-counter-clockwise ph-2x"></i>
                    </div>
                    <h5 class="mb-0">Recuperación de contraseña</h5>
                    <span class="d-block text-muted">
                        ¿Olvidaste tu contraseña? No hay problema. Simplemente háganos saber su dirección de correo electrónico y le enviaremos un enlace de restablecimiento de contraseña que le permitirá elegir una nueva.
                    </span>
                </div>
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <div class="mb-3">
                    <div class="form-floating form-control-feedback form-control-feedback-start">
                        <div class="form-control-feedback-icon">
                            <i class="ph-envelope-simple"></i>
                        </div>
                        <input name="email" value="{{ old('email') }}" type="text" class="form-control @error('email') is-invalid @enderror" autofocus>
                        <label>Email</label>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <i class="ph-arrow-counter-clockwise me-2"></i>
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
        </div>
    </form>
    <!-- /password recovery form -->
 </x-guest-layout>
 