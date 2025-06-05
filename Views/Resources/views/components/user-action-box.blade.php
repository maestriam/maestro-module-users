<div class="table-links">

    <a  href="#" wire:click="goToViewPage()">{{ __('users::buttons.view') }}</a>    
    <div class="bullet"></div>
    
    <a href="#" wire:click="goToEditionForm()">{{ __('users::buttons.edit') }}</a>    
    <div class="bullet"></div>
    
    <a href="#" wire:click="showDeleteModal()" class="text-danger">{{ __('users::buttons.delete') }}</a>
</div>
