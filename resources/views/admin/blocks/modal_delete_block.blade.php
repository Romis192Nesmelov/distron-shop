<x-modal id="{{ $id ?? 'delete-modal' }}" head="{{ trans('admin.warning') }}" del_function="{{ route('admin.delete_'.($custom_key ?? $singular_key)) }}" footer="1" yes_button="1">
    <h3>{{ trans('admin.do_you_really_want_delete_this_'.($custom_key ?? $singular_key)) }}</h3>
</x-modal>
