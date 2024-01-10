<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\HelperTrait;
use App\Models\Content;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminContentsController extends AdminBaseController
{
    use HelperTrait;

    public function __construct()
    {
        parent::__construct();
    }

    public function contents(): View
    {
        return $this->getSomething('contents', new Content());
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editContent (Request $request): RedirectResponse
    {
        $this->editSomething (
            $request,
            new Content(),
            ['image' => $this->validationJpgAndPng, 'head' => $this->validationString, 'text' => $this->validationText],
            'images/contents/',
            'content',
        );
        $this->saveCompleteMessage();
        return redirect(route('admin.contents'));
    }
}
