<?php

namespace App\Http\Controllers;
//use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Content;
use App\Models\Icon;
use App\Models\Metric;
use App\Models\Question;
use App\Models\Seo;
use App\Models\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BaseController extends Controller
{
    use HelperTrait;

    protected array $data = [];
    protected array $breadcrumbs = [];

    public function index(): View
    {
        $this->data['scroll'] = request('scroll');
        $this->data['content'] = Content::find(1);
//        $this->data['icons'] = Icon::where('active',1)->get();
//        $this->data['faq'] = Question::where('active',1)->get();
//        $this->data['catalogue'] = Type::where('is_service',0)->get();
//        $this->data['services'] = Type::where('is_service',1)->first();
        return $this->showView('home');
    }

    public function getNewCsrf(): JsonResponse
    {
        return response()->json(['token' => csrf_token()],200);
    }

//    public function changeLang(Request $request)
//    {
//        $this->validate($request, ['lang' => 'required|in:en,ru']);
//        setcookie('lang', $request->input('lang'), time()+(60*60*24*365));
//        return redirect()->back();
//    }

    protected function showView($view): View
    {
        $settings = new SettingsController();
        $contents = Content::select(['slug','head'])->get();

        $menu = [];
        foreach ($contents as $content) {
            $menu[$content->slug] = ['href' => route('content',['slug' => $content->slug]), 'name' => $content->head];
        }

        $menu['advantages'] = ['scroll' => 'advantages', 'name' => trans('menu.advantages')];
        $menu['catalogue'] = ['scroll' => 'catalogue', 'name' => trans('menu.catalogue')];
        $menu['actions'] = ['scroll' => 'services', 'name' => trans('menu.actions')];
        $menu['services'] = ['scroll' => 'services', 'name' => trans('menu.services')];

        $menu['faq'] = ['scroll' => 'faq', 'name' => trans('menu.faq')];
        $menu['articles'] = ['href' => route('articles'), 'name' => trans('menu.articles')];
        $menu['contacts'] = ['scroll' => 'contacts', 'name' => trans('menu.contacts')];

        if (Session::has('basket') && !count(Session::get('basket'))) Session::forget('basket');

        return view($view,array_merge(
            $this->data,
            [
                'seo' => $this->data['seo'] ?? Seo::find(1),
                'metas' => $this->metas,
                'settings' => $settings->getSettings(),
                'menu' => $menu,
                'video' => [
                    'video/distron.mp4',
                    'video/distron.ogg',
                    'video/distron.webm'
                ],
                'metrics' => Metric::all(),
                'breadcrumbs' => $this->breadcrumbs,
                'basketTotal' => $this->getBasketTotal(),
                'pickup_address' => $this->getPickupAddress(),
                'contacts' => Contact::where('id','<',4)->get()
            ])
        );
    }

    protected function getSeo($name): void
    {
        if (isset($this->data[$name]->seo)) $this->data['seo'] = $this->data[$name]->seo;
    }
}
