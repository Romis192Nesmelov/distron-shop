@include('blocks.input_block',[
    'name' => 'name',
    'label' => trans('content.your_name'),
    'required' => true,
    'placeholder' => trans('content.your_name')
])
@include('blocks.input_block',[
    'name' => 'email',
    'label' => trans('content.your_email'),
    'required' => true,
    'placeholder' => trans('content.your_email')
])
@include('blocks.input_block',[
    'name' => 'phone',
    'label' => trans('content.your_phone'),
    'required' => true,
    'placeholder' => '+7(___)___-__-__'
])
@include('blocks.checkbox_block',[
    'name' => 'i_agree',
    'label' => trans('content.i_agree')
])
