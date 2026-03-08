<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    public function mutateFormDataBeforeCreate(array $data): array
    {
        $data['author_id'] = Auth::id();
        return $data;
    }
}
