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
    
    <?php if($parameters['thumbnail_type']=='full-width'){ ?>
    <h2 class="entry-title">
        <a  title="<?php printf( esc_attr__( 'Permalink to %s', 'smooththemes' ), the_title_attribute( 'echo=0' ) ); ?>"  rel="bookmark" href="<?php echo $link; ?>"><?php the_title(); ?></a>
    </h2>
    <?php } ?>
    
    <?php $thumb = st_theme_post_thumbnail($post->ID,array('size'=> $parameters['thumb_size']), false); ?>
    
    <?php if($thumb!='' && $parameters['thumbnail_type']=='full-width'){ ?>
    <div class="<?php echo $class; ?> entry-thumbnail">
        <?php echo $thumb; ?>
    </div>
    <?php } ?> 
    <?php
    
    $class = 'col-lg-6 col-sm-6 col-md-6';
    if($thumb==''){
        $class = 'col-lg-12 col-sm-12 col-md-12';
    }
    ?>
    <?php if($parameters['thumbnail_type']!='full-width'){ ?>
        <div class="row">
            <?php if($thumb!=''){ ?>
            <div class="<?php echo $class; ?> entry-thumbnail">
                <?php echo $thumb; ?>
            </div>
            <?php } ?>
            
            <div class="<?php echo $class; ?> entry-dynamic-ct">
            
                <h2 class="entry-title">
                    <a  title="<?php printf( esc_attr__( 'Permalink to %s', 'smooththemes' ), the_title_attribute( 'echo=0' ) ); ?>"  rel="bookmark" href="<?php echo $link; ?>"><?php the_title(); ?></a>
                </h2>
                
                <div class="entry-excerpt">
                    <?php the_excerpt(); ?>
                </div>
                <div class="entry-more">
                    <a href="<?php echo $link; ?>" class="btn btn-default"><?php _e('Read more','smooththemes'); ?></a>
                </div>
            </div>
        </div>
    <?php }else{ ?>
        <div class="entry-excerpt">
            <?php the_excerpt(); ?>
        </div>
        <div class="entry-more">
            <a href="<?php echo $link; ?>" class="btn btn-default"><?php _e('Read more','smooththemes'); ?></a>
        </div>
    <?php } ?>
</article>