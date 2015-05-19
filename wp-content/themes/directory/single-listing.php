	<?php get_header(); ?>
	<div id="kt-main">
	<div class="container">
		<div class="row">
		  <div class="col-md-8">
			<div class="row">
			  <?php while ( have_posts() ) : the_post(); ?>
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
			   <div class="kt-listing">
				<h1><?php 
						$thetitle = get_the_title($post->ID);
						$origpostdate = get_the_date('M d, Y', $post->post_parent);
						$origposttime = get_the_time('M d, Y', $post->post_parent);
						$dateline = $origpostdate.' '.$origposttime;
						//var_dump($thetitle);
						if($thetitle==null){echo $dateline;}else{
						the_title();                     
						}
					?></h1>
				
					<p><span class="glyphicon glyphicon-map-marker kt-info-paragraph"></span>
                    <?php echo get_post_meta($post->ID,'_listing_address',true); ?>,
                    <?php echo get_post_meta($post->ID,'_listing_number',true);?>,
                    <?php echo get_post_meta($post->ID,'_listing_country',true);?>, 
                    <?php echo get_post_meta($post->ID,'_listing_zip',true);?>
                     <span class="glyphicon glyphicon-phone-alt kt-info-paragraph"></span> <?php echo get_post_meta($post->ID,'_listing_phone',true); ?></p>
					<p><span class="glyphicon glyphicon-th-list kt-info-paragraph"></span> 
                    <?php ketchupthemes_get_the_listing_categories($post->ID);?>
                    <span class="glyphicon glyphicon-tags kt-info-paragraph"></span> <?php ketchupthemes_get_the_listing_tags($post->ID); ?></p>
					
					
					
				</div>
				
			  
			  </div>
              <div class="col-md-12 kt-listing">
              <?php the_content(); ?>
              </div>
			</div>
            <?php endwhile; ?>
		  </div>
		  <?php get_sidebar(); ?>
		</div>
	</div>
	</div>
	<?php get_footer(); ?>   