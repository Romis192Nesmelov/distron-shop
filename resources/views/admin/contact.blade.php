@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin.blocks.title_block')
        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('admin.edit_contact') }}" method="post">
                @csrf
                @include('admin.blocks.hidden_id_block',['id' => $contact->id])
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            @include('admin.blocks.radio_button_block',[
                                'values' => $types,
                                'name' => 'type',
                                'activeValue' => $contact->type
                            ])
                        </div>
                        <div class="col-md-9 col-sm-6 col-xs-12">
                            @include('blocks.input_block', [
                                'label' => trans('admin.contact'),
                                'name' => 'contact',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => trans('admin.contact'),
                                'value' => $contact->contact
                            ])
                        </div>
                    </div>
                </div>
                @include('admin.blocks.save_button_block')
            </form>
        </div>
    </div>
@endsection
