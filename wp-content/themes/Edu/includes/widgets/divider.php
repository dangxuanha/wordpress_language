<?php
/**
 * @author Kien T. - http://www.smooththemes.com
 * @copyright 2012
 */
class STWidgetDivider extends WP_Widget {
    
       public static $NUM_ADS = 8;
      
         function __construct() {
          
            parent::__construct(
    	 		  'stwidgetdivider', // Base ID
    			__('ST Divider','smooththemes'), // Name
    			array( 'description' => __( 'A widget divider', 'smooththemes' ), ) // Args
	       	   );
            
         }
          
         function widget($args, $instance) {
            // prints the widget
            extract($args);
            
            echo '<hr>';
         }
          
         function update($new_instance, $old_instance) {
            //save the widget
            $instance = $old_instance;
            
            return $instance;
         }
          
         function form($instance) {
            //widgetform in backend
            ?>
            
    
            
         <?php   
         }
     }
     
    
register_widget( 'STWidgetDivider' );
