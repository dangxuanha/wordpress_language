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
$class = '';
if ((int)$parameters['index']==0) $class = ' ribbon ';
$options = ST_Page_Builder::get_page_options($post->ID, array());
?>
<li <?php post_class('box-style-1 borders"'. $class .'clearfix img-type-'.esc_attr($parameters['thumbnail_type'])); ?>  id="post-<?php the_ID(); ?>">
    
    <?php if (isset($options['date_start']) && ($date_start = $options['date_start']) != '') { ?>
    <span class="date">
    <i class="iconentypo-calendar"></i><?php echo date_i18n($date_format, strtotime($date_start)); ?>
    </span>
    <?php } ?>
    
    <h4>
        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a>
    </h4>
    
    <?php the_excerpt(); ?>
</li>