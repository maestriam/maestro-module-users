<x-content-card :title="__('companies::cards.company-detail.title')" :class="'card-primary h-100'">
    
    <x-form-group :cols="0">
        <label for="sector-p">E-mail</label>
        <p id="sector-p" class="form-text">{{ $user->email }}</p>
    </x-form-group>

    <x-form-group :cols="0">
        <label for="sector-p">Data de criação</label>
        <p id="sector-p" class="form-text">{{ ddmmYYYY($user->createdAt, false) }}</p>
    </x-form-group>

</x-content-card>