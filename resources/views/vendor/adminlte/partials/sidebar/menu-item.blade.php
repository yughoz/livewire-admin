@inject('menuItemHelper', 'JeroenNoten\LaravelAdminLte\Helpers\MenuItemHelper')

@if ($menuItemHelper->isHeader($item))

    {{-- Header --}}
    @include('adminlte::partials.sidebar.menu-item-header')

@elseif ($menuItemHelper->isSearchBar($item))

    {{-- Search form --}}
    @include('adminlte::partials.sidebar.menu-item-search-form')

@elseif ($menuItemHelper->isSubmenu($item))

    {{-- Treeview menu --}}
    @if (!empty($item['module']))
        @if(auth()->user()->can($item['module']) || auth()->user()->can('read '.$item['module']) )
            @include('adminlte::partials.sidebar.menu-item-treeview-menu')
        @endif
    @else
        @include('adminlte::partials.sidebar.menu-item-treeview-menu')
    @endif

@elseif ($menuItemHelper->isLink($item))

    {{-- Link --}}
    @if (!empty($item['module']))
        @if(auth()->user()->can($item['module']) || auth()->user()->can('read '.$item['module']) )
            @include('adminlte::partials.sidebar.menu-item-link')
        @endif
    @else
        @include('adminlte::partials.sidebar.menu-item-link')
    @endif


@endif
