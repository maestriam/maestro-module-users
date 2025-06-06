<div lazy>
    <x-content 
        :padding="0"
        :title="__('users::module.name')" 
        :header="__('users::module.title')" 
        :subtitle="__('users::module.description')" >
    
        <x-content-card 
            :padding="0" 
            :class="'card-primary'"
            :title="__('users::cards.list-user')" >
            
            <x-slot:filters>
                <x-search-filter-input :placeholder="__('users::placeholders.search')"/> 
            </x-slot>   
            
            <x-slot:actions>         
                <a href="{{ route('maestro.users.create') }}" class="btn btn-primary">
                    {{ __('users::buttons.add') }}
                </a>
            </x-slot>   
            
            <x-table>
                <x-tr>
                    <x-th :cols="2">{{ __('users::tables.name') }}</x-th>
                    <x-th>{{ __('users::tables.email') }}</x-th>
                    <x-th>{{ __('users::tables.accountname') }}</x-th>
                    <x-th>{{ __('users::tables.created-at') }}</x-th>
                </x-tr>
                

                @if($users->isEmpty())
                    <x-tr>
                        <x-td :cols="5">
                            <x-admin::empty-state />
                        </x-td>
                    </x-tr>
                @else

                    @foreach($users as $user)                    
                        <x-tr>
                            <x-td width="10"><x-avatar :width="40"/></x-td>

                            <x-td>                                                       
                                {{ $user->firstName . ' ' . $user->lastName }}                                
                                <livewire:users.action-menu :user="$user" wire:key="{{ Str::uuid() }}" />
                            </x-td>
                            
                            <x-td>{{ $user->email }}</x-td>                            
                            <x-td>{{ '@'. $user->account()->name }}</x-td>                            
                            <x-td>{{ ddmmYYYY($user->createdAt) }}</x-td>            
                        </x-tr>
                    @endforeach
                @endif
            </x-table> 
            
            @if(! $users->isEmpty())
            <x-slot:footer>
                {{ $users->links() }}
            </x-slot:footer>
            @endif
            
        </x-content-card>
    
    </x-content>
</div>