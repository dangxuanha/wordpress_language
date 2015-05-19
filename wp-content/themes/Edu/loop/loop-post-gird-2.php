<?php
global $post;
$date_format = get_option('date_format');
if(!isset($parameters)){
    $parameters = array();
}
// this parameter come from shortcode blog
$parameters = wp_parse_args($parameters, array(
    'thumbnail_type'=>'full-width',
    'thumb_size' => '',
));
$link = get_permalink($post->ID);
$author_id = $post->author_id;
$class = (isset($class)) ? $class : '';
?>
<article <?php post_class('clearfix img-type-'.esc_attr($parameters['thumbnail_type'])); ?>  id="post-<?php the_ID(); ?>">
    
    <h2 class="entry-title">
        <a  title="<?php printf( esc_attr__( 'Permalink to %s', 'smooththemes' ), the_title_attribute( 'echo=0' ) ); ?>"  rel="bookmark" href="<?php echo $link; ?>"><?php the_title(); ?></a>
    </h2>
    
    <?php $thumb = st_theme_post_thumbnail($post->ID,array('size'=> $parameters['thumb_size']), false); ?>
    
    <?php if($thumb!=''){ ?>
    <?php echo (is_sticky()) ? '<span class="sticky-icon"><i class="iconentypo-pin"></i></span>' : ''; ?>
    <div class="<?php echo $class; ?> entry-thumbnail">
        <?php echo $thumb; ?>
    </div>
    <?php } ?> 
    <div class="entry-meta clearfix">
            <span class="meta-item blog-date"><i class="iconentypo-calendar"></i><?php printf(__('On <span class="txt">%s</span>','smooththemes'),get_the_time($date_format)); ?></span>
            <span class="pull-right meta-item post-comments">
                <i class="iconentypo-comment"></i>
                <a title="<?php printf( esc_attr__( 'Permalink to %s', 'smooththemes' ), the_title_attribute( 'echo=0' ) ); ?>"  rel="bookmark" href="<?php echo get_comments_link(); ?>">
                    <?php comments_number(__('0 Comment','smooththemes'),__('1 Comment','smooththemes'),__('% Comments','smooththemes') ); ?>
                </a>
           </span>
    </div>
    <div class="entry-excerpt">
        <?php the_excerpt(); ?>
    </div>
    <div class="entry-more">
        <a href="<?php echo $link; ?>" class="btn btn-default"><?php _e('Read more','smooththemes'); ?></a>
    </div>
</article>