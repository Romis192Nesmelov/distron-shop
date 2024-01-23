<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\HelperTrait;
use App\Models\Item;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminItemsController extends AdminBaseController
{
    use HelperTrait;

    public function __construct()
    {
        parent::__construct();
    }

    public function items($slug=null): View
    {
        $this->data['parent_key'] = 'types';
        $this->data['technologies'] = Technology::all();
        return $this->getSomething('items', new Item(), $slug, new Type());
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editItem(Request $request): RedirectResponse
    {
        $item = $this->editSomething (
            $request,
            new Item(),
            [
                'image' => $this->validationJpgAndPng,
                'name' => 'nullable|max:50',
                'description' => $this->validationString,
                'price' => $this->validationInteger,
                'type_id' => 'required|integer|exists:types,id',
                'capacity' => 'nullable|max:1000',
                'voltage' => 'nullable|max:100',
                'plates' => 'nullable|max:20'
            ],
            'images/items/',
            'item'
        );
        $this->saveCompleteMessage();
        return redirect(route('admin.types',['id' => $item->type_id]));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function deleteItem(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new Item());
    }
}
