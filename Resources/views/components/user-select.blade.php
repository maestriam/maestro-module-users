<x-select :name="'user-select[]'" :model="'selected'" :multiple="true" :id="'user-selected-id'" lazy >
    @if($this->users != null)
        @foreach($this->users as $user):
            <option value="{{ $user->id }}">
                {{ $user->firstName }} {{ $user->lastName }} <br/>
                ({{ '@'. $user->account()->name ?? ''}})
            </option>
        @endforeach
    @endif
</x-select> 