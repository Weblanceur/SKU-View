<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\SkuItem;

use App\Models\City;
use App\MoonShine\Resources\CityResource;
use MoonShine\Fields\Image;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Fields\TinyMce;
use MoonShine\Pages\Crud\DetailPage;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Field;
use Throwable;

class SkuItemDetailPage extends DetailPage
{
    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            BelongsTo::make('Город', 'city', static fn (City $model) => $model->name, new CityResource()),
            Text::make(__('moonshine::content.item'), 'title'),
            Text::make(__('moonshine::content.barcode'), 'barcode'),
            Text::make(__('moonshine::content.vendor_code'), 'vendor_code'),
            TinyMce::make(__('moonshine::content.text'), 'text'),
            Image::make(__('moonshine::content.image'), 'image')->disk('public')->dir('images/items')
                ->allowedExtensions(['png', 'jpg', 'jpeg'])
        ];
    }

    /**
     * @return list<MoonShineComponent>
     * @throws Throwable
     */
    protected function topLayer(): array
    {
        return [
            ...parent::topLayer()
        ];
    }

    /**
     * @return list<MoonShineComponent>
     * @throws Throwable
     */
    protected function mainLayer(): array
    {
        return [
            ...parent::mainLayer()
        ];
    }

    /**
     * @return list<MoonShineComponent>
     * @throws Throwable
     */
    protected function bottomLayer(): array
    {
        return [
            ...parent::bottomLayer()
        ];
    }
}
