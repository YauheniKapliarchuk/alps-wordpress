<?php
  $menu_args = array(
    'echo' => false,
    'menu_class' => 'primary-nav__list',
    'container' => false,
    'depth' => 2,
    'theme_location' => 'primary_navigation'
  );

  // Native WordPress menu classes to be replaced.
  $replace = array(
    'menu-item ',
    'sub-menu',
    'current-menu-item',
    'current_page_item',
    'menu-item-has-children',
    '<a'
  );

  // Custom ALPS classes to replace.
  $replace_with = array(
    'primary-nav__list-item ',
    'primary-nav__subnav',
    'active',
    'active',
    'primary-nav--with-subnav js-hover',
    '<a class="primary-nav__link theme--primary-text-color" '
  );
?>
<?php if (has_nav_menu('primary_navigation')): ?>
  <nav class="primary-nav toggled-element" id="primary-nav" role="navigation" data-active-target="primary-nav">
    <?php echo str_replace($replace, $replace_with, wp_nav_menu($menu_args)); ?>
  </nav>
<?php endif; ?>
