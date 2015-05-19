- Support 2 gird: 1140 and 940 (require width of site >= 1024px)

- How to use:

<?php
wp_nav_menu( array(
    'theme_location' => 'Primary_Navigation',
    'menu_class' => 'main-menu' ,
    'menu_id' =>'megaST', // This is Mega Menu ID
    'container_id'=>'megaMenu', // This is Mega Menu Container,
    'fallback_cb'     => 'st_wp_page_menu',
    'walker'=> new st_responsive_mega_menu()
) );
?>

- If not use style of default Megamenu then define
    ST_MEGAMENU_USE_CSS = false;