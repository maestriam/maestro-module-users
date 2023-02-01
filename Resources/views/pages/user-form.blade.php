<div>    
    <x-content :header="'Módulo de usuários'">
    
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        
        @include('users::partials.account-inputs')
        
        @include('users::partials.user-inputs')
    
    </x-content>
</div>

@push('scripts')
    <script src="{{ asset('maestro/users/js/modal.js') }}"></script>
@endpush