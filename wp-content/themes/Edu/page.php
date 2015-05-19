<?php include('header.php');
global $post;
the_post();
?>
<?php get_template_part('layout','title'); ?>
<div class="main-wrapper">
    <div class="container main-wrapper-outer">
        <div class="main-wrapper-inner">
            <div class="row">
                <div class="col-lg-8 col-sm-8 col-md-8 column main-content">
                    <?php get_template_part('content','page'); ?>
                </div>
                <div class="col-lg-4 col-sm-4 col-md-4 column sidebar  sidebar-left">
                    <?php
                    $sidebar ='sidebar_default';
                    if(is_singular() ||  is_page()){
                        global $post;
                        $page_options = st_get_post_options($post->ID);
                        $sidebar = ($page_options['left_sidebar']!='') ? $page_options['left_sidebar']  : $sidebar ;

                    }
                    dynamic_sidebar($sidebar);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php') ?>
