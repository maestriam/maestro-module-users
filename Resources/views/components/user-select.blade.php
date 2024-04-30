<x-select-filter :model="'user'" :name="'user'">
    @foreach($this->users as $user):
        <option value="1">
            {{ $user->firstName }} {{ $user->lastName }} <br/>
            ({{ $user->account()->name ?? 'nao tem'}})
        </option>
    @endforeach
</x-select-filter> 