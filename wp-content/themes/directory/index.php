	<?php get_header(); ?>
	<div id="kt-main">
	<div class="container">
		<div class="row">
		  <div class="col-md-8">
			<div class="row">
			  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				   <div class="col-md-6">
				   <?php $i = 0; if (have_posts()) : while(have_posts()) : $i++; if(($i % 2) == 0) : $wp_query->next_post(); else : the_post(); ?>
				   <div class="kt-article">
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
					<?php if(has_post_thumbnail()) { ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail();  ?></a>
					<?php } ?>
					
					<?php the_excerpt(); ?>
					<div class="clearfix"></div>
					
				  </div>
				  <?php endif; endwhile; else: ?>
				  <p class="kt-white"><?php _e('Sorry, no posts matched your criteria.', 'directory'); ?></p>
				  <?php endif; ?>
				  <?php $i = 0; rewind_posts(); ?>
				  </div>
			  </div>
			  
			   <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				   <div class="col-md-6">
				   <?php $i = 0; if (have_posts()) : while(have_posts()) : $i++; if(($i % 2) !== 0) : $wp_query->next_post(); else : the_post(); ?>
				   <div class="kt-article">
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
					<?php if(has_post_thumbnail()) { ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail();  ?></a>
					<?php } ?>		
					<?php the_excerpt(); ?>
					<div class="clearfix"></div>
					
				  </div>
				  <?php endif; endwhile; else: ?>
					<p class="kt-white"><?php //_e('Sorry, no posts matched your criteria.', 'directory'); ?></p>
					<?php endif; ?>
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