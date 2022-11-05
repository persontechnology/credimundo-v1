<x-guest-layout>
    <div class="card text-center">
        <div class="card-header">
            {{ config('app.name') }}
        </div>
        <div class="card-body">
            <h4 class="card-title">Créditos para todo el mundo.!</h4>
        </div>
        <div class="card-footer text-muted text-center">
            {{ date('Y') }}
        </div>
    </div>
</x-guest-layout>
