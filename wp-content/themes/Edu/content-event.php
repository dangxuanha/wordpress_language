<?php
global $post;
$date_format = get_option('date_format');
$author_id=$post->post_author;
$options = ST_Page_Builder::get_page_options($post->ID, array());
?>
<div <?php post_class(); ?>>
    <?php
    // show thumbnails
    if(st_get_setting('se_show_featured_img','y')!='n'){
    $thumb = st_theme_post_thumbnail($post->ID,array('force_video_size'=> false), false); ?>
    <?php if($thumb!=''){ ?>
        <div class="entry-thumbnail main-img">
            <?php 
                echo $thumb;
                if (($caption = $options['caption_featured_image']) != '')
                    echo '<p class="lead">'. $caption .'</p>'; 
            ?>
        </div>
    <?php }
    }
    ?>
    
    <h2 class="entry-title">
        <a  title="<?php printf( esc_attr__( 'Permalink to %s', 'smooththemes' ), the_title_attribute( 'echo=0' ) ); ?>"  rel="bookmark" href="<?php echo $link; ?>"><?php the_title(); ?></a>
    </h2>
    
    <?php
    // show post meta
    if(st_get_setting('se_show_post_meta','y')!='n'){ ?>
        <div class="entry-meta">
                <span class="meta-item blog-date"><i class="iconentypo-calendar"></i><?php printf(__('On <span class="txt">%s</span>','smooththemes'),date($date_format, strtotime($options['date_start']))); ?></span>
                <span class="meta-item blog-author">
                    <i class="iconentypo-user"></i>
                    <?php
                    printf('By  <a href="%1$s">%2$s</a>',esc_url( get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ) ), get_the_author_meta( 'display_name', $author_id ));
                    ?>
                </span>
                <span class="pull-right meta-item post-comments">
                    <i class="iconentypo-comment"></i>
                    <a title="<?php printf( esc_attr__( 'Permalink to %s', 'smooththemes' ), the_title_attribute( 'echo=0' ) ); ?>"  rel="bookmark" href="<?php echo get_comments_link(); ?>">
                        <?php comments_number(__('0 Comment','smooththemes'),__('1 Comment','smooththemes'),__('% Comments','smooththemes') ); ?>
                    </a>
               </span>
        </div>
    <?php } ?>
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
    if(st_get_setting('se_show_post_tag','y')!='n'){
        the_tags('<div class="entry-tags"> '.__('Tags: '),', ','</div>');
    }
    if(st_get_setting("se_show_author_desc",'y') != 'n'){
        st_theme_author_template($author_id);
    };
    if(st_get_setting("se_show_comments",'y') != 'n'){
    ?>
    <div id="comments">
        <?php comments_template('', true ); ?>
    </div><!-- /#comments-->
    <?php } ?>
</div><!-- /. end post_class -->