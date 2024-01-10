<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\HelperTrait;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminUsersController extends AdminBaseController
{
    use HelperTrait;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function users($slug=null): View
    {
        return $this->getSomething('users', new User(), $slug);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editUser(Request $request): RedirectResponse
    {
        $validationArr = [
            'email' => 'required|email|unique:users,email',
            'phone' => $this->validationPhone,
            'address' => 'nullable|min:10|max:255'
        ];
        if ($request->has('id')) {
            $validationArr['id'] = 'required|integer|exists:users,id';
            $validationArr['email'] .= ','.$request->input('id');
            if ($request->input('password')) $validationArr['password'] = $this->validationPassword;
            $fields = $this->validate($request, $validationArr);
            $fields = $this->getSpecialFields(new User(), $validationArr, $fields);
            $user = User::find($request->input('id'));
            if ($request->input('password')) $fields['password'] = bcrypt($fields['password']);
            $user->update($fields);
        } else {
            $validationArr['password'] = $this->validationPassword;
            $fields = $this->validate($request, $validationArr);
            $fields['password'] = bcrypt($fields['password']);
            User::create($fields);
        }
        $this->saveCompleteMessage();
        return redirect(route('admin.users'));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function deleteUser(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new User());
    }
}
