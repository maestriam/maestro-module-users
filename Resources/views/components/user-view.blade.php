<x-content :header="$cardTitle">    
       
    <x-row>
        <x-user-card 
            :first-name="$user->firstName"
            :last-name="$user->lastName"
            :created-at="$user->createdAt"
            :account-name="$user->account()->name"
        />  
    </x-row>

</x-content>

