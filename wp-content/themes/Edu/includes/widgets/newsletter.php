<?php
/*******************************************/
class STNewsletter extends WP_Widget {
    /** constructor -- name this the same as the class above */
   
    
    public function __construct() {
		// widget actual processes
         $this->cacheFileName = dirname(__FILE__)."/STNewsletter_cache.txt";
        parent::__construct('STNewsletter',__('ST Newsletter'),  array('description' => __('Newsletter Widget','smooththemes')));
       
	}
    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $feedburner_id = $instance['feedburner_id'];
       // $cacheFileName = $this->cacheFileName;
		
		$mailchimp =  esc_attr($instance['mailchimp']);
		
		$formtype = $instance['formtype'];
       
        if(trim($title)==''){
            $title = sprintf(__('Keep Update With %s',get_bloginfo('name')),'smooththemes');
        }
		
		
		 $email_txt = __('Your Email','smooththemes');
        
        echo $before_widget;
         ?>
        <div class="connect-widget-wrapper">
                <?php echo  $before_title . esc_html($title) . $after_title; ?>
                <div class="connect-widget-form">
                    <p><?php  echo esc_html($instance['text']); ?></p>
                    
                    
                   <?php if($formtype!='m'){ ?> 
                    
                    <form  class="form-inline form-search" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="_blank" >
                    <div class="form-group">
                        <input type="text" class="form-control subs_input" name="email" placeholder="<?php echo $email_txt; ?>" value="" />
                    </div>
                    <input type="hidden" value="<?php echo esc_attr($feedburner_id); ?>" name="uri"/>
                    <input type="hidden" name="loc" value="en_US"/>
                    <input class="btn btn-default" type="submit" value="<?php _e('Subscribe','smooththemes'); ?>" class="subs_submit"/>
                  
                   </form>
                   <?php } else { ?>
                   
                   <form id="subscribe_form" action="<?php echo esc_url($mailchimp); ?>" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="form-inline" target="_blank" novalidate>
					 <?php
                      $email_txt = __('Your Email Address...','smooththemes');
                      $email_holder = json_encode($email_txt); 
                     ?>
					 <div class="form-group">
                        <input type="text" value="" name="EMAIL" class="form-control subs_input" id="mce-EMAIL" placeholder="<?php  echo $email_txt; ?>" required="true" />
                     </div>
					 <input type="submit" name="subscribe" value="<?php _e('Subscribe','smooththemes'); ?>" class="btn btn-default subs_submit" />
				 </form>
				 <?php }  ?>
                </div>
            </div>
        <?php
        
        echo $after_widget; 
        
    }
    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {
        @unlink($this->cacheFileName);
		$instance['title'] = strip_tags($new_instance['title']);
        $instance['feedburner_id'] = strip_tags($new_instance['feedburner_id']);
        $instance['text'] = $new_instance['text'];
		$instance['mailchimp'] =  $new_instance['mailchimp'];
		$instance['formtype']  = $new_instance['formtype'];
        return $instance;
    }
    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {
        $title 		 = esc_attr($instance['title']);
        $feedburner_id = esc_attr($instance['feedburner_id']);
        $custom_txt = esc_attr($instance['text']);
		$mailchimp =  esc_attr($instance['mailchimp']);
		
		$formtype = $instance['formtype'];
		
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','smooththemes'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <hr/>
         <p>
          <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text:' ,'smooththemes'); ?></label><br />
          <textarea rows="7" class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" ><?php echo $custom_txt; ?></textarea>
            <br /><span class="description"><?php _e('Example: <strong>smooththemes</strong>','smooththemes'); ?></span>
        </p>
        <hr/>
        <p>
          <label for="<?php echo $this->get_field_id('formtype'); ?>"><?php _e('Form type:' ,'smooththemes'); ?></label><br />
          <label>
          	<input type="radio"  id="<?php echo $this->get_field_id('formtype'); ?>" name="<?php echo $this->get_field_name('formtype'); ?>" <?php  echo ($formtype=='' ||  $formtype!='m') ? ' checked="checked" ' : ''; ?> value="f" />
          	<?php  _e('Feedburner','smooththemes'); ?>
          </label>
          <br/>
          <label>
          	<input type="radio"  id="<?php echo $this->get_field_id('formtype'); ?>" name="<?php echo $this->get_field_name('formtype'); ?>" <?php  echo ($formtype=='m') ? ' checked="checked" ' : ''; ?>  value="m" />
          	<?php  _e('Mailchimp','smooththemes'); ?>
          </label>
        </p>
        <p>

          <label for="<?php echo $this->get_field_id('feedburner_id'); ?>"><?php _e('Feedburner URLI:' ,'smooththemes'); ?></label>

          <input class="widefat" id="<?php echo $this->get_field_id('feedburner_id'); ?>" name="<?php echo $this->get_field_name('feedburner_id'); ?>" type="text" value="<?php echo $feedburner_id; ?>" />
            <br /><span class="description"><?php _e('Example: <strong>smooththemes</strong>','smooththemes'); ?></span>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('mailchimp'); ?>"><?php _e('Mailchimp Action:' ,'smooththemes'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('mailchimp'); ?>" name="<?php echo $this->get_field_name('mailchimp'); ?>" type="text" value="<?php echo $mailchimp; ?>" />
            <br /><span class="description"><?php _e('Example: <strong>smooththemes</strong>','smooththemes'); ?></span>
        </p>
        <p>
        </p>
        Example: <strong>http://smooththemes.us7.list-manage.com/subscribe/post?u=dc130fe66084d082c54779086&amp;id=736887358d</strong> 
        <br/> You can get Mailchimp form action follow steps  <a href="<?php echo ST_ADMIN_URL; ?>/images/mailchimp-form.png" target="_blank">Here</a>
       </p>
        <?php
    }
} // end class example_widget
register_widget( 'STNewsletter' );

