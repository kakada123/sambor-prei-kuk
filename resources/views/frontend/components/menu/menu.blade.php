<!-- nav menu start-->
@php($menus = mainMenus())
<ul class="nav-menu">
    <li class="{{ Route::currentRouteName() === 'home' ? 'active' : '' }}">
        <a href="{{ route('home') }}">@lang('app.home')</a>
    </li>
    @foreach ($menus as $menu)
        <li class="{{ $menu['active'] ?? '' }}">
            <a href="{{ $menu['link'] ?? '' }}">{{ $menu['label'] ?? '' }}</a>
            @if (count($menu['children'] ?? []) > 0)
                <ul class="nav-dropdown">
                    @foreach ($menu['children'] as $children)
                        @include('frontend/components/menu/sub_menu', ['menu' => $children])
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>
<!--nav menu end-->
