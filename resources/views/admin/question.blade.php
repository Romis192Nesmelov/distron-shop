@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin.blocks.title_block')
        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('admin.edit_question') }}" method="post">
                @csrf
                @if (isset($question))
                    @include('admin.blocks.hidden_id_block',['id' => $question->id])
                @endif
                <div class="panel panel-flat">
                    <div class="panel-body">
                        @include('blocks.input_block', [
                            'label' => trans('admin.question'),
                            'name' => 'question',
                            'type' => 'text',
                            'max' => 255,
                            'placeholder' => trans('admin.question'),
                            'value' => isset($question) ? $question->question : ''
                        ])
                        @include('blocks.textarea_block',[
                            'label' => trans('admin.answer'),
                            'name' => 'answer',
                            'max' => 3000,
                            'placeholder' => trans('admin.answer'),
                            'value' => isset($question) ? $question->answer : '',
                            'simple' => true
                        ])
                        @include('admin.blocks.checkbox_block',[
                            'name' => 'active',
                            'label' => trans('admin.active'),
                            'checked' => isset($question) ? $question->active : true
                        ])
                    </div>
                </div>
                @include('admin.blocks.save_button_block')
            </form>
        </div>
    </div>
@endsection
