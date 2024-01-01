<?php

namespace App\Http\Controllers;
//use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Type;
use Illuminate\View\View;

class ItemController extends BaseController
{
    use HelperTrait;

    public function __invoke($slug): View
    {
        if (!$this->data['type'] = Type::where('slug',$slug)->first()) abort(404);
        $this->breadcrumbs[] = [
            'route' => route('get_items',['slug' => $slug]),
            'name' => $this->data['type']->name
        ];
        if (request()->has('id')) {
            $this->data['item'] = Item::findOrFail(request()->id);
            $this->breadcrumbs[] = [
                'route' => route('get_items',['slug' => $slug, 'id' => $this->data['item']->id]),
                'name' => $this->data['item']->name
            ];
            return $this->showView('item');
        } else {
            return $this->showView('type');
        }
    }
}
