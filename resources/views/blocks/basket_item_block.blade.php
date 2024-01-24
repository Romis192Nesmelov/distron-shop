<tr class="basket-row" id="basket-row-{{ $id }}">
    <input type="hidden" class="basket-id" name="id[]" value="{{ $id }}" />
    <td class="item-props align-middle ps-2">
        <h5 class="basket-name mb-0">{{ getItemHead($item) }}</h5>
        <p class="basket-props lh-sm mb-0 {{ !getItemProps($item) ? 'd-none' : '' }}"><small>{!! getItemProps($item) !!}</small></p>
    </td>
    <td class="align-middle">@include('blocks.basket_counter_block', ['name' => 'value[]', 'min' => 0, 'value' => $value])</td>
    <td class="align-middle basket-price"><nobr>@include('blocks.price_block',['price' => $price])</nobr></td>
</tr>
