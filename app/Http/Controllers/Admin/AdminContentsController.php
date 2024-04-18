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

    public Content $content;

    public function __construct(Content $content)
    {
        parent::__construct();
        $this->content = $content;
    }

    public function contents(): View
    {
        return $this->getSomething($this->content);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editContent (Request $request): RedirectResponse
    {
        $this->editSomething (
            $request,
            $this->content,
            ['head' => $this->validationString, 'text' => $this->validationText]
        );
        $this->saveCompleteMessage();
        return redirect(route('admin.contents'));
    }
}
