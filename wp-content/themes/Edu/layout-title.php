<?php
/*
The page title for all page: single, post, category, tag,..
*/
$title=  st_layout_title();
if($title!=''){
    ?>
    <div class="layout-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 column col-sm-12 col-md-12 clearfix">
                    <h1 class="page-title"><?php echo $title; ?></h1>
                </div>
                <div class="col-lg-12 column col-sm-12 col-md-12 clearfix">
                    <?php
                    $is_breadcrumb = false;
    
                    if(st_is_woocommerce()){
                        if(is_woocommerce()){
                            $is_breadcrumb = true;
                            echo '<div class="st-breadcrumb">';
                            woocommerce_breadcrumb();
                            echo '</div>';
                        }
                    }
    
    
                    if(!$is_breadcrumb && function_exists('bcn_display'))
                    {
                        echo '<div class="st-breadcrumb">';
                        bcn_display();
                        echo '</div>';
                    }
    
                    ?>
                </div>
            </div>            
        </div>
    </div>
    <?php
}
else {
    echo '<div class="no-title"></div>';
}
