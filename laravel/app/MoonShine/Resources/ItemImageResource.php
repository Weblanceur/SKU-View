<?php

namespace App\MoonShine\Resources;

use App\Models\Item;
use App\Models\ItemImage;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Fields\Image;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Resources\ModelResource;

class ItemImageResource extends ModelResource
{
    protected string $model = ItemImage::class;

    public function title(): string
    {
        return __('moonshine::ui.resource.image');
    }

    public function fields(): array
    {
        return [
            BelongsTo::make('Item', 'items', resource: new Item()),
            Image::make(__('moonshine::content.images'), 'path')->disk('public')->dir('images/items')
                ->allowedExtensions(['png', 'jpg', 'jpeg'])->removable()->hideOnIndex(),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
