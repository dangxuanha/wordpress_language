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
<div <?php post_class('strip-courses '. $class .'clearfix img-type-'.esc_attr($parameters['thumbnail_type'])); ?>  id="post-<?php the_ID(); ?>">
    
    <div class="title-course">
        <h3>
            <?php the_title(); ?>
        </h3>
        <ul >
            <?php if (isset($options['date_start']) && ($date_start = $options['date_start']) != '') { ?>
       		<li class="course-date"><i class="iconentypo-calendar"></i><?php printf(__('Start date: %s','smooththemes'), date_i18n($date_format, strtotime($date_start))); ?></li>
            <?php } ?>
            <li><i class="iconentypo-bookmark"></i><?php printf(__('ID: %s','smooththemes'),get_the_ID()); ?></li>
       </ul>
    </div>
    
    <div class="description">
        <?php the_excerpt(); ?>
        <ul>
            <?php if (isset($options['count_lessons']) && ($lessons = $options['count_lessons']) != '') { ?>
        	<li><i class="iconentypo-book"></i><?php printf(__('%s Lessons','smooththemes'),$lessons); ?></li>
            <?php } ?>
            <?php if (isset($options['level']) && ($level = $options['level']) != '') { ?>
            <li><i class="iconentypo-menu"></i><?php printf(__('Level %s','smooththemes'),$level); ?></li>
            <?php } ?>
            <?php if (isset($options['type']) && ($type = $options['type']) != '') { ?>
            <li class="online"><i class="iconentypo-monitor"></i><?php echo $type; ?></li>
            <?php } ?>
        </ul>
        <a href="<?php echo $link; ?>" class="btn btn-sm btn-default button-align-2"><?php _e('Read more','smooththemes'); ?></a>
    </div>
</div>