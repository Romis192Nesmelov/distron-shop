<tr id="basket-row-{{ $id }}">
    <input type="hidden" class="basket-id" name="id[]" value="{{ $id }}" />
    <td class="align-middle basket-name">{{ $name }}</td>
    <td class="align-middle">@include('blocks.basket_counter_block', ['name' => 'value[]', 'min' => 0, 'value' => $value])</td>
    <td class="align-middle basket-price"><nobr>@include('blocks.price_block',['price' => $price])</nobr></td>
</tr>
