<?php

namespace App\Http\Controllers;
use App\Http\Requests\Order\NewOrderRequest;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    use HelperTrait;

    public function newOrder(NewOrderRequest $request): JsonResponse
    {
        if (Session::has('basket')) {
            $user = User::find(Auth::id());
            if ($user->phone != $request->phone) {
                $user->phone = $request->phone;
                $user->save();
            }

            if ($user->address != $request->address) {
                $user->address = $request->address;
                $user->save();
            }

            $order = Order::create([
                'notes' => $request->notes,
                'status' => 0,
                'user_id' => Auth::id()
            ]);

            $basket = Session::get('basket');
            $sincArr = [];
            foreach ($basket as $id => $position) {
                $sincArr[$id] = ['value' => $position['value']];
            }
            $order->items()->sync($sincArr);

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
