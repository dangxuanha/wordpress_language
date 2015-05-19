<?php
global $post;
?>
<div <?php post_class(); ?>>
    <?php // show thumbnails
    $thumb = st_theme_post_thumbnail($post->ID,array('force_video_size'=> false), false); ?>
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