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

    public function __construct()
    {
        parent::__construct();
    }

    public function orders(): View
    {
        $this->data['statuses'] = [];
        for ($i=0;$i<=3;$i++) {
            $this->data['statuses'][] = ['val' => $i, 'descript' => trans('admin.order_status'.($i + 1))];
        }
        return $this->getSomething('orders', new Order());
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editOrder(Request $request): RedirectResponse
    {
        $this->editSomething (
            $request,
            new Order(),
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
        return $this->deleteSomething($request, new Order());
    }
}
