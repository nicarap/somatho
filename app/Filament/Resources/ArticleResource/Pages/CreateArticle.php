<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ArticleResource;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $data["slug"] = Str::slug($data["title"]);

        return static::getModel()::create($data);
    }
}
