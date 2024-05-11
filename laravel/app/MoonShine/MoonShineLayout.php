<?php

declare(strict_types=1);

namespace App\MoonShine;

use MoonShine\Components\Layout\{Content,
    Flash,
    Footer,
    Header,
    LayoutBlock,
    LayoutBuilder,
    Menu,
    Profile,
    Search,
    Sidebar
};
use MoonShine\Components\When;
use MoonShine\Contracts\MoonShineLayoutContract;

final class MoonShineLayout implements MoonShineLayoutContract
{
    public static function build(): LayoutBuilder
    {
        $year = now()->year;
        $visibleDate = $year > 2024 ? "2024 - $year"  : '2024';
        return LayoutBuilder::make([
            Sidebar::make([
                Menu::make()->customAttributes(['class' => 'mt-2']),
                When::make(
                    static fn() => config('moonshine.auth.enable', true),
                    static fn() => [Profile::make(withBorder: true)]
                ),
            ]),
            LayoutBlock::make([
                Flash::make(),
                Header::make([
                    Search::make(),
                ]),
                Content::make(),
                Footer::make()
                    ->copyright(fn (): string =>
                        "&copy; $visibleDate"
                    )->menu([
                        'https://t.me/weblanceur' => 'Developer',
                    ]),
            ])->customAttributes(['class' => 'layout-page']),
        ]);
    }
}
