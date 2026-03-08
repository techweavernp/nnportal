<div>
    <x-filament::button
        icon="heroicon-o-trash"
        wire:click="clearCache"
        color="danger"
    >
        Clear Application Cache
    </x-filament::button>

    <x-filament::button
        icon="heroicon-o-sparkles"
        wire:click="optimize"
        color="info"
        class="ml-10"
    >
        Optimize Application
    </x-filament::button>

</div>
