<?php

declare(strict_types=1);

namespace App\Forms;

use MoonShine\Components\FormBuilder;
use MoonShine\Fields\Text;

final class SearchForm
{
    public static function make($search = ''): FormBuilder
    {
        return FormBuilder::make()
            ->fields([
                Text::make('Название, код, артикул товара', 'search')
                    ->customAttributes([
                        'autofocus' => true,
                        'autocomplete' => 'barcode',
                    ])
                    ->default($search)
            ])
            ->hideSubmit();
    }
}
