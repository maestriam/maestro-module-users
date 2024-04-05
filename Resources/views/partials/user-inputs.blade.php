<x-content-card :title="'Dados do usuário'">
    <x-row>
        <x-form-group :cols="6">
            <x-input 
                :model="'firstName'" 
                :name="'firstName'" 
                :label="__('users::forms.first-name')" />
        </x-form-group>        
            
        <x-form-group :cols="6">
            <x-input 
                :model="'lastName'" 
                :name="'lastName'"
                :label="__('users::forms.last-name')" />
        </x-form-group>   
        
        <x-form-group :cols="6">
            <x-input 
                :type="'email'" 
                :model="'email'" 
                :name="'email'"
                :label="__('users::forms.email')" />
        </x-form-group>
    </x-row>    

    <x-slot:footer>
        <x-button :click="'back'">
            {{ __('users::buttons.back') }}            
        </x-button>
        <x-button :click="'save'" :class="'primary'">
            {{ __('users::buttons.save') }}
        </x-button>
    </x-slot>    
</x-content-card>