<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\SkuItem;

use App\Models\City;
use App\MoonShine\Resources\CityResource;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\File;
use MoonShine\Fields\Image;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Fields\TinyMce;
use MoonShine\Pages\Crud\FormPage;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Field;
use Throwable;

class SkuItemFormPage extends FormPage
{
    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Grid::make([
                Column::make([
                    BelongsTo::make('Город', 'city', static fn (City $model) => $model->name, new CityResource()),
                ])->columnSpan(3),
                Column::make([
                    Text::make(__('moonshine::content.item'), 'title')->locked()->hideOnCreate(),
                ])->columnSpan(9),
                Column::make([
                    Text::make(__('moonshine::content.barcode'), 'barcode')->locked()->hideOnCreate(),
                ])->columnSpan(6),
                Column::make([
                    Text::make(__('moonshine::content.vendor_code'), 'vendor_code')->locked()->hideOnCreate(),
                ])->columnSpan(6),
                Column::make([
                    TinyMce::make(__('moonshine::content.text'), 'text')->required(),
                ]),
            ]),
            Grid::make([
                Column::make([
                    Image::make(__('moonshine::content.image'), 'image')->disk('public')->dir('images/items')
                        ->allowedExtensions(['png', 'jpg', 'jpeg'])->removable(),
                ])->columnSpan(6),
                Column::make([
                    File::make(__('moonshine::content.pdf'), 'pdf')->disk('public')->dir('pdf/items')
                        ->allowedExtensions(['pdf'])->removable(),
                ])->columnSpan(6),
            ]),
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
