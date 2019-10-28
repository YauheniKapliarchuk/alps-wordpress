@if (has_nav_menu('secondary_navigation'))
  <nav class="c-secondary-nav" role="navigation">
    @php
      $menu_name = 'secondary_navigation';
      $menu_locations = get_nav_menu_locations();
      $menu = wp_get_nav_menu_object( $menu_locations[ $menu_name ] );
      $secondary_nav = wp_get_nav_menu_items( $menu->term_id);
      $count = 0;
      $submenu = false;
      $parent = false;
      $parent_id = false;
    @endphp
    <ul class="c-secondary-nav__list">
      @php
        $secondary_nav = json_decode(json_encode($secondary_nav), true);
      @endphp
      @foreach ($secondary_nav as $nav)
        @php
          $link_url = $nav['url'];
          $link_text = $nav['title'];
          $link_classes = ($nav['classes'] ? ' ' . implode(' ', $nav['classes']) : '');
          $link_target = ($nav['target'] ? ' target="'. $nav['target'] . '"' : '');
          $link_title = ($nav['attr_title'] ? ' title="'. $nav['attr_title'] . '"' : '');
          $link_description = ($nav['description'] ? ' description="' . $nav['description'] . '"' : '');
          $link_rel = ($nav['xfn'] ? ' rel="'. $nav['xfn'] . '"' : '');
        @endphp
        @if (isset($secondary_nav[$count + 1]))
          @php $parent = $secondary_nav[$count + 1]['menu_item_parent']; @endphp
        @endif
        @if (!$nav['menu_item_parent'])
          @php $parent_id = $nav['ID']; @endphp
          <li class="c-secondary-nav__list-item has-subnav">
            <a href="{{ $link_url }}" class="c-secondary-nav__link u-font--secondary-nav u-color--gray u-theme--link-hover--base{{ $link_classes }}"{!! $link_target !!}{!! $link_title !!}{!! $link_description !!}{!! $link_rel !!}>{{ $link_text }}</a>
        @endif
        @if ($parent_id == $nav['menu_item_parent'])
          @if (!$submenu)
            @php $submenu = true; @endphp
            <span class="c-subnav__arrow o-arrow--down u-path-fill--gray"></span>
            <ul class="c-secondary-nav__subnav c-subnav">
          @endif
            <li class="c-secondary-nav__subnav__list-item c-subnav__list-item u-background-color--gray--light">
              <a href="{{ $link_url }}" class="c-secondary-nav__subnav__link c-subnav__link u-color--gray--dark u-theme--link-hover--base{{ $link_classes }}"{!! $link_target !!}{!! $link_title !!}{!! $link_description !!}{!! $link_rel !!}>{{ $link_text }}</a>
            </li>
          @if ($parent != $parent_id && $submenu)
            </ul> <!-- /.c-secondary-nav__subnav -->
            @php $submenu = false; @endphp
          @endif
        @endif
        @if ($parent_id && $parent != $parent_id)
          </li>
          @php $submenu = false; @endphp
        @endif
        @php $count++; @endphp
      @endforeach
      {!! wp_reset_postdata() !!}
    </ul> <!-- /.c-secondary-nav__list -->
    <li class="c-secondary-nav__list-item c-secondary-nav__list-item__search c-secondary-nav__list-item__toggle js-toggle-menu js-toggle-search is-priority">
      <a href="#" class="c-secondary-nav__link u-font--secondary-nav u-color--gray u-theme--link-hover--base">
        <span class="u-icon u-icon--xs u-path-fill--gray">@include('patterns.00-atoms.icons.icon-search')</span>{{_e("Search", "alps") }}
      </a>
    </li>
    <li class="c-secondary-nav__list-item c-secondary-nav__list-item__menu c-secondary-nav__list-item__toggle js-toggle-menu is-priority">
      <a href="#" class="c-secondary-nav__link u-font--secondary-nav u-color--gray u-theme--link-hover--base">
        <span class="u-icon u-icon--xs u-path-fill--gray">@include('patterns.00-atoms.icons.icon-menu')</span>{{ _e("Menu", "alps") }}
      </a>
    </li>
  </nav> <!-- /.c-secondary-nav -->
@endif