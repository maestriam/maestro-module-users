
<div>
    <x-content 
        :padding="0"
        :title="__('users::module.name')" 
        :header="__('users::module.title')" 
        :subtitle="__('users::module.description')" >
    
        <x-content-card :padding="0" :title="__('users::cards.list-user')">
            
            <x-slot:filters>
                <x-search-filter-input 
                :model="'search'" 
                :placeholder="__('users::placeholders.search')"
                /> 
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
                
                @foreach($users as $user)
                
                @if (! isset($user->id) || ! $user->account())
                @continue
                @endif
                
                <x-tr>
                    <x-td width="10">
                        <x-avatar :width="40"/>
                    </x-td>

                    <x-td>
                        {{ $user->firstName . ' ' . $user->lastName }}
                        @include('users::partials.user-options', ['id' => $user->id])
                    </x-td>
                    
                    <x-td>{{ $user->email }}</x-td>
                    
                    <x-td>{{ '@'. $user->account()->name }}</x-td>
                    
                    <x-td>{{ $user->createdAt }}</x-td>            
                </x-tr>
                @endforeach
            </x-table> 
            
            <x-slot:footer>
                {{ $users->links() }}
            </x-slot:footer>
            
        </x-content-card>
    
    </x-content>
</div>

@push('scripts')
    <script src="{{ asset('maestro/users/js/modal.js') }}"></script>
@endpush