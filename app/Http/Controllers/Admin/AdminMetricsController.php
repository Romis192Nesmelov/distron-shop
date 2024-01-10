<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\HelperTrait;
use App\Models\Metric;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminMetricsController extends AdminBaseController
{
    use HelperTrait;

    public function __construct()
    {
        parent::__construct();
    }

    public function metrics($slug=null): View
    {
        return $this->getSomething('metrics', new Metric(), $slug);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editMetric(Request $request): RedirectResponse
    {
        $this->editSomething (
            $request,
            new Metric(),
            ['name' => $this->validationString, 'code' => $this->validationText],
        );
        $this->saveCompleteMessage();
        return redirect(route('admin.metrics'));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function deleteMetric(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new Metric());
    }
}
