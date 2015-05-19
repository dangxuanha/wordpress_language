var dd = ddsmoothmenu|| false;

(function(jQuery) {
    "use strict";
    

    var check = true;

    jQuery.fn.stTheme = function(options) {
        var that = this;
        return this.each(function() {

            init(jQuery(this) );

        } );

        function init($contex) {
            // your code here
            
            // only load 
            if (check) {
                ddsmoothmenu($contex);
                check = false;    
            }
            
            backToTop($contex);
            //callFancybox($contex);
            lightBoxMedia($contex);
            
            addClassToButton($contex);
            
            addDatePicker($contex);
        }

        
        function ddsmoothmenu($contex) {
            if (typeof(window.stMegamenuSettings) != 'undefined') {
                return false;    
            }
            
            if(!dd){
                return ;
            }

            //ddsmoothmenu for primary navigation
        	var callNavMenu = function(){
                dd.init({
                    mainmenuid: "primary-nav-id", //menu DIV id
                    orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
                    classname: 'primary-nav slideMenu', //class added to menu's outer DIV
                    contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
                });
            };

            callNavMenu();

            jQuery(window).resize(function(){
                callNavMenu();
            });

            // ST Primary Navigation for mobile.
        	var primary_nav_mobile_button = jQuery('#primary-nav-mobile', $contex);
        	var primary_nav_cloned;
        	var primary_nav = jQuery('#primary-nav-id > ul', $contex);
        	primary_nav.clone().attr('id','primary-nav-mobile-id').removeClass().appendTo( primary_nav_mobile_button );
        	primary_nav_cloned = primary_nav_mobile_button.find('> ul');

    		jQuery('#primary-nav-mobile-a').click(function(){
    			if(jQuery(this).hasClass('primary-nav-close')){
    				jQuery(this).removeClass('primary-nav-close').addClass('primary-nav-opened');
    				primary_nav_cloned.slideDown( 400 );
                    return false;
    			} else {
    				jQuery(this).removeClass('primary-nav-opened').addClass('primary-nav-close');
    				primary_nav_cloned.slideUp( 400 );
                    return false;
    			}
    			return false;
    		});
    		primary_nav_mobile_button.find('a').click(function(event){
    			event.stopPropagation();
    		});



            /* for topbar  nav */

            var  createMobileMenu =  function(obj, appendToObj, iconTitle){
                var m = obj.clone();
                m.removeAttr('id');
                m.addClass('mobile-menu-list');
                m.removeClass('menu');
                m.hide();

                if(typeof(iconTitle)!='string' || iconTitle ==''){
                    iconTitle ='';
                }else{
                    iconTitle ='<span>'+iconTitle+'</span>';
                }

                m.appendTo(appendToObj);
                var  p = jQuery('<div class="mobile-menu" />');
                var icon =   jQuery('<a href="#" class="mobile-menu-icon closed" ><i class="iconentypo-down-open-big"></i>'+iconTitle+'</a>');
                m= m.wrap(p);
                icon.insertBefore(m);

                icon.on('click',function(){

                    if(icon.hasClass('closed')){
                        icon.removeClass('closed').addClass('opened');
                        m.slideDown( 400 );
                        return false;
                    } else {
                        icon.removeClass('opened').addClass('closed');
                        m.slideUp( 400 );
                        return false;
                    }

                    return false;
                });

            };


            jQuery('.topbar .widget_nav_menu .menu').each(function(){
                var m = jQuery(this);
                var  gp = m.parents('.widget_nav_menu');
                var  p = m.parent();
                var id = p.attr('id') ||  undefined;
                if(typeof (id) ==='undefined' ||  id ==''){
                    id = 'mid-'+(new Date().getTime());
                    p.attr('id',id);
                }

                var title =  jQuery('.widget-title',gp).text();

                createMobileMenu(m,gp,title);

                m.addClass('nav-menu');
                gp.addClass('main-nav-outer-wrapper');
               // gp.addClass('primary-nav slideMenu');
                m.show();

                dd.init({
                    mainmenuid: id, //menu DIV id
                    orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
                    classname: 'primary-nav slideMenu', //class added to menu's outer DIV
                    contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
                });

                jQuery(window).resize(function(){
                    dd.init({
                        mainmenuid: id, //menu DIV id
                        orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
                        classname: 'primary-nav slideMenu', //class added to menu's outer DIV
                        contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
                    });
                });

            });




        }
        
        function backToTop($contex) {
            // SCROLL TO TOP ===============================================================================
        	jQuery(window).scroll(function() {
        		if(jQuery(this).scrollTop() != 0) {
        			jQuery('#toTop').fadeIn();	
        		} else {
        			jQuery('#toTop').fadeOut();
        		}
        	});
         
        	jQuery('#toTop', $contex).click(function() {
        		jQuery('body,html').animate({scrollTop:0},500);
        	});	
        }
        
        function callFancybox($contex) {
            /*
			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
			*/
            jQuery('.fancybox-media', $contex)
            .attr('rel', 'media-gallery')
            .fancybox({
            	openEffect : 'none',
            	closeEffect : 'none',
            	prevEffect : 'none',
            	nextEffect : 'none',
            
            	arrows : false,
            	helpers : {
            		media : {},
            		buttons : {}
            	}
            });
        }
        
        
        function lightBoxMedia($contex) {
            if (typeof(magnificPopup) != undefined) {
                jQuery('.magnific-media', $contex).magnificPopup({
                    type: 'iframe',
                    zoom: {
                        enabled: true, // By default it's false, so don't forget to enable it
                        duration: 300, // duration of the effect, in milliseconds
                        easing: 'ease-in-out' // CSS transition easing function
                    }
                });
                jQuery('.zoom-image-product', $contex).magnificPopup({
                    type: 'image',
                    zoom: {
                        enabled: true, // By default it's false, so don't forget to enable it
                        duration: 300, // duration of the effect, in milliseconds
                        easing: 'ease-in-out' // CSS transition easing function
                    },
                    gallery: {
                        enabled: true,
                        navigateByImgClick: true,
                        preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                    }
                });    
            }
        }
        
        
        function addClassToButton($contex) {
            jQuery('a.button,input.button,button.button,input[type="submit"]', $contex).addClass('btn btn-default').attr('disable','disable');
            jQuery('input[type="password"]', $contex).addClass('form-control');
        }
        
        
        function addDatePicker($contex) {
            jQuery('input[type="date"]', $contex).datepicker({
                dateFormat : 'yy-mm-dd'
            }).attr('type', 'text');
        }

    }

})(jQuery);

jQuery(document).ready(function() {
    jQuery('body').stTheme();
});

