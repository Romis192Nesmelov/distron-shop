<?php

namespace App\Http\Controllers;
//use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Content;
use App\Models\Icon;
use App\Models\Question;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BaseController extends Controller
{
    use HelperTrait;

    protected array $data = [];

    public function index(): View
    {
        $this->data['scroll'] = request('scroll');
        $this->data['content'] = Content::all();
        $this->data['icons'] = Icon::where('active',1)->get();
        $this->data['contacts'] = Contact::all();
        $this->data['faq'] = Question::where('active',1)->get();
        return $this->showView('home');
    }

//    public function changeLang(Request $request)
//    {
//        $this->validate($request, ['lang' => 'required|in:en,ru']);
//        setcookie('lang', $request->input('lang'), time()+(60*60*24*365));
//        return redirect()->back();
//    }

    private function showView($view): View
    {
        $settings = new SettingsController();
        $content = Content::all();
        $menu = [];
        foreach ($content as $k => $item) {
            $slug = Str::slug($item->head);
            $menu[$slug] = ['scroll' => $slug, 'name' => $item->head];
            if (!$k) $menu['advantages'] = ['scroll' => 'advantages', 'name' => trans('menu.advantages')];
        }
        $menu['catalogue'] = ['scroll' => 'catalogue', 'name' => trans('menu.catalogue')];
        $menu['faq'] = ['scroll' => 'faq', 'name' => trans('menu.faq')];
        $menu['contacts'] = ['scroll' => 'contacts', 'name' => trans('menu.contacts')];
        return view($view,array_merge(
            $this->data, [
                    'seo' => $settings->getSeoTags(),
                    'metas' => $this->metas,
                    'settings' => $settings->getSettings(),
                    'menu' => $menu,
                    'video' => [
                        'video/distron.mp4',
                        'video/distron.ogg',
                        'video/distron.webm'
                    ]
                ]
            )
        );
    }
}
