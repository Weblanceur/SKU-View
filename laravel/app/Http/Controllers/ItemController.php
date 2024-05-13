<?php

namespace App\Http\Controllers;

use App\Forms\SearchForm;
use App\Models\Item;
use App\MoonShine\Resources\SkuItemResource;
use Illuminate\Http\Request;
use MoonShine\Components\FormBuilder;
use MoonShine\Pages\ViewPage;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = trim($request->get('search'));
        $items = [];
        $error = '';

        if ($search) {
            $items = Item::query()
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
