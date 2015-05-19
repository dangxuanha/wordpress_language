	<?php get_header(); ?>
	<div id="kt-main">
	<div class="container">
		<div class="row">
		  <div class="col-md-8">
			<div class="row">
			  <div class="col-md-12">
			  
			  <?php while ( have_posts() ) : the_post(); ?>
			  <div class="kt-article">
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
					
					<div class="ktDivider"></div>
					<p class="kt-inner-credentials"><?php the_author(); ?>, 
					<?php the_time(get_option('date_format')); ?></p>
					<?php the_content(); ?>
					
					<div id="kt-categories"><div class="glyphicon glyphicon-th-list" id="kt-categories-icon" ></div><?php echo get_the_category_list( _e(',', ' ', 'directory' )); ?></div>
                    
					<p> <?php if(has_tag()){?>
                    <span class="glyphicon glyphicon-tags"></span>
                    <?php }?>
                    <span id="kt-tags"><?php the_tags('', ', ', '<br />'); ?></span></p>
					<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'directory' ) . '</span>', 'after' => '</div>' ) ); ?>
					<div class="ktDivider clearfix"></div>
					<?php comments_template( '', true ); ?>
				</div>
				<?php endwhile; ?>
			  
			  </div>
			</div>
		  </div>
		  <?php get_sidebar(); ?>
		</div>
	</div>
	</div>
	<?php get_footer(); ?>   