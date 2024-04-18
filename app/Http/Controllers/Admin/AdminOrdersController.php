<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\HelperTrait;
use App\Models\Order;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminOrdersController extends AdminBaseController
{
    use HelperTrait;

    public Order $order;

    public function __construct(Order $order)
    {
        parent::__construct();
        $this->order = $order;
    }

    public function orders(): View
    {
        $this->data['statuses'] = [];
        for ($i=0;$i<=3;$i++) {
            $this->data['statuses'][] = ['val' => $i, 'descript' => trans('admin.order_status'.($i + 1))];
        }
        return $this->getSomething($this->order);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editOrder(Request $request): RedirectResponse
    {
        $this->editSomething (
            $request,
            $this->order,
            ['number' => $this->validationString, 'status' => 'integer|min:0|max:3'],
        );
        $this->saveCompleteMessage();
        return redirect(route('admin.orders'));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function deleteOrder(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, $this->order);
    }
}
