	<footer class="footer-outer-wrapper footer">
        <?php if(st_get_setting('show_footer_widget','y')!='n'){ ?>
		<div class="footer-wrapper container">
			
			<div class="sidebar footer-sidebar clearfix row">
				<?php
                // footer widget
                $footer_layout = st_get_setting('footer_layout',3); //3 column 12/3 = 4 :)
                $numcol =4;
                if(strpos($footer_layout,'-')===false){
                    $footer_layout =  intval($footer_layout) ;
                    $numcol = 12 / (intval($footer_layout) !=0 ? intval($footer_layout) : 3 );
                    for($i=0; $i<$numcol; $i++){
                        $classes = array();
                        $classes[] ='col-lg-'.$footer_layout;
                        $classes[] ='col-sm-'.$footer_layout;
                        $classes[] ='col-md-'.$footer_layout;
                        $classes[] ='widget-'.($i+1);
                        $classes[] = 'footer-widget';
                        if($i==0){
                            $classes[] ='first';
                        }
                        if($i==$numcol-1){
                            $classes[] ='last';
                        }
                        ?>
                        <div class="<?php echo join(' ',$classes); ?> footer-widget">
                        <?php dynamic_sidebar('footer_'.($i+1)); ?>
                        </div>
                        <?php
                    }
                }else{
                    $footer_layout = explode('-',$footer_layout);
                    $numcol = count($footer_layout);
                    for($i=0; $i<$numcol; $i++){
                        $classes = array();
                        $classes[] ='col-lg-'.$footer_layout[$i];
                        $classes[] ='col-sm-'.$footer_layout[$i];
                        $classes[] ='col-md-'.$footer_layout[$i];
                        $classes[] ='widget-'.($i+1);
                        $classes[] = 'footer-widget';
                        if($i==0){
                            $classes[] ='first';
                        }
                        if($i==$numcol-1){
                            $classes[] ='last';
                        }
                        ?>
                        <div class="<?php echo join(' ',$classes); ?>">
                            <?php dynamic_sidebar('footer_'.($i+1)); ?>
                        </div>
                    <?php
                    }
                }
                ?>
			 </div>
		</div> <!--// #END footer-wrapper //-->
        <?php }// end if show footer widget ?>
	</footer> <!--// #END footer-outer-wrapper //-->
    
    <div id="toTop"><?php _e('Back to Top', 'smooththemes'); ?></div>
</div> 
<!--// #END page-outer-wrapper //-->
<?php wp_footer(); ?>
</body>
</html>