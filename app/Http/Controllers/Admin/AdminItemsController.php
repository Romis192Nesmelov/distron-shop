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

    public Item $item;

    public function __construct(Item $item)
    {
        parent::__construct();
        $this->item = $item;
    }

    public function items($slug=null): View
    {
        $this->data['parent_key'] = 'types';
        $this->data['technologies'] = Technology::all();
        return $this->getSomething($this->item, $slug, new Type());
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editItem(Request $request): RedirectResponse
    {
        $validationArr = [
            'image' => $this->validationJpgAndPng,
            'name' => 'nullable|max:50',
            'description' => $this->validationText,
            'price' => $this->validationInteger,
            'type_id' => 'required|integer|exists:types,id',
        ];


        if ($request->type_id == 1) {
            $validationArr['capacity'] = 'required|integer|min:1|max:1000';
            $validationArr['voltage'] = 'required|integer|min:10|max:100';
            $validationArr['technology_id'] = 'required|integer|exists:technologies,id';
        } elseif ($request->type_id == 2) {
            $validationArr['length'] = 'required|integer|min:45|max:190';
            $validationArr['width'] = 'required|integer|min:100|max:200';
            $validationArr['height'] = 'required|integer|min:300|max:750';
            $validationArr['plates'] = 'required|integer|min:2|max:6';
        } elseif ($request->type_id == 3) {
            $validationArr['section'] = 'nullable|integer|max:100';
            $validationArr['length'] = 'nullable|integer|max:1000';
            $validationArr['rated_current'] = 'nullable|max:100';
        } else {
            $validationArr['capacity'] = 'nullable|integer|min:1|max:1000';
            $validationArr['file'] = $this->validationDoc;
            $validationArr['description_file'] = 'nullable|min:3|max:255';
        }

        $item = $this->editSomething (
            $request,
            $this->item,
            $validationArr,
            'storage/images/items/',
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
        return $this->deleteSomething($request, $this->item);
    }
}
