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
                                <div class="content clearfix">
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-6 col-md-6 column text-center">
                                            <div class="class-404">
                                                <?php _e('404','smooththemes'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6 col-md-6 column">
                                            <p>
                                               <?php  _e("We're sorry, but we can't find the page you were looking for. It's probably some thing we've done wrong but now we know about it we'll try to fix it. In the meantime, try one of these options:", 'smooththemes'); ?>
                                                </p>
                                                <ul class="normal-list">
                                                    <li><a href="#" onclick="history.back(); return false;"><?php _e('Go back to previous page','smooththemes'); ?></a></li>
                                                    <li><a href="<?php  echo site_url(); ?>"><?php _e('Go to homepage','smooththemes'); ?></a></li>
                                                </ul>
                                            <p></p>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
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
                                    <div class="content clearfix">
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-6 col-md-6 column text-center">
                                                <div class="class-404">
                                                    <?php _e('404','smooththemes'); ?>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-6 col-md-6 column">
                                                <p>
                                                   <?php  _e("We're sorry, but we can't find the page you were looking for. It's probably some thing we've done wrong but now we know about it we'll try to fix it. In the meantime, try one of these options:", 'smooththemes'); ?>
                                                    </p>
                                                    <ul class="normal-list">
                                                        <li><a href="#" onclick="history.back(); return false;"><?php _e('Go back to previous page','smooththemes'); ?></a></li>
                                                        <li><a href="<?php  echo site_url(); ?>"><?php _e('Go to homepage','smooththemes'); ?></a></li>
                                                    </ul>
                                                <p></p>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
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
                                        <div class="content clearfix">
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-6 col-md-6 column text-center">
                                                    <div class="class-404">
                                                        <?php _e('404','smooththemes'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-6 col-md-6 column">
                                                    <p>
                                                       <?php  _e("We're sorry, but we can't find the page you were looking for. It's probably some thing we've done wrong but now we know about it we'll try to fix it. In the meantime, try one of these options:", 'smooththemes'); ?>
                                                        </p>
                                                        <ul class="normal-list">
                                                            <li><a href="#" onclick="history.back(); return false;"><?php _e('Go back to previous page','smooththemes'); ?></a></li>
                                                            <li><a href="<?php  echo site_url(); ?>"><?php _e('Go to homepage','smooththemes'); ?></a></li>
                                                        </ul>
                                                    <p></p>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
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
