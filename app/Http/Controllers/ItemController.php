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
        $this->data['type'] = Type::where('slug',$slug)->select(['id','slug','name','text'])->first();
        if (!$this->data['type']) abort(404);

        if ($this->data['type']->id == 4) {
            $this->breadcrumbs[] = [
                'route' => route('get_items',['scroll' => 'services']),
                'name' => $this->data['type']->name
            ];
        } else {
            $this->breadcrumbs[] = [
                'route' => route('get_items',['slug' => $slug]),
                'name' => $this->data['type']->name
            ];
        }

        $this->data['filters'] = [];
        if (request()->has('id')) {
            $this->data['item'] = Item::findOrFail(request()->id);
            $this->breadcrumbs[] = [
                'route' => route('get_items',['slug' => $slug, 'id' => $this->data['item']->id]),
                'name' => getItemHead($this->data['item'])
            ];
            $this->getSeo('item');
            return $this->showView('item');
        } else {
            $this->data['items'] = Item::query()->where('type_id',$this->data['type']->id)->filtered()->orderBy('price')->get();

            $this->getMinMax('price',100,'₽');

            if ($this->data['type']->id == 1) {
                $this->getMinMax('voltage',1,'В');
                $this->getMinMax('capacity', 100, 'Ah');
            } else if ($this->data['type']->id == 2) {
                $this->getMinMax('plates', 1, trans('content.things'));
                $this->getMinMax('length', 10, trans('content.mm'));
                $this->getMinMax('width', 10, trans('content.mm'));
                $this->getMinMax('height', 10, trans('content.mm'));
            } else if ($this->data['type']->id == 3) {
                $this->getMinMax('section', 1, trans('content.mm'));
            }

            $this->getSeo('type');
            return $this->showView('type');
        }
    }

    private function getMinMax(string $name, int $step, string $postfix): void
    {
        $this->data['filters'][$name]['step'] = $step;
        $this->data['filters'][$name]['postfix'] = $postfix;

        $this->data['filters'][$name]['min'] = Item::query()
            ->where('type_id',$this->data['type']->id)
            ->select($name)
            ->orderBy($name)
            ->first()
            ->$name;

        if ($this->data['filters'][$name]['min'] === null) $this->data['filters'][$name]['min'] = 0;

        $this->data['filters'][$name]['max'] = Item::query()
            ->where('type_id',$this->data['type']->id)
            ->select($name)
            ->orderBy($name,'desc')
            ->first()
            ->$name;

        $this->data['filters'][$name]['min_val'] = request()['min_'.$name] ? request()['min_'.$name] : $this->data['filters'][$name]['min'];
        $this->data['filters'][$name]['max_val'] = request()['max_'.$name] ? request()['max_'.$name] : $this->data['filters'][$name]['max'];
    }
}
