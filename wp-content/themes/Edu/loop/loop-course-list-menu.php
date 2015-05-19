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
?>
<div <?php post_class('clearfix img-type-'.esc_attr($parameters['thumbnail_type'])); ?>  id="post-<?php the_ID(); ?>">
    
    <h5>
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><i class="iconentypo-book"></i><?php the_title(); ?></a>
    </h5>
    
    <div class="description">
        <?php the_excerpt(); ?>
        <a href="<?php echo $link; ?>" class="btn btn-sm btn-color"><?php _e('Read more','smooththemes'); ?></a>
    </div>
</div>