<?php

namespace App\MoonShine\Resources;

use App\Models\City;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Attributes\Icon;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Handlers\ExportHandler;
use MoonShine\Handlers\ImportHandler;
use MoonShine\Resources\ModelResource;

#[Icon('heroicons.outline.building-office')]
class CityResource extends ModelResource
{
    protected string $model = City::class;
    protected string $column = 'name';
    protected bool $isPrecognitive = true;
    protected int $itemsPerPage = 10;

    public function title(): string
    {
        return __('moonshine::ui.resource.city');
    }

    public function fields(): array
    {
        return [
            ID::make()->sortable(),
            Text::make(__('moonshine::ui.name'), 'name')->required(),
        ];
    }

    public function rules(Model $item): array
    {
        return [
            'name' => ['required'],
        ];
    }

    public function search(): array
    {
        return ['name'];
    }

    public function export(): ?ExportHandler
    {
        return null;
    }

    public function import(): ?ImportHandler
    {
        return null;
    }
}
