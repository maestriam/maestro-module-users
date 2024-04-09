<div>    
    <x-content :header="__('users::module.title')">

        <x-alert />    
        
        <livewire:accounts.account-form wire:model="account" :entity="$user"/>
        
        @include('users::partials.user-password')
        
        @include('users::partials.user-inputs')
    
    </x-content>
</div>