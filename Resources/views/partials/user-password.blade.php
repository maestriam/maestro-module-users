@if($this->isEdition() == false)
<x-content-card :title="__('users::cards.password')" :class="'mb-0'">   
    <x-row>
        <x-form-group :cols="6">
            <x-input 
                :label="'Senha'" 
                :type="'password'" 
                :model="'password'" 
                :name="'password'" />
        </x-form-group>             
        
        <x-form-group :cols="6">
            <x-input 
                :label="'Confirmar senha'" 
                :type="'password'" 
                :model="'passwordConfirm'" />
        </x-form-group>  
    </x-row>
</x-content-card>
@endif