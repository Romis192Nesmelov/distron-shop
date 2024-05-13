{!! str_replace(
    ['%address%','%phone%','%mail%'],
    [
        $contacts[0]->contact,
        view('blocks.phone_block',['phone' => $contacts[1]->contact])->render(),
        view('blocks.email_block',['email' => $contacts[2]->contact])->render()
    ],
    $text
) !!}
