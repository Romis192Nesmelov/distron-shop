<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Seo;
use Illuminate\View\View;

class ArticlesController extends BaseController
{
    public function __invoke($slug=null): View
    {
        $this->breadcrumbs[] = [
            'route' => route('articles'),
            'name' => trans('menu.articles')
        ];

        if ($slug) {
            $this->data['article'] = Article::where('slug',$slug)->first();
            if (!$this->data['article']) abort(404);

            $this->breadcrumbs[] = [
                'route' => route('articles',['slug' => $this->data['article']->slug]),
                'name' => $this->data['article']->name
            ];
            $this->getSeo('article');

            return $this->showView('article');
        } else {
            $this->data['articles'] = Article::select(['image','name','slug','short'])->paginate(8);
            $this->data['seo'] = Seo::find(2);
            return $this->showView('articles');
        }
    }
}
