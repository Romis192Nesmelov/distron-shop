<div class="col-md-3 col-sm-6 col-xs-12 contacts">
    <table class="mb-4">
        @foreach($contacts as $contact)
            <tr>
            @if ($contact->type == 4) @php $map = $contact->contact @endphp
            @elseif ($contact->type < 4)
                @php
                    switch ($contact->type) {
                        case 1:
                            $label = trans('content.address');
                            $contact = $contact->contact;
                            break;
                        case 2:
                            $label = trans('content.phone');
                            $contact = view('blocks.phone_block',['phone' => $contact->contact])->render();
                            break;
                        case 3:
                            $label = 'E-mail';
                            $contact = view('blocks.email_block',['email' => $contact->contact])->render();
                            break;
                    }
                @endphp
                <td><b>{{ $label }}:</b></td>
                <td>{!! $contact !!}</td>
            @endif
            </tr>
        @endforeach
    </table>
    @include('blocks.button_block',[
        'primary' => true,
        'addClass' => 'wow animate__animated animate__fadeIn',
        'addAttr' => ['data-wow-delay' => '.3s'],
        'dataTarget' => 'feedback-modal',
        'buttonText' => trans('content.leave_request')
    ])
</div>
<div class="col-md-9 col-sm-6 col-xs-12">
    @if (isset($map))
        {!! $map !!}
    @endif
</div>
