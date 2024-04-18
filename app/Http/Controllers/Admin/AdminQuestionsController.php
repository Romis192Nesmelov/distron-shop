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

    public Question $question;

    public function __construct(Question $question)
    {
        parent::__construct();
        $this->question = $question;
    }

    public function questions($slug=null): View
    {
        return $this->getSomething($this->question, $slug);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editQuestion(Request $request): RedirectResponse
    {
        $this->editSomething (
            $request,
            $this->question,
            ['question' => $this->validationString, 'answer' => $this->validationText],
        );
        $this->saveCompleteMessage();
        return redirect(route('admin.questions'));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function deleteQuestion(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, $this->question);
    }
}
