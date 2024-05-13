<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Models\Article;
use App\Models\City;
use App\Models\Comment;
use App\Models\Item;
use MoonShine\Decorations\Grid;
use MoonShine\Metrics\ValueMetric;
use MoonShine\Models\MoonshineUser;
use MoonShine\Pages\Page;
use MoonShine\Components\MoonShineComponent;

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
        ];
	}
}
