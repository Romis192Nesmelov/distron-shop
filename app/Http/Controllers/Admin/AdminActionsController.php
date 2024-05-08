<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\HelperTrait;
use App\Models\Action;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminActionsController extends AdminBaseController
{
    use HelperTrait;

    public Action $action;

    public function __construct(Action $action)
    {
        parent::__construct();
        $this->action = $action;
    }

    public function actions($slug=null): View
    {
        return $this->getSomething($this->action, $slug);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editAction(Request $request): RedirectResponse
    {
        $action = $this->editSomething (
            $request,
            $this->action,
            [
                'image' => $this->validationJpg,
                'name' => $this->validationString,
                'slug' => 'nullable|max:255',
                'text' => $this->validationLongText
            ],
            'storage/images/actions/',
            'action'
        );

        $anotherActions = Action::where('id','!=',$action->id)->where('active',1)->get();
        if ($anotherActions->count()) {
            foreach ($anotherActions as $action) {
                $action->active = 0;
                $action->save();
            }
        }

        $this->saveCompleteMessage();
        return redirect(route('admin.actions'));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function deleteArticle(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, $this->action);
    }
}
