<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\HelperTrait;
use App\Models\Article;
use App\Models\Seo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminArticlesController extends AdminBaseController
{
    use HelperTrait;

    public function __construct()
    {
        parent::__construct();
    }

    public function articles($slug=null): View
    {
        $this->data['metas'] = $this->metas;
        $this->data['seo'] = Seo::find(3);
        return $this->getSomething('articles', new Article(), $slug);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editArticleSeo(Request $request): RedirectResponse
    {
        $seoFields = $this->validate($request, $this->getValidationSeo());
        Seo::where('id',3)->update($seoFields);
        $this->saveCompleteMessage();
        return redirect(route('admin.articles'));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editArticle(Request $request): RedirectResponse
    {
        $validationArr = [
            'image' => $this->validationJpgAndPng,
            'name' => 'nullable|max:50',
            'short' => $this->validationString,
            'text' => $this->validationLongText
        ];

        $this->editSomething (
            $request,
            new Article(),
            $validationArr,
            'images/articles/',
            'article'
        );
        $this->saveCompleteMessage();
        return redirect(route('admin.articles'));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function deleteArticle(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new Article());
    }
}
