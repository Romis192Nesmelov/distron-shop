@include('blocks.input_block',[
    'name' => 'password',
    'type' => 'password',
    'label' => trans('auth.password'),
    'ajax' => true
])
@include('blocks.input_block',[
    'name' => 'password_confirmation',
    'type' => 'password',
    'label' => trans('auth.confirm_password'),
    'ajax' => true
])
