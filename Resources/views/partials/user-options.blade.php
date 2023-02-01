<div class="table-links">

    <a  href="{{ route('maestro.users.view', $id) }}">{{ __('users::buttons.view') }}</a>
    
    <div class="bullet"></div>
    
    <a href="{{ route('maestro.users.edit', $id) }}">{{ __('users::buttons.edit') }}</a>
    
    <div class="bullet"></div>
    
    <a href="#" wire:click="remove({{$id}})" class="text-danger">{{ __('users::buttons.delete') }}</a>

</div>
