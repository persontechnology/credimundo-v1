<x-guest-layout>
    <!-- Password recovery form -->
    
        <div class="card mb-0">
            
                <div class="card-body">
                    <form class="login-form" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <div class="text-center mb-3">
                            <div class="d-inline-flex bg-primary bg-opacity-10 text-primary lh-1 rounded-pill p-3 mb-3 mt-1">
                                <i class="ph-arrows-counter-clockwise ph-2x"></i>
                            </div>
                            <h5 class="mb-0">Verificación de correo electrónico</h5>
                            <span class="d-block text-muted">
                                Antes de comenzar, ¿podría verificar su dirección de correo electrónico haciendo clic en el enlace que le acabamos de enviar? Si no recibiste el correo electrónico, con gusto te enviaremos otro.
                            </span>
                        </div>
                        @if (session('status') == 'verification-link-sent')
                            <div class="alert alert-primary" role="alert">
                                <strong>
                                    Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionó durante el registro.
                                </strong>
                            </div>
                        @endif

                        

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="ph-arrow-counter-clockwise me-2"></i>
                            {{ __('Reenviar correo electrónico de verificación') }}
                        </button>
                    </form>
                    <form method="POST" action="{{ route('logout') }}" class="my-2">
                        @csrf
        
                        <button type="submit" class="btn btn-yellow w-100">
                            {{ __('Logout') }}
                        </button>
                    </form>
                </div>
            
            
        </div>
    
    <!-- /password recovery form -->
 </x-guest-layout>
 