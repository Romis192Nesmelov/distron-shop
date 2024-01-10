<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\HelperTrait;
use App\Models\Question;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminQuestionsController extends AdminBaseController
{
    use HelperTrait;

    public function __construct()
    {
        parent::__construct();
    }

    public function questions($slug=null): View
    {
        return $this->getSomething('questions', new Question(), $slug);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editQuestion(Request $request): RedirectResponse
    {
        $this->editSomething (
            $request,
            new Question(),
            ['question' => $this->validationString, 'answer' => $this->validationText],
        );
        $this->saveCompleteMessage();
        return redirect(route('admin.questions'));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function deleteIcon(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new Question());
    }
}
