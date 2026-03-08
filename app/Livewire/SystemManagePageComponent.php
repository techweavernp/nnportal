<?php

namespace App\Livewire;

use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Artisan;
use Livewire\Component;

class SystemManagePageComponent extends Component
{

    public function clearCache(): void
    {
        Artisan::call('cache:clear');

        Notification::make()
            ->title('Cache Cleared Successfully')
            ->success()
            ->send();
    }

    public function optimize(): void
    {
        Artisan::call('optimize:clear');

        Notification::make()
            ->title('Application Optimized')
            ->success()
            ->send();
    }

    public function render()
    {
        return view('livewire.system-manage-page-component');
    }
}
