<x-filament::dropdown placement="bottom-end">
    {{-- Trigger button --}}
    <x-slot name="trigger">
        <button
            type="button"
            class="fi-icon-btn"
        >
            <x-filament::icon
                icon="heroicon-o-cog-8-tooth"
                class="h-6 w-6"
            />
        </button>
    </x-slot>

    {{-- Dropdown items --}}
    <x-filament::dropdown.list>
        <x-filament::dropdown.list.item
            tag="a"
            icon="heroicon-o-cog-6-tooth"
            href="{{ \App\Filament\Pages\Settings\SystemManagePage::getUrl() }}"
        >
            System Setting
        </x-filament::dropdown.list.item>

    </x-filament::dropdown.list>
</x-filament::dropdown>

