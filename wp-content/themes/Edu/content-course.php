<?php
global $post;
$date_format = get_option('date_format');
$author_id=$post->post_author;
$options = ST_Page_Builder::get_page_options($post->ID, array());
?>
<div <?php post_class(); ?>>
    <?php
    // show thumbnails
    if(st_get_setting('sc_show_featured_img','y')!='n'){
    $thumb = st_theme_post_thumbnail($post->ID,array('force_video_size'=> false), false); ?>
    <?php if($thumb!=''){ ?>
        <div class="entry-thumbnail main-img">
            <?php 
                echo $thumb;
                if (isset($options['count_lessons']) && ($caption = $options['caption_featured_image']) != '')
                    echo '<p class="lead">'. $caption .'</p>'; 
            ?>
        </div>
    <?php }
    }
    ?>
    <div class="entry-content">
    <?php
    // show the content
    if(function_exists('st_the_builder_content')){
        if(!st_the_builder_content($post->ID)){
            the_content();
        }
    }else{
        the_content();
    }
    ?>
    </div>
    <?php
    // pagination for single
    $args = array(
        'before'           => '<p class="single-pagination">' . __('Pages:','smooththemes'),
        'after'            => '</p>',
        'link_before'      => '',
        'link_after'       => '',
        'next_or_number'   => 'number',
        'nextpagelink'     => __('Next page','smooththemes'),
        'previouspagelink' => __('Previous page','smooththemes'),
        'pagelink'         => '%',
        'echo'             => 1
    );
    wp_link_pages( $args );
    if(st_get_setting('sc_show_post_tag','y')!='n'){
        echo get_the_term_list( $post->ID, 'course_category', '<div class="entry-tags"> '.__('Categories: '), ', ', '</div>' );
    }
    if(st_get_setting("sc_show_author_desc",'y') != 'n'){
        st_theme_author_template($author_id);
    };
    if(st_get_setting("sc_show_comments",'y') != 'n'){
    ?>
    <div id="comments">
        <?php comments_template('', true ); ?>
    </div><!-- /#comments-->
    <?php } ?>
</div><!-- /. end post_class -->