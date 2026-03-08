<?php

namespace App\Providers;

use Filament\Support\View\Components\ModalComponent;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ToggleButtons;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use App\Models\Post;
use App\Observers\PostObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::automaticallyEagerLoadRelationships();

        Post::observe(PostObserver::class);

        /* filament configuration */
        TextArea::configureUsing(fn(TextArea $textArea) =>
            $textArea
                ->columnSpanFull()
        );

        ToggleButtons::configureUsing(function(ToggleButtons $toggleButtons){
            $toggleButtons
                ->grouped()
                ->required();
        });

        DatePicker::configureUsing(fn(DatePicker $datePicker) =>
            $datePicker
                ->date()
                ->default(today())
                ->native(false)
                ->required()
        );

        FileUpload::configureUsing(fn(FileUpload $fileUpload) =>
        $fileUpload
            ->openable()
            ->columnSpanFull()
        );

        Table::configureUsing(function(Table $table){
            $table
                ->paginated([50, 100, 200, 'all'])
                ->extremePaginationLinks();
        });

        ModalComponent::closedByClickingAway(false);
    }
}
