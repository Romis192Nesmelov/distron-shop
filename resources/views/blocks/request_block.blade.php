@include('blocks.input_block',[
    'name' => 'name',
    'type' => 'text',
    'label' => trans('content.your_name'),
    'placeholder' => trans('content.your_name'),
    'ajax' => true,
])

@include('blocks.input_block',[
    'name' => 'email',
    'type' => 'email',
    'label' => trans('content.your_email'),
    'placeholder' => trans('content.your_email'),
    'ajax' => true,
])

@include('blocks.input_block',[
    'name' => 'phone',
    'type' => 'phone',
    'label' => trans('content.your_phone'),
    'placeholder' => '+7(___)___-__-__',
    'ajax' => true,
])
@include('blocks.checkbox_block',[
    'name' => 'i_agree',
    'label' => trans('content.i_agree')
])
