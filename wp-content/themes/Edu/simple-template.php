<?php
/**
 * Template Name: Simple Page Template
 */
/*
 * HERE IS EXAMPLE HOW TO CREATE A CUSTOM PAGE TEMPLATE WITH ST  PAGE BUILDER
 *
 * EXAMPLE is a page with right sidebar
 *
 */
include('header.php');
global $post;
the_post();
$page_options = st_get_post_options($post->ID);
// Do something width $page_options
// Exmaple:
$sidebar ='sidebar_default';
$sidebar = ($page_options['right_sidebar']!='') ? $page_options['right_sidebar']  : $sidebar ;
?>
<?php get_template_part('layout','title'); ?>
<div class="main-wrapper">
    <div class="container main-wrapper-outer">
        <div class="main-wrapper-inner">
            <div class="row">
                <div class="col-lg-8 col-sm-8 col-md-8 column main-content">
                    <div <?php post_class(); ?>>
                        <?php // show thumbnails
                        $thumb = st_theme_post_thumbnail($post->ID,false, false); ?>
                        <?php if($thumb!=''){ ?>
                            <div class="post-thumbnail">
                                <?php echo $thumb; ?>
                            </div>
                        <?php } ?>
                        <?php
                        if(function_exists('st_the_builder_content')){
                            if(!st_the_builder_content($post->ID)){
                                the_content();
                            }
                        }else{
                            the_content();
                        }
                        ?>
                    </div><!-- /. end post_class -->
                </div>
                <div class="col-lg-4 col-sm-4 col-md-4 column sidebar  sidebar-right">
                    <?php
                    dynamic_sidebar($sidebar);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php') ?>
