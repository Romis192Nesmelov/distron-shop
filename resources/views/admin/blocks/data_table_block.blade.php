<table class="table datatable-basic table-striped table-items">
    <tr>
        <th class="id">id</th>
        @foreach ($columns as $column)
            @if (!$column) <th class="text-center"></th>
            @elseif ($column == 'active')
                <th class="text-center">{{ trans('admin.status') }}</th>
            @elseif ($column == 'komrex')
                <th class="text-center">{{ trans('admin.komrex_technic') }}</th>
            @else
                <th class="text-center">
                    {{ trans('admin.'.$column) }}
                    @if ($column == 'weight')
                        ({{ trans('admin.kg') }})
                    @elseif ($column == 'power')
                        ({{ trans('admin.kilowatt').'/'.trans('admin.horse_power') }})
                    @endif
                </th>
            @endif
        @endforeach
        @if ($useEdit)
            @include('admin.blocks.th_edit_cell_block')
        @endif
        @if ($useDelete)
            @include('admin.blocks.th_delete_cell_block')
        @endif
    </tr>
    @foreach ($items as $item)
        <tr role="row">
            <td class="id">{{ $item->id }}</td>
            @foreach ($columns as $column)
                @if ($column == 'image')
                    @include('admin.blocks.datatable_image_block')
                @elseif ($column == 'pdf')
                    <td>
                        <i class="icon-file-pdf"></i>
                        <a href="{{ asset($item->pdf) }}" target="_blank">{{ pathinfo($item->pdf)['basename'] }}</a>
                    </td>
                @elseif ($column == 'video')
                    <td class="text-center">
                        @include('blocks.video_block',['video' => $item->video])
                    </td>
                @elseif ($column == 'text' || $column == 'description')
                    <td class="text-left">
                        @include('admin.blocks.cropped_content_block',['croppingContent' => $item[$column], 'length' => 200])
                    </td>
                @elseif ($column == 'date')
                    <td class="text-center">{{ is_int($item->date) ? date('d.m.Y',$item->date) : $item->date }}</td>
                @elseif ($column == 'user')
                    <td class="text-center">@include('blocks.email_block',['icon' => 'icon-mail-read', 'email' => $item->user->email])</td>
                @elseif ($column == 'active')
                    @include('admin.blocks.status_block',['status' => $item->active, 'positive' => trans('admin.active'), 'negative' => trans('admin.not_active')])
                @elseif ($column == 'is_admin')
                    @include('admin.blocks.status_block',['status' => $item->is_admin, 'positive' => trans('admin.yes'), 'negative' => trans('admin.no')])
                @elseif ($column == 'status')
                    @include('admin.blocks.status_multi_block',['status' => $item->status, 'status_text' => trans('admin.order_status'.($item->status + 1))])
                @elseif ($column == 'delivery')
                    @include('admin.blocks.status_block',['status' => $item->delivery, 'positive' => trans('admin.yes'), 'negative' => trans('admin.no')])
                @elseif (preg_match('/^(\<iframe)/',$item[$column]))
                    <td class="text-center">{!! $item[$column] !!}</td>
                @elseif ($column == 'price')
                    <td class="text-center">@include('blocks.price_block',['price' => $item->price])</td>
                @else
                    <td class="text-center {{ $column == 'head' || $column == 'email' ? 'head' : '' }}">
                        {{ $item[$column] }}
                    </td>
                @endif
            @endforeach
            @if ($useEdit)
                @if (isset($route))
                    @include('admin.blocks.edit_cell_block', ['href' => route('admin.'.$route, ['id' => $item->id, 'parent_id' => ($parent_id ?? '')])])
                @else
                    @include('admin.blocks.edit_cell_block', ['href' => route('admin.'.$menu[$menu_key]['key'], ['id' => $item->id])])
                @endif
            @endif
            @if ($useDelete)
                @include('admin.blocks.delete_cell_block',['id' => $item->id])
            @endif
        </tr>
    @endforeach
</table>
