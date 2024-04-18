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

    public Metric $metric;

    public function __construct(Metric $metric)
    {
        parent::__construct();
        $this->metric = $metric;
    }

    public function metrics($slug=null): View
    {
        return $this->getSomething($this->metric, $slug);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editMetric(Request $request): RedirectResponse
    {
        $this->editSomething (
            $request,
            $this->metric,
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
        return $this->deleteSomething($request, $this->metric);
    }
}
