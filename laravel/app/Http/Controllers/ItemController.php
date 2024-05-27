<?php

namespace App\Http\Controllers;

use App\Forms\SearchForm;
use App\Http\Requests\ItemListRequest;
use App\Models\Item;
use Illuminate\Contracts\View\View;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource Item.
     */
    public function index(ItemListRequest $request): View
    {
        $input = $request->safe()->only(['search']);
        $search = trim($input['search']);
        $items = [];
        $error = '';

        if ($search) {
            $items = Item::query()
                ->with(['city'])
                ->where('title', 'like', "%$search%")
                ->orWhere('barcode', 'like', "%$search%")
                ->orWhere('vendor_code', 'like', "%$search%")
                ->take(10)
                ->get();

            if (sizeof($items)) $search = '';
            else $error = 'Не найдено';
        }

        return view('page', ['form' => SearchForm::make($search), 'items' => $items, 'error' => $error]);
    }
}
