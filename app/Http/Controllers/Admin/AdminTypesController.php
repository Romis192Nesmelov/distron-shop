<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\HelperTrait;
use App\Models\Seo;
use App\Models\Type;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminTypesController extends AdminBaseController
{
    use HelperTrait;

    public Type $type;

    public function __construct(Type $type)
    {
        parent::__construct();
        $this->type = $type;
    }

    public function types($slug=null): View
    {
        if (!$slug && !request('id')) {
            $this->data['metas'] = $this->metas;
            $this->data['seo'] = Seo::find($this->seoIds['products']);
        }
        return $this->getSomething($this->type, $slug);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editType(Request $request): RedirectResponse
    {
         $this->editSomething (
            $request,
            $this->type,
            [
                'image' => $this->validationJpgAndPng,
                'slug' => 'nullable|max:50',
                'name' => $this->validationName,
                'singular' => $this->validationName,
                'text' => $this->validationText
            ],
            'storage/images/types/',
            'type'
        );
        $this->saveCompleteMessage();
        return redirect(route('admin.types'));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editProductsSeo(Request $request): RedirectResponse
    {
        $seoFields = $this->validate($request, $this->getValidationSeo());
        Seo::where('id',$this->seoIds['products'])->update($seoFields);
        $this->saveCompleteMessage();
        return redirect(route('admin.types'));
    }

//    /**
//     * @throws \Illuminate\Validation\ValidationException
//     */
//    public function deleteType(Request $request): JsonResponse
//    {
//        $type = Type::findOrFail($request->input('id'));
//        if ($type->items->count()) return response()->json(['message' => trans('admin.error_delete_type')],403);
//        else {
//            $this->deleteFile($type->image);
//            $type->delete();
//            return response()->json(['message' => trans('admin.delete_complete')],200);
//        }
//    }
}
