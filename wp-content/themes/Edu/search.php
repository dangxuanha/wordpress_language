<?php
/*
 * This is file called by ST PAGE BUILDER plugins
 *
 */
get_header();
global $post, $st_options;
the_post();
$page_options = array(
    'layout' => st_get_setting('layout', 'left-sidebar'),
    'left_sidebar' => st_get_setting('left_sidebar', 'sidebar_default'),
    'right_sidebar' => st_get_setting('right_sidebar', 'sidebar_default'),
);
?>
<?php get_template_part('layout','title'); ?>
<div class="main-wrapper">
    <div class="container main-wrapper-outer">
        <div class="main-wrapper-inner">
            <div class="row" >
                <?php
                switch($page_options['layout']){
                    case 'no-sidebar': // full width no siderbar - one- columns
                        ?>
                        <div class="col-lg-12 col-sm-12 col-md-12  column">
                            <div class="list-post">
                                <?php
                                if(have_posts()): while(have_posts()): the_post();
                                    get_template_part('loop/loop','search');
                                endwhile; 
                                else :
                                ?>
                                <p class="not-found"><?php _e('Not found !', 'smooththemes'); ?></p>
                                <?php    
                                endif;
        
                                $p = st_post_pagination('',2,false);
                                if($p!=''){
                                    echo '<div class="st-pagination-wrap">'.$p.'</div>';
                                }
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
                            dynamic_sidebar($page_options['left_sidebar']);
                            ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-md-6  column main-content">
                            <div class="wrap-primary">
                                <div class="list-post">
                                    <?php
                                    if(have_posts()): while(have_posts()): the_post();
                                        get_template_part('loop/loop','search');
                                    endwhile; 
                                    else :
                                    ?>
                                    <p class="not-found"><?php _e('Not found !', 'smooththemes'); ?></p>
                                    <?php 
                                    endif;
            
                                    $p = st_post_pagination('',2,false);
                                    if($p!=''){
                                        echo '<div class="st-pagination-wrap">'.$p.'</div>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-md-3 column sidebar sidebar-right">
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
    
                            <div class="col-lg-8 col-sm-8 col-md-8  column main-content">
                                <div class="wrap-primary">
                                    <div class="list-post">
                                        <?php
                                        if(have_posts()): while(have_posts()): the_post();
                                            get_template_part('loop/loop','search');
                                        endwhile; 
                                        else :
                                        ?>
                                        <p class="not-found"><?php _e('Not found !', 'smooththemes'); ?></p>
                                        <?php 
                                        endif;
                
                                        $p = st_post_pagination('',2,false);
                                        if($p!=''){
                                            echo '<div class="st-pagination-wrap">'.$p.'</div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        break;
                }
                ?>
            </div>
        </div>
    </div><!-- end .containner -->
</div><!-- /.main-wrapper -->
<?php get_footer(); ?>
