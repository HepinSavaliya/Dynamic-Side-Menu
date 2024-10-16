<ul>
    @foreach ($menuTree as $menu)
        <li class="{{ $menu['class'] }}">
            <a href="" class="{{ in_array(request()->route()->getName(), $menu['menu_active']) ? 'active' : '' }}">
                {!! $menu['html'] !!} {{ $menu['title'] }}
            </a>
            @if (isset($menu['children']) && count($menu['children']) > 0)
                <ul>
                    @include('sidemenu.sidebar', ['menuTree' => $menu['children']])
                </ul>
            @endif
        </li>
    @endforeach
</ul>