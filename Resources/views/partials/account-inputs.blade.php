<x-content-card :title="'Dados do usuário'" :class="'card-primary mb-0'">   
    <x-row>        

        <x-form-group :cols="6">
            <x-input 
                :label="'Nome da conta'" 
                :model="'accountName'" 
                :name="'accountName'" 
                :readonly="$this->isEdition()"
            />
        </x-form-group>                         
        
        @if($this->isEdition() == false)
            <x-form-group :cols="6">
                <x-input 
                    :label="'Senha'" 
                    :type="'password'" 
                    :model="'password'" 
                    :name="'password'" 
                />
            </x-form-group>              
            
            <x-form-group :cols="6">
                <x-input 
                    :label="'Confirmar senha'" 
                    :type="'password'" 
                    :model="'passwordConfirm'" 
                />
            </x-form-group>  
        @endif

    </x-row>
</x-content-card>