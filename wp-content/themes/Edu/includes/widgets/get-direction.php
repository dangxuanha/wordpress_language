<?php
/**
 * @author Kien T. - http://www.smooththemes.com
 * @copyright 2012
 */
class STWidgetGetDirection extends WP_Widget {
      
         function __construct() {
          
            parent::__construct(
    	 		  'stwidgetgetdirection', // Base ID
    			__('ST Get Direction','smooththemes'), // Name
    			array( 'description' => __( 'A widget get direction', 'smooththemes' ), ) // Args
	       	   );
            
         }
          
         function widget($args, $instance) {
            // prints the widget
            extract($args);
            echo $before_widget;
            if ( ! empty( $title ) )
    			echo $before_title . $title . $after_title;
            echo ($instance['desc'] != '') ? '<p>'. $instance['desc'] .'</p>' : '';
            ?>
            <form class="" action="http://maps.google.com/maps" method="get" target="_blank">
                <div class="form-group">
                    <input type="text" name="saddr"  placeholder="<?php _e('Enter your location', 'smooththemes'); ?>" class="form-control" />
                </div>
                <div class="form-group">
                    <input type="hidden" name="daddr" value="New York, NY 11430" /> <!-- Write here your end point -->
                    <input type="submit" value="<?php _e('Get directions', 'smooththemes'); ?>" class="btn btn-default" />
                </div>                    
            </form>
            <?php
            echo $after_widget;
         }
          
         function update($new_instance, $old_instance) {
            //save the widget
            $instance = array();
    		$instance['title'] = strip_tags( $new_instance['title'] );
            $instance['desc'] = $new_instance[ 'desc' ];
    		return $instance;
         }
          
         function form($instance) {
            //widgetform in backend
            ?>
            <p>
    		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','smooththemes'); ?></label> 
    		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
    		</p>
            <p>
    		<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e( 'Description:','smooththemes'); ?></label> 
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>"><?php echo $instance['desc']; ?></textarea>
    		</p>
         <?php   
         }
     }

function register_STWidgetGetDirection() {
    if(current_theme_supports('st-widgets')){
        register_widget( 'STWidgetGetDirection' );
    }
}
add_action( 'widgets_init', 'register_STWidgetGetDirection' );

