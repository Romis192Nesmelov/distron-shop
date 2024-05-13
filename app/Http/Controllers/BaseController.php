<?php

namespace App\Http\Controllers;
//use Illuminate\Http\Request;
use App\Models\Action;
use App\Models\Contact;
use App\Models\Content;
use App\Models\Icon;
use App\Models\Metric;
use App\Models\Question;
use App\Models\Seo;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class BaseController extends Controller
{
    use HelperTrait;

    protected array $data = [];
    protected array $breadcrumbs = [];

    public function index(string|null $token = null): View
    {
        $this->data['scroll'] = request('scroll');
        $this->data['content'] = Content::find(1);
        $this->data['token'] = $token;
        $this->data['icons'] = Icon::where('active',1)->get();
        $this->data['faq'] = Question::where('active',1)->get();
        return $this->showView('home');
    }

    public function contacts(): View
    {
        $this->data['map'] = Contact::where('id',4)->pluck('contact')->first();
        $this->data['seo'] = Seo::find($this->seoIds['contacts']);
        return $this->showView('contacts');
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
        $contents = Content::where('id','!=',1)->select(['slug','head'])->get();

        $menu = [];
        foreach ($contents as $content) {
            $menu[$content->slug] = ['href' => route('content',['slug' => $content->slug]), 'name' => $content->head];
        }

        $menu['products'] = ['href' => route('items'), 'name' => trans('menu.products')];
        $menu['services'] = ['href' => route('services'), 'name' => trans('menu.services')];
        if (Action::query()->count()) $menu['actions']  = ['href' => route('actions'), 'name' => trans('menu.actions')];
        $menu['articles'] = ['href' => route('articles'), 'name' => trans('menu.articles')];
        $menu['contacts'] = ['href' => route('contacts'), 'name' => trans('menu.contacts')];

        if (Session::has('basket') && !count(Session::get('basket'))) Session::forget('basket');

        return view($view,array_merge(
            $this->data,
            [
                'seo' => $this->data['seo'] ?? Seo::find(1),
                'metas' => $this->metas,
                'settings' => $settings->getSettings(),
                'menu' => $menu,
                'video' => [
                    'storage/video/distron.mp4',
                    'storage/video/distron.ogg',
                    'storage/video/distron.webm'
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
