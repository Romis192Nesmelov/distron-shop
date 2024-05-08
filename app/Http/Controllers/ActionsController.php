<?php

namespace App\Http\Controllers;
use App\Models\Action;
use App\Models\Seo;
use Illuminate\View\View;

class ActionsController extends BaseController
{
    use HelperTrait;

    public function __invoke(): View
    {
        $this->breadcrumbs[] = [
            'route' => route('actions'),
            'name' => trans('menu.actions')
        ];

        if (request('id')) {
            $this->data['action'] = Action::findOrFail(request('id'));
            $this->data['actions'] = Action::where('id','!=',request('id'))->select(['image','alt_img','name'])->paginate(8);

            $this->breadcrumbs[] = [
                'route' => route('action',['id' => request('id')]),
                'name' => $this->data['action']->name
            ];
        } else {
            $this->data['action'] = Action::where('active',1)->first();
            $this->data['actions'] = Action::where('active',0)->select(['image','alt_img','name'])->paginate(8);
        }

        $this->getSeo('action');
        return $this->showView('action');
    }
}
