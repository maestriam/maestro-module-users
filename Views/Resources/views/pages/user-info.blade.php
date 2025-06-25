<x-content :header="__('users::module.title')">
    <x-row>
        <x-div :lg="8">
          <!-- profile-widget -->             
            <x-profile-widget 
                :name="$this->user->name()"
                :email="$this->user->email"
                :image="'img/avatar/avatar-1.png'" 
                :createdAt="ddmmYYYY($this->user->createdAt)"
                :account="'@' . $this->user->account()->name" />
            <!-- /profile-widget -->    
        </x-div>           
    </x-row>

    @isset($this->slots['widget'])
    <livewire:admin:widget-row
        :components="$this->slots['widget']" 
        :props="$this->props()" />
    @endisset

</x-content>

