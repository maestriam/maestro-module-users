<x-content>    
    
    @isset($this->slots['widget'])
    <livewire:admin:widget-row
        :components="$this->slots['widget']" 
        :props="$this->props()" />
    @endisset
    
</x-content>