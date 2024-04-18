<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\HelperTrait;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AdminUsersController extends AdminBaseController
{
    use HelperTrait;

    public User $user;

    public function __construct(User $user)
    {
        parent::__construct();
        $this->user = $user;
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function users($slug=null): View
    {
        return $this->getSomething($this->user, $slug);
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
            if ($request->input('password')) $validationArr['password'] = Password::defaults();
            $fields = $this->validate($request, $validationArr);
            $fields = $this->getSpecialFields($this->user, $validationArr, $fields);
            $user = User::find($request->input('id'));
            if ($request->input('password')) $fields['password'] = bcrypt($fields['password']);
            $user->update($fields);
        } else {
            $validationArr['password'] = Password::defaults();
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
        return $this->deleteSomething($request, $this->user);
    }
}
