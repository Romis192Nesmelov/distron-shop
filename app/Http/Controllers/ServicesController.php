<?php

namespace App\Http\Controllers;
//use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Type;
use Illuminate\View\View;

class ServicesController extends BaseController
{
    use HelperTrait;

    public function __invoke($slug=null): View
    {
        $this->breadcrumbs[] = [
            'route' => route('services'),
            'name' => trans('menu.services')
        ];
        $this->data['active'] = 'services';

        if ($slug || request()->has('id')) {
            $this->getItemByIdOrSlug($slug);
            $this->breadcrumbs[] = [
                'route' => route('services',['id' => $this->data['item']->id]),
                'name' => getItemHead($this->data['item'])
            ];

            $this->getSeo('item');
            return $this->showView('item');
        } else {
            $this->data['services'] = Type::query()->where('is_service',1)->with('items')->first();
            return $this->showView('services');
        }
    }
}
