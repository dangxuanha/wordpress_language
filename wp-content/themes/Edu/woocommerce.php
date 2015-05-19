<?php
get_header();
global  $st_options;
$page_options = st_get_post_options(st_get_shop_page());
global $woocommerce_loop;
if(!isset($page_options['shop_columns']) ||  intval($page_options['shop_columns'])<=1){
    $page_options['shop_columns'] = 3;
}
$woocommerce_loop['columns'] =  $page_options['shop_columns'];
$sidebar = get_query_var('sidebar');
if ( isset($sidebar) && in_array($sidebar, array('left', 'right')) ) {
    $page_options = array(
        'layout'    => $sidebar .'-sidebar',
        'left_sidebar'  => 'sidebar_product',
        'right_sidebar' => 'sidebar_product'
    );
}
?>
<?php get_template_part('layout','title'); ?>
<div class="main-wrapper">
    <div class="container main-wrapper-outer">
        <div class="main-wrapper-inner">
            <div class=" row" >
                <?php
                switch($page_options['layout']){
                    case 'no-sidebar': // full width no siderbar - one- columns
                        ?>
                        <div class="col-lg-12 col-sm-12 col-md-12  column">
                            <div class="wrap-primary">
                                <?php
                                woocommerce_content();
                                ?>
                            </div>
                        </div>
                        <?php
                        break;
                    case 'right-sidebar': // right column - 2 columns
                        ?>
                        
                        <div class="col-lg-8 col-sm-8 col-md-8 column main-content">
                            <div class="wrap-primary">
                                <?php
                                woocommerce_content();
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-4  col-sm-4 col-md-4  column sidebar sidebar-right">
                            <div class="wrap-sidebar">
                                <?php
                                dynamic_sidebar($page_options['right_sidebar']);
                                ?>
                            </div>
                        </div>
                        <?php
                        break;
                    case 'left-right-sidebar': // left and right  sidebar -  3 columns
                        ?>
                        <div class="col-lg-3 col-sm-3 col-md-3  column sidebar sidebar-left">
                            <div class="wrap-sidebar">
                                <?php
                                //echo   ($page_options['left_sidebar']);
                                dynamic_sidebar($page_options['left_sidebar']);
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-md-6  column main-content">
                            <div class="wrap-primary">
                                <?php
                                woocommerce_content();
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-md-3  column sidebar sidebar-right">
                            <div class="wrap-sidebar">
                                <?php
                                dynamic_sidebar($page_options['right_sidebar']);
                                ?>
                            </div>
                        </div>
                        <?php
                        break;
                    default : // left sidebar - 2 columns
                        ?>
                            <div class="col-lg-4  col-sm-4 col-md-4  column sidebar sidebar-left">
                                <div class="wrap-sidebar">
                                    <?php
                                    dynamic_sidebar($page_options['left_sidebar']);
                                    ?>
                                </div>
                            </div>
    
                            <div class="col-lg-8 col-sm-8 col-md-8 column main-content">
                                <div class="wrap-primary">
                                    <?php
                                    woocommerce_content();
                                    ?>
                                </div>
                            </div>
                        <?php
                        break;
                }
                ?>
            </div>
        </div>
    </div><!-- end .containner -->
</div>
<?php get_footer(); ?>
