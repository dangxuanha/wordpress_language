<form role="search" method="get" class="form-group" action="<?php echo home_url( '/' ); ?>">
	<div class="row">
		<div class="col-xs-12 col-md-8">
			<input class="form-control" type="text" value="<?php _e('Business Name...', 'directory' ); ?>" name="s" id="s" onfocus="if(this.value==this.defaultValue){this.value='';}" onblur="if(this.value==''){this.value=this.defaultValue;}">
		</div>
		<div class="col-xs-6 col-md-4">
			<button type="submit" class="btn btn-default"><?php _e('Search', 'directory' ); ?></button>
		</div>
	</div>
    
    
</form>
