<div>    
    <x-content :header="__('users::module.title')">

        <x-alert />    
        
        <livewire:accounts.account-form wire:model="account" :entity="$user"/>
        
        @include('users::partials.account-inputs')
        
        @include('users::partials.user-inputs')
    
    </x-content>
</div>

@push('scripts')
    <script src="{{ asset('maestro/users/js/modal.js') }}"></script>
@endpush