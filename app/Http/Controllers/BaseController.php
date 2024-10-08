<?php

namespace App\Http\Controllers;
use App\Models\Action;
use App\Models\Contact;
use App\Models\Content;
use App\Models\Diploma;
use App\Models\Icon;
use App\Models\Item;
use App\Models\Metric;
use App\Models\Question;
use App\Models\Seo;
use App\Models\Type;
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
        $this->data['active'] = 'home';
        $this->data['content'] = Content::query()->whereIn('id',[1,4])->select(['head','text'])->get();
        $this->data['token'] = $token;
        $this->data['icons'] = Icon::query()->where('active',1)->get();
        $this->data['services_head'] = Type::query()->where('id',4)->pluck('name')->first();
        $this->data['services'] = Item::query()->whereIn('id',[1,21])->select(['image','slug','name','price'])->get();
        $this->data['products'] = Type::query()->where('is_service',0)->select(['slug','image','name'])->get();
        $this->data['items'] = Item::query()
            ->where('type_id','!=',4)
            ->select([
                'image',
                'slug',
                'name',
                'price',
                'type_id',
                'capacity',
                'voltage',
                'length',
                'width',
                'height',
                'rated_current'
            ])
            ->with(['type','technology','seo'])
            ->orderBy('price')
            ->inRandomOrder()
            ->limit(4)
            ->get();
        $this->data['diplomas'] = Diploma::query()->where('active',1)->get();
        $this->data['faq'] = Question::query()->where('active',1)->get();
        return $this->showView('home');
    }

    public function contacts(): View
    {
        $this->breadcrumbs[] = [
            'route' => route('contacts'),
            'name' => trans('menu.contacts')
        ];
        $this->data['active'] = 'contacts';

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
        $contents = Content::where('id','!=',1)->get();

        $menu = [];
        foreach ($contents as $content) {
            if ($content->text)
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

    protected function getItemByIdOrSlug($slug): void
    {
        $query = Item::query();

        if ($slug) $query = $query->where('slug',$slug);
        else $query = $query->where('id',request()->id);

        $this->data['item'] = $query->with(['type','technology'])->first();
        if ($this->data['item']->slug && request()->has('id')) abort(404);
    }

    protected function getSeo($name): void
    {
        if (isset($this->data[$name]->seo)) $this->data['seo'] = $this->data[$name]->seo;
    }
}
