<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\Type;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SearchController extends BaseController
{
    use HelperTrait;

    public function __invoke(): View|RedirectResponse
    {
        if (!request('find')) return redirect()->back();
        $this->breadcrumbs[] = [
            'route' => route('search',['string' => request('string')]),
            'name' => trans('content.search')
        ];
        $found = collect();

        $foundTypes = Type::query()->searched()->with('items')->get();
        foreach ($foundTypes as $item) {
            $found->push([
                'image' => $item->image,
                'head' => $this->markFound($item->name),
                'description' => $this->markFound($item->text),
                'href' => route('items',['slug' => $item->slug])
            ]);
        }

        $foundItems = Item::query()->searched()->with(['type','technology'])->get();
        foreach ($foundItems as $item) {
            $found->push([
                'image' => $item->image ?: $item->type->image,
                'head' => $this->markFound(getItemHead($item)),
                'description' => $item->description ? $this->markFound($item->description) : null,
                'href' => route('items',['slug' => $item->type->slug, 'id' => $item->id])
            ]);
        }

        $this->data['found'] = $found->paginate(10);
        return $this->showView('search');
    }

    private function markFound(string $verifiable): string
    {
        $verifiable = strip_tags($verifiable);
        if (preg_match('/'.request('find').'/ui',$verifiable,$matches)) {
            $found = $matches[0];
            if (strpos($verifiable, $found) > 100) {
                $verifiable = '…'.mb_substr($verifiable,100);
            }
            $verifiable = str_replace($found,'<span class="marked">'.$found.'</span>',$verifiable);
        }
        if (mb_strlen($verifiable) > 300) $verifiable = mb_substr($verifiable,0,300).'…';

        return $verifiable;
    }
}
