<li
    {{ isset($id) && $id ? 'id='.$id : '' }}
    class="nav-item {{ isset($active) && $active == $menuItemKey ? 'active' : '' }}
    {{ isset($addClass) && $addClass ? $addClass : '' }}
    {{ isset($dropdown) && is_array($dropdown) ? 'dropdown' : '' }}"

>
    @if (isset($dropdown) && is_array($dropdown))
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown{{ $menuItemKey }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{!! $name !!}</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown{{ $menuItemKey }}">
            @foreach($dropdown as $subMenu)
                <a class="dropdown-item" href="{{ $subMenu['href'] }}">{{ $subMenu['name'] }}</a>
            @endforeach
        </div>
    @else
        <a class="nav-link" href="{{ $menuItem['href'] }}">{!! $menuItem['name'] !!}</a>
    @endif
</li>
