@foreach ($menuTree as $menu)
    <li data-id="{{ $menu['menu_id'] }}" data-parent-id="{{ $menu['parent_menu_id'] }}"  class="sortable-item ui-sortable-handle">
        {!! $menu['html'] !!} {{ $menu['title'] }}
        @if (isset($menu['children']) && count($menu['children']) > 0)
            <ul class="sortable ui-sortable">
                @include('sidemenu.sort_child', ['menuTree' => $menu['children']])
            </ul>
        @endif
    </li>
@endforeach
