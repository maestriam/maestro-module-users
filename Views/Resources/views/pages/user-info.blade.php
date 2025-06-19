<x-content :header="__('users::module.title')">
    <x-row>
        <x-div :lg="8">
          <!-- profile-widget -->             
            <x-profile-widget 
                :name="$this->user->name()"
                :image="'img/avatar/avatar-1.png'" 
                :account="'@' . $this->user->account()->name" />
            <!-- /profile-widget -->    
        </x-div> 

        <x-div :lg="4">
            <x-users::user-detail :user="$this->user" />
        </x-div>

    </x-row>
</x-content>

