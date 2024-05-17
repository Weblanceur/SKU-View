<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use App\MoonShine\Pages\SkuItem\SkuItemIndexPage;
use App\MoonShine\Pages\SkuItem\SkuItemFormPage;
use App\MoonShine\Pages\SkuItem\SkuItemDetailPage;

use MoonShine\Attributes\Icon;
use MoonShine\Fields\Fields;
use MoonShine\Resources\ModelResource;
use MoonShine\Pages\Page;
use Smalot\PdfParser\Parser;

/**
 * @extends ModelResource<Item>
 */
#[Icon('heroicons.outline.table-cells')]
class SkuItemResource extends ModelResource
{
    protected string $model = Item::class;
    protected string $column = 'name';
    protected int $itemsPerPage = 10;

    public function save(Model $item, ?Fields $fields = null): Model
    {
        $item = parent::save($item, $fields);
        if ($item['pdf']) {
            $parser = new Parser();
            $pdf = $parser->parseFile(public_path('/storage/'.$item['pdf']));

            $text = $pdf->getText();
            $items = preg_split("/\n/", $text);
            $item['barcode'] = trim($items[0]);
            $item['title'] = trim($items[1]);
            $item['vendor_code'] = trim(preg_replace('/Артикул:/', '', $items[2]));
        }
        $item->save();
        return $item;
    }

    public function redirectAfterSave(): string
    {
        return to_page(resource: new SkuItemResource());
    }

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

    public function rules(Model $item): array
    {
        return [
            /*'image' => ['required'],
            'file' => ['required'],*/
        ];
    }

    public function search(): array
    {
        return ['title', 'barcode', 'vendor_code'];
    }
}
