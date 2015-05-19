<?php
/*
 * This is file called by ST PAGE BUILDER plugins
 *
 */
get_header();
global $post, $st_options;
the_post();
$page_options = st_get_post_options($post->ID);

if (!isset($page_options['left_sidebar']) || $page_options['left_sidebar'] == '') $page_options['left_sidebar'] = 'sidebar_default';
if (!isset($page_options['right_sidebar']) || $page_options['right_sidebar'] == '') $page_options['right_sidebar'] = 'sidebar_default';

// Set sidebar default for Single Course + Single Event
if (is_singular('course')) {
    $page_options = array(
        'layout'    => st_get_setting('layout_course', 'left-sidebar'),
        'left_sidebar'  => st_get_setting('course_left_sidebar', 'sidebar_course'),
        'right_sidebar' => st_get_setting('course_right_sidebar', 'sidebar_course')
    );
}
elseif (is_singular('event')) {
    $page_options = array(
        'layout'    => st_get_setting('layout_event', 'left-sidebar'),
        'left_sidebar'  => st_get_setting('event_left_sidebar', 'sidebar_event'),
        'right_sidebar' => st_get_setting('event_right_sidebar', 'sidebar_event')
    );
}

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
                        <div class="col-lg-12 col-sm-12 col-md-12  column no-sidebar main-content">
                            <?php
                            if(is_single()){
                                if (is_singular('course')) {
                                    get_template_part('content','course');
                                } elseif (is_singular('event')) {
                                    get_template_part('content','event');
                                } else {
                                    get_template_part('content','single');
                                }
                            } else{
                                get_template_part('content','page');
                            }
                            ?>
                        </div>
                        <?php
                        break;
                    case 'left-sidebar': // left column - 2 columns
                        ?>
                        <div class="col-lg-8 col-sm-8 col-md-8  column main-content page-has-leftsidebar">
                            <div class="wrap-primary">
                                <?php
                                if(is_single()){
                                    if (is_singular('course')) {
                                        get_template_part('content','course');
                                    } elseif (is_singular('event')) {
                                        get_template_part('content','event');
                                    } else {
                                        get_template_part('content','single');
                                    }
                                } else{
    
                                    get_template_part('content','page');
                                }
                                ?>
                            </div>
                        </div>

                        <div class="col-lg-4  col-sm-4 col-md-4  column sidebar sidebar-left page-has-leftsidebar">
                            <div class="wrap-sidebar">
                                <?php
                                dynamic_sidebar($page_options['left_sidebar']);
                                ?>
                            </div>
                        </div>
                        
                        <?php
                        break;
                    case 'right-sidebar': // right column - 2 columns
                        ?>
                        <div class="col-lg-8 col-sm-8 col-md-8  column main-content">
                            <div class="wrap-primary">
                                <?php
                                if(is_single()){
                                    if (is_singular('course')) {
                                        get_template_part('content','course');
                                    } elseif (is_singular('event')) {
                                        get_template_part('content','event');
                                    } else {
                                        get_template_part('content','single');
                                    }
                                } else{

                                    get_template_part('content','page');
                                }
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
                            dynamic_sidebar($page_options['left_sidebar']);
                            ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-md-6  column main-content">
                            <div class="wrap-primary">
                                <?php
                                if(is_single()){
                                    if (is_singular('course')) {
                                        get_template_part('content','course');
                                    } elseif (is_singular('event')) {
                                        get_template_part('content','event');
                                    } else {
                                        get_template_part('content','single');
                                    }
                                } else{
    
                                    get_template_part('content','page');
                                }
                                ?>
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
                                    <?php
                                    if(is_single()){
                                        if (is_singular('course')) {
                                            get_template_part('content','course');
                                        } elseif (is_singular('event')) {
                                            get_template_part('content','event');
                                        } else {
                                            get_template_part('content','single');
                                        }
                                    } else{
        
                                        get_template_part('content','page');
                                    }
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
</div><!-- /.main-wrapper -->
<?php get_footer(); ?>
