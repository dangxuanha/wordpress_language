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
if ((int)$parameters['index']%2!=0) $class = 'gray ';
$options = ST_Page_Builder::get_page_options($post->ID, array());
?>
<li <?php post_class($class .'clearfix img-type-'.esc_attr($parameters['thumbnail_type'])); ?>  id="post-<?php the_ID(); ?>">
    
    <?php if (isset($options['date_start']) && ($date_start = $options['date_start']) != '') { ?>
    <div class="date-news">
    <?php printf(__('<strong>%s</strong>%s','smooththemes'), date_i18n('d', strtotime($date_start)), date_i18n('M Y', strtotime($date_start))); ?>
    </div>
    <?php } ?>
    
    <div class="col-lg-9 col-md-9 col-sm-9">
        <h5>
            <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><i class="iconentypo-newspaper"></i><?php the_title(); ?></a>
        </h5>
        <?php the_excerpt(); ?>
    </div>
</li>