<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\HelperTrait;
use App\Models\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminTypesController extends AdminBaseController
{
    use HelperTrait;

    public function __construct()
    {
        parent::__construct();
    }

    public function types($slug=null): View
    {
        $this->data['metas'] = $this->metas;
        return $this->getSomething('types', new Type(), $slug);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editType(Request $request): RedirectResponse
    {
         $this->editSomething (
            $request,
            new Type(),
            ['image' => $this->validationJpgAndPng, 'name' => $this->validationString, 'text' => $this->validationText],
            'images/types/',
            'type'
        );
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
