<?php

namespace App\Http\Controllers;
use App\Http\Requests\Order\NewOrderRequest;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    use HelperTrait;

    public function newOrder(NewOrderRequest $request): JsonResponse
    {
        if (Session::has('basket')) {
            if (Auth::user()->phone != $request->phone) {
                Auth::user()->phone = $request->phone;
                Auth::user()->save();
            }

            if ($request->address && !Auth::user()->address && Auth::user()->address != $request->address) {
                Auth::user()->address = $request->address;
                Auth::user()->save();
            }

            $delivery = $request->delivery;
            if ($delivery && !$request->address) return response()->json(['errors' => ['address' => [trans('validation.address')]]], 401);

            $fields = [
                'number' => Str::random(6),
                'notes' => $request->notes,
                'status' => 0,
                'user_id' => Auth::id(),
                'delivery' => $delivery
            ];

            $order = Order::create($fields);

            $basket = Session::get('basket');
            $sincArr = [];
            foreach ($basket as $id => $position) {
                $sincArr[$id] = ['value' => $position['value']];
            }
            $order->items()->sync($sincArr);

            $this->sendMessage('order', env('MAIL_TO'), Auth::user()->email, [
                'email' => Auth::user()->email,
                'address' => Auth::user()->address,
                'pickup_address' => $this->getPickupAddress(),
                'order' => $order,
                'total' => $this->getBasketTotal()
            ]);

            Session::forget('basket');

            return response()->json([
                'success' => true,
                'message' => trans('content.your_order_has_been_processed')
            ],200);
        } else {
            return response()->json(['success' => false],403);
        }
    }
}
