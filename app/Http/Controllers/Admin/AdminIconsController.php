<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\HelperTrait;
use App\Models\Icon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminIconsController extends AdminBaseController
{
    use HelperTrait;

    public function __construct()
    {
        parent::__construct();
    }

    public function icons($slug=null): View
    {
        return $this->getSomething('icons', new Icon(), $slug);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editIcon(Request $request): RedirectResponse
    {
        $this->editSomething (
            $request,
            new Icon(),
            ['image' => $this->validationSvg, 'title' => $this->validationString],
            'images/icons/',
            'icon',
        );
        $this->saveCompleteMessage();
        return redirect(route('admin.icons'));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function deleteIcon(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new Icon());
    }
}
