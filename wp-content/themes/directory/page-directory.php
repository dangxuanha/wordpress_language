	<?php
	/*
	Template Name: Directory
	*/
	?>
	<?php get_header(); ?>
	<div id="kt-main">
	<div class="container">
			<div class="row">
			<div class="col-md-12">
			   <div class="row">
				  <div class="col-md-5 kt-top-widgets">
					<?php if ( ! dynamic_sidebar( 'directory_top_left' ) ) : ?>
					<div class="pre-widget">
						<h3><?php _e('Widgetized Home Top Left', 'directory'); ?></h3>
						<p><?php _e('This panel is active and ready for you to add some widgets via the WP Admin', 'directory'); ?></p>
					</div>
					<?php endif; ?>
				  </div>
				  <div class="col-md-1"></div>
				  <div class="col-md-6 kt-top-widgets">
					<?php if ( ! dynamic_sidebar( 'directory_top_right' ) ) : ?>
					<div class="pre-widget">
						<h3><?php _e('Widgetized Home Top right', 'directory'); ?></h3>
						<p><?php _e('This panel is active and ready for you to add some widgets via the WP Admin', 'directory'); ?></p>
					</div>
					<?php endif; ?>
				  </div>
			  </div>
			  <div class="row">
				  <div class="col-md-12">
					<div id="kt-main-cat-title"><p><span>Categories</span></p></div>
				  </div>
			  </div>
			  <div class="row">
				  <div class="col-md-3">
					<?php if ( ! dynamic_sidebar( 'directory1' ) ) : ?>
					<div class="pre-widget">
						<h3><?php _e('Widgetized Home 1', 'directory'); ?></h3>
						<p><?php _e('This panel is active and ready for you to add some widgets via the WP Admin', 'directory'); ?></p>
					</div>
					<?php endif; ?>
				  </div>
				  <div class="col-md-3">
					<?php if ( ! dynamic_sidebar( 'directory2' ) ) : ?>
					<div class="pre-widget">
						<h3><?php _e('Widgetized Home 2', 'directory'); ?></h3>
						<p><?php _e('This panel is active and ready for you to add some widgets via the WP Admin', 'directory'); ?></p>
					</div>
					<?php endif; ?>
				  </div>
				  <div class="col-md-3">
					<?php if ( ! dynamic_sidebar( 'directory3' ) ) : ?>
					<div class="pre-widget">
						<h3><?php _e('Widgetized Home 3', 'directory'); ?></h3>
						<p><?php _e('This panel is active and ready for you to add some widgets via the WP Admin', 'directory'); ?></p>
					</div>
					<?php endif; ?>
				  </div>
				   <div class="col-md-3">
					<?php if ( ! dynamic_sidebar( 'directory4' ) ) : ?>
					<div class="pre-widget">
						<h3><?php _e('Widgetized Home 4', 'directory'); ?></h3>
						<p><?php _e('This panel is active and ready for you to add some widgets via the WP Admin', 'directory'); ?></p>
					</div>
					<?php endif; ?>
				  </div>
			  </div>
			  
			</div>
		  </div>
	</div>
	<?php get_footer(); ?>   