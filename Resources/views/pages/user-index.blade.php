<x-content 
    :padding="0"
    :header="__('users::module.title')" 
    :title="__('users::module.name')" 
    :subtitle="__('users::module.description')" >    

    <livewire:users.components.table />

</x-content>

@push('scripts')
    <script src="{{ asset('maestro/users/js/modal.js') }}"></script>
@endpush