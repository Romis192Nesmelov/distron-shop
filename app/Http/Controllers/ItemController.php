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

        if (request()->has('id')) {
            $this->data['item'] = Item::findOrFail(request()->id);
            $this->breadcrumbs[] = [
                'route' => route('get_items',['slug' => $slug, 'id' => $this->data['item']->id]),
                'name' => $this->data['item']->name
            ];
            return $this->showView('item');
        } else {
            $this->data['items'] = Item::query()->where('type_id',$this->data['type']->id)->filtered()->orderBy('price')->get();

            $this->data['min_price'] = Item::query()
                ->where('type_id',$this->data['type']->id)
                ->select('price')
                ->orderBy('price')
                ->first()
                ->price;
            $this->data['max_price'] = Item::query()
                ->where('type_id',$this->data['type']->id)
                ->select('price')
                ->orderBy('price','desc')
                ->first()
                ->price;

            $this->data['min_price_val'] = request()->min_price ? request()->min_price : $this->data['min_price'];
            $this->data['max_price_val'] = request()->max_price ? request()->max_price : $this->data['max_price'];

            if ($this->data['type']->id == 1) {
                $this->data['min_voltage'] = Item::query()
                    ->where('type_id',$this->data['type']->id)
                    ->select('voltage')
                    ->orderBy('voltage')
                    ->first()
                    ->voltage;

                $this->data['max_voltage'] = Item::query()
                    ->where('type_id',$this->data['type']->id)
                    ->select('voltage')
                    ->orderBy('voltage','desc')
                    ->first()
                    ->voltage;

                $this->data['min_voltage_val'] = request()->min_voltage ? request()->min_voltage : $this->data['min_voltage'];
                $this->data['max_voltage_val'] = request()->max_voltage ? request()->max_voltage : $this->data['max_voltage'];

                $this->data['min_capacity'] = Item::query()
                    ->where('type_id',$this->data['type']->id)
                    ->select('capacity')
                    ->orderBy('capacity')
                    ->first()
                    ->capacity;

                $this->data['max_capacity'] = Item::query()
                    ->where('type_id',$this->data['type']->id)
                    ->select('capacity')
                    ->orderBy('capacity','desc')
                    ->first()
                    ->capacity;

                $this->data['min_capacity_val'] = request()->min_capacity ? request()->min_capacity : $this->data['min_capacity'];
                $this->data['max_capacity_val'] = request()->max_capacity ? request()->max_capacity : $this->data['max_capacity'];
            } else if ($this->data['type']->id == 2) {
                $this->data['min_plates'] = Item::query()
                    ->where('type_id',$this->data['type']->id)
                    ->select('plates')
                    ->orderBy('plates')
                    ->first()
                    ->plates;

                $this->data['max_plates'] = Item::query()
                    ->where('type_id',$this->data['type']->id)
                    ->select('plates')
                    ->orderBy('plates','desc')
                    ->first()
                    ->plates;

                $this->data['min_plates_val'] = request()->min_plates ? request()->min_plates : $this->data['min_plates'];
                $this->data['max_plates_val'] = request()->max_plates ? request()->max_plates : $this->data['max_plates'];
            }

            return $this->showView('type');
        }
    }
}
