(function(jQuery) {
    "use strict";

    jQuery.fn.stElements = function(options) {
        var that = this;
        return this.each(function() {

            init(jQuery(this) );

        } );

        function init($contex) {
            // your code here
//            video($contex);
//            lightbox_gallery($contex);
//            carousel($contex);
//            alertHide($contex);

        }

        function alertHide($contex){
            jQuery('.builder-item .alert, .stpb-notification .alert', $contex).on('closed.bs.alert', function () {
                var p = jQuery(this).parents('.builder-item') ||  jQuery(this).parents('.stpb-notification');
                console.debug(p);
                p.remove();
            });
        }

        function video($contex) {
            jQuery('.st-video', $contex).fitVids();
        }


        function lightbox_gallery($contex) {
            jQuery('.st-gallery .st-gallery-item a.image-lightbox', $contex).magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true, // set to true to enable gallery
                },
                zoom: {
                    enabled: true, // By default it's false, so don't forget to enable it
                    duration: 300, // duration of the effect, in milliseconds
                    easing: 'ease-in-out' // CSS transition easing function
                }
            });
        }
        // st-carousel

        function carousel($contex) {
            jQuery('.st-carousel-w .st-carousel', $contex).each(function() {
                var  sl =  jQuery(this);
                var  p = sl.parents('.st-carousel-w');
                if(typeof(sl) !== 'undefined'){
                    jQuery(sl).carouFredSel({
                        items: 3,
                        width: 'auto',
                        //height: 'auto',
                        auto: false,
                        responsive: true,
                        scroll: 3,
                        align: 'left',
                        next : jQuery('.next',p),
                        prev : jQuery('.prev',p),
                        pagination  : jQuery('.pagination',p),
                        swipe: true
                    });
                    /*
                    sl.touchwipe({
                        wipeLeft: function() {
                            sl.trigger('next', 1);
                        },
                        wipeRight: function() {
                            sl.trigger('prev', 1);
                        }
                    });
                    */
                }
            });
        }



    }

})(jQuery);

jQuery(document).ready(function() {
    jQuery('body').stElements();
});
