<?php

namespace App\Http\Controllers\Admin;
use App\Models\Action;
use App\Models\Article;
use App\Models\Content;
use App\Models\Type;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;
use SimpleXMLElement;

class AdminSiteMapController extends AdminBaseController
{
    private SimpleXMLElement $siteMapXML;
    private string $pathToXML;

    public function __construct()
    {
        parent::__construct();
        $this->pathToXML = base_path(env('SITEMAP'));
    }

    public function siteMap(): View
    {
        $this->data['menu_key'] = 'sitemap';
        $this->breadcrumbs[] = [
            'key' => $this->menu['sitemap']['key'],
            'name' => trans('admin_menu.sitemap')
        ];
        $this->data['sitemap'] = file_exists($this->pathToXML) ? simplexml_load_file($this->pathToXML) : '';
        return $this->showView('site_map');
    }

    public function generateSiteMap(): RedirectResponse
    {
        $this->siteMapXML = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');
        $loc = Config::get('app.url');

        $this->addChildUrl($loc, time(),1);

        // Adding contents
        $contents = Content::where('id','!=',1)->select('slug')->get();
        foreach ($contents as $content) {
            $this->addChildUrl($loc. '/' .$content->slug, time(),1);
        }

        // Adding products
        $this->addChildUrl(route('items'), time(),1);
        $types = Type::where('is_service','!=',1)->with('items')->get();
        foreach ($types as $type) {
            $this->addChildUrl(route('items',['slug' => $type->slug]), time(),0.5);
            foreach ($type->items as $item) {
                $this->addChildUrl(route('items',['slug' => $type->slug, 'id' => $item->id]), time(),0.3);
            }
        }

        // Adding services
        $this->addChildUrl(route('services'), time(),1);
        $services = Type::where('is_service',1)->with('items')->first();
        foreach ($services->items as $item) {
            $this->addChildUrl(route('services',['id' => $item->id]), time(),0.5);
        }

        // Adding actions
        $this->addChildUrl(route('actions'), time(),1);
        $actions = Action::where('active',0)->select('id')->get();
        foreach ($actions as $action) {
            $this->addChildUrl(route('actions',['id' => $action->id]), time(),0.5);
        }

        // Adding articles
        $this->addChildUrl(route('articles'), time(),1);
        $articles = Article::select('slug')->get();
        foreach ($articles as $article) {
            $this->addChildUrl(route('articles',['slug' => $article->slug]), time(),0.5);
        }

        // Adding contacts
        $this->addChildUrl(route('contacts'), time(),1);

        if (file_exists($this->pathToXML)) unlink($this->pathToXML);
        $this->siteMapXML->asXML($this->pathToXML);

        session()->flash('message', trans('admin.generation_complete'));
        return redirect(route('admin.sitemap'));

    }

    private function addChildUrl($loc, $timeChange, $priority): void
    {
        $url = $this->siteMapXML->addChild('url');
        $url->addChild('loc',$loc);
        $url->addChild('lastmod',date('Y-m-d\TH:m:s'.'+03:00',$timeChange));
        $url->addChild('priority',$priority);
        $url->addChild('changefreq','hourly');
    }
}
