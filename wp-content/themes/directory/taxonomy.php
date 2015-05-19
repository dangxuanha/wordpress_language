	<?php get_header(); ?>
	<div id="kt-main">
	<div class="container">
		<div class="row">
		  <div class="col-md-8">
			<div class="row">
			  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				   <div class="col-md-12">
				   <?php 
                   $tax = get_query_var('term');
                   echo $tax;
                   $args = array( 'post_type' => 'listing', 
                   'posts_per_page' => 10,
                   'listing-category'=>$tax ); 
                   $loop = new WP_Query( $args ); 
                   while ( $loop->have_posts() ) : $loop->the_post(); ?>
				   <div class="kt-listing">
					<div class="row">
					   <?php if(has_post_thumbnail()) { ?>
					   <div class="col-md-3">
					   <div class="ktImage">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail();  ?></a>
					   </div>
					   </div>
					   <div class="col-md-9">
					   <?php } else { ?>
					   <div class="col-md-12">
					   <?php } ?>
						<h1><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php 
						$thetitle = get_the_title($post->ID);
						$origpostdate = get_the_date('M d, Y', $post->post_parent);
						$origposttime = get_the_time('M d, Y', $post->post_parent);
						$dateline = $origpostdate.' '.$origposttime;
						//var_dump($thetitle);
						if($thetitle==null){echo $dateline;}else{
						the_title();                     
						}
						?></a></h1>
						<p class="kt-info-paragraph"><span class="glyphicon glyphicon-map-marker"></span>
                         <?php echo get_post_meta($post->ID,'_listing_address',true);?>
                          <?php echo get_post_meta($post->ID,'_listing_number',true);?>,
                          <?php echo get_post_meta($post->ID,'_listing_country',true);?>, 
                          <?php echo get_post_meta($post->ID,'_listing_zip',true);?>
                         <span class="glyphicon glyphicon-phone-alt"></span> 
                         <?php echo get_post_meta($post->ID,'_listing_phone',true); ?></p>
                         <p><span class="glyphicon glyphicon-th-list kt-info-paragraph"></span> 
                         <?php ketchupthemes_get_the_listing_categories($post->ID);?>
                         <span class="glyphicon glyphicon-tags kt-info-paragraph"></span> <?php ketchupthemes_get_the_listing_tags($post->ID); ?></p>
						</div>
						
					<div class="clearfix"></div>
					
					</div>
				  </div>
				 <?php endwhile; wp_reset_query();?>
				  </div>
			  </div>
			</div>
			
			<div class="clearfix"></div>
			
			<div id="kt-pagination">
				<div class="alignleft"><?php previous_posts_link(__( '&laquo; Newer posts', 'directory' )) ?></div>
				<div class="alignright"><?php next_posts_link(__( 'Older posts &raquo;', 'directory' )) ?></div>
			</div>
		  </div>
		  <?php get_sidebar(); ?>
		</div>
	</div>
	</div>
	<?php get_footer(); ?>   