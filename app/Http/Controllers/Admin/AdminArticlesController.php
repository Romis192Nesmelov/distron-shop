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

    public Article $article;

    public function __construct(Article $article)
    {
        parent::__construct();
        $this->article = $article;
    }

    public function articles($slug=null): View
    {
        $this->data['seo'] = Seo::find($this->seoIds['articles']);
        $this->data['metas'] = $this->metas;
        return $this->getSomething($this->article, $slug);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editArticleSeo(Request $request): RedirectResponse
    {
        $seoFields = $this->validate($request, $this->getValidationSeo());
        Seo::where('id',$this->seoIds['articles'])->update($seoFields);
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
            $this->article,
            $validationArr,
            'storage/images/articles/',
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
        return $this->deleteSomething($request, $this->article);
    }
}
