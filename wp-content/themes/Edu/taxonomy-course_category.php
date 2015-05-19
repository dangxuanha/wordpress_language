<?php include('header.php');
global $post;
?>
<?php get_template_part('layout','title'); ?>
<div class="main-wrapper">
    <div class="container main-wrapper-outer">
        <div class="main-wrapper-inner">
            <div class="row">
                <div class="col-lg-4 col-sm-4 col-md-4 column sidebar  sidebar-left">
                    <?php
                    $sidebar ='sidebar_default';
                    if(is_singular() ||  is_page()){
                        global $post;
                        $page_options = st_get_post_options($post->ID);
                        $sidebar = ($page_options['right_sidebar']!='') ? $page_options['right_sidebar']  : $sidebar ;
                    }
                    ?>
                    <div class="wrap-sidebar">
                        <?php
                        dynamic_sidebar($sidebar);
                        ?>
                    </div>

                </div>

                <div class="col-lg-8 col-sm-8 col-md-8 column main-content">

                        <div class="col-right">
                            <div class="item-inner stpb-custom-course">
                                <?php if(have_posts()): ?>
                                <div class="list-post list">
                                    <?php
                                    while(have_posts()): the_post();
                                    get_template_part('loop/loop','course-list');
                                    endwhile;
                                    ?>
                                </div>
                                <?php
                                endif;
                                $p = st_post_pagination('',2,false);
                                if($p!=''){
                                    echo '<div class="st-pagination-wrap">'.$p.'</div>';
                                }
                                ?>
                            </div>

                            <div class="clear"></div>
                        </div>

                </div>
                
            </div>
        </div>
    </div>
</div>
<?php include('footer.php') ?>
