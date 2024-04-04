<?php

namespace App\Http\Controllers;
//use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\View\View;

class ContentController extends BaseController
{
    use HelperTrait;

    public function __invoke($slug): View
    {
        $this->data['content'] = Content::where('slug',$slug)->first();
        if (!$this->data['content']) abort(404);

        $this->breadcrumbs[] = [
            'route' => route('content',['slug' => $slug]),
            'name' => $this->data['content']->head
        ];
        $this->getSeo('content');

        return $this->showView('content');
    }
}
