<?php

namespace App\Http\Controllers;
use App\Http\Requests\Basket\AddToBasketRequest;
use App\Http\Requests\Basket\ChangeBasketRequest;
use App\Http\Requests\Basket\CheckoutRequest;
use App\Models\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Session;

class BasketController extends Controller
{
    use HelperTrait;

    public function addToBasket(AddToBasketRequest $request): JsonResponse
    {
        $item = Item::find($request->id);
        if (!Session::has('basket')) {
            Session::put('basket',[
                $request->id => [
                    'item' => $item,
                    'value' => $request->value
                ]
            ]);
        } else {
            $basket = Session::get('basket');
            $basket[$request->id] = [
                'item' => $item,
                'value' => $request->value
            ];
            Session::put('basket',$basket);
        }
        return response()->json([
            'success' => true,
            'message' => trans('content.item_successfully_added_to_basket'),
            'id' => $request->id,
            'name' => getItemHead($item),
            'props' => getItemProps($item),
            'value' => $request->value,
            'price' => $request->value * $item->price,
            'total' => $this->getBasketTotal()
        ],200);
    }

    public function changeBasket(ChangeBasketRequest $request): JsonResponse
    {
        $basket = Session::get('basket');
        if (!(int)$request->value) unset($basket[$request->id]);
        else $basket[$request->id]['value'] = (int)$request->value;

        if (!count($basket)) Session::forget('basket');
        else Session::put('basket',$basket);

        return response()->json(['success' => true, 'value' => (int)$request->value], 200);
    }

    public function checkout(CheckoutRequest $request): JsonResponse
    {
        $fields = $request->validated();
        $basket = [];
        for ($i=0;$i<count($fields['id']);$i++) {
            $item = Item::find($fields['id'][$i]);
            if ($item && $fields['value'][$i]) {
                $basket[$fields['id'][$i]] = [
                    'item' => $item,
                    'value' => $fields['value'][$i]
                ];
            }
        }
        if (count($basket)) {
            Session::put('basket',$basket);
            return response()->json([
                'success' => true,
                'total' => $this->getBasketTotal()
            ],200);
        } else {
            Session::forget('basket');
            return response()->json([
                'success' => true,
                'total' => 0
            ],200);
        }
    }
}
