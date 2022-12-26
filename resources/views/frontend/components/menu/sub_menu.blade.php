<li>
    <a href="{{ $menu['link'] ?? '' }}">{{ $menu['label'] ?? '' }}</a>
    @if (count($menu['children'] ?? []) > 0)
        <ul class="nav-dropdown">
            @foreach ($menu['children'] as $children)
                @include('frontend/components/menu/sub_menu', ['menu' => $children])
            @endforeach
        </ul>
    @endif
</li>
