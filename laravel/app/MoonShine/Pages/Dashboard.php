<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Models\Article;
use App\Models\City;
use App\Models\Comment;
use App\Models\Item;
use App\Models\User;
use App\MoonShine\Pages\SkuItem\SkuItemIndexPage;
use App\MoonShine\Resources\SkuItemResource;
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\Layout\Search;
use MoonShine\Components\TableBuilder;
use MoonShine\Decorations\Divider;
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\LineBreak;
use MoonShine\Fields\Text;
use MoonShine\Metrics\ValueMetric;
use MoonShine\Models\MoonshineUser;
use MoonShine\Pages\Page;
use MoonShine\Components\MoonShineComponent;
use MoonShine\TypeCasts\ModelCast;

class Dashboard extends Page
{
    /**
     * @return array<string, string>
     */
    public function breadcrumbs(): array
    {
        return [
            '#' => $this->title()
        ];
    }

    public function title(): string
    {
        return $this->title ?: 'Главная';
    }

    /**
     * @return list<MoonShineComponent>
     */
    public function components(): array
	{
		return [
            Grid::make([
                ValueMetric::make('Пользователей')->value(MoonshineUser::count())->columnSpan(4)->icon('heroicons.outline.users'),
                ValueMetric::make('Городов')->value(City::count())->columnSpan(4)->icon('heroicons.outline.building-office'),
                ValueMetric::make('Товаров')->value(Item::count())->columnSpan(4)->icon('heroicons.outline.table-cells'),
            ]),
            /*TableBuilder::make(items: Item::paginate())
                ->fields([
                    Text::make(__('moonshine::content.item'), 'title'),
                    Text::make(__('moonshine::content.barcode'), 'barcode'),
                    Text::make(__('moonshine::content.vendor_code'), 'vendor_code'),
                ])
                ->cast(ModelCast::make(Item::class)),*/
        ];
	}
}
