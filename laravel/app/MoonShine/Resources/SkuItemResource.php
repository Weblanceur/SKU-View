<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use App\MoonShine\Pages\SkuItem\SkuItemIndexPage;
use App\MoonShine\Pages\SkuItem\SkuItemFormPage;
use App\MoonShine\Pages\SkuItem\SkuItemDetailPage;

use MoonShine\Attributes\Icon;
use MoonShine\Handlers\ExportHandler;
use MoonShine\Handlers\ImportHandler;
use MoonShine\Resources\ModelResource;
use MoonShine\Pages\Page;

/**
 * @extends ModelResource<Item>
 */
#[Icon('heroicons.outline.table-cells')]
class SkuItemResource extends ModelResource
{
    protected string $model = Item::class;
    protected string $column = 'name';
    protected int $itemsPerPage = 10;

    public function title(): string
    {
        return __('moonshine::ui.resource.content');
    }

    /**
     * @return list<Page>
     */
    public function pages(): array
    {
        return [
            SkuItemIndexPage::make($this->title()),
            SkuItemFormPage::make(
                $this->getItemID()
                    ? __('moonshine::ui.edit')
                    : __('moonshine::ui.add')
            ),
            SkuItemDetailPage::make(__('moonshine::ui.show')),
        ];
    }

    /**
     * @param Item $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'title' => ['required'],
            'barcode' => ['required'],
            'vendor_code' => ['required'],
        ];
    }

    public function search(): array
    {
        return ['title', 'barcode', 'vendor_code'];
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
