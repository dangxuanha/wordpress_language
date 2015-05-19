jQuery(document).ready(function($) {

    // show st cart
    $('.st-cart-icon').each(function(){
        var icon = $(this);

        icon.find('.cart-icon').click(function(){

            if(icon.hasClass('opened')){
                icon.removeClass('opened');
            }else{
                icon.addClass('opened');
            }
            return false;
        });

        jQuery(document).click(function(e) {
            if (icon.has(e.target).length === 0) {
                icon.removeClass('opened');
            }
        });
    });

    // update st cart
    $fragment_refresh = {
        url: woocommerce_params.ajax_url,
        type: 'POST',
        data: { action: 'woocommerce_get_refreshed_fragments' },
        success: function( data ) {

            if ( data && data.fragments ) {
                $('.st-cart-icon .cart-content').html(data.fragments['div.widget_shopping_cart_content']);
                $('body').trigger({ type: 'st-cart-change',  data: data } );
                var number =  $('.st-cart-icon .cart-content .number-item').attr('data-number')||0;
                number = parseInt(number);
                if(isNaN(number) ||  number<=0){
                    $('.st-cart-icon .cart-icon .number').text(number).hide();
                }else{
                    $('.st-cart-icon .cart-icon .number').text(number).show();
                }
                jQuery('.main-nav-outer-wrapper .woocommerce-cart').css( { 'visible' : 'hidden'}).addClass('animated BottomToTop').removeClass('hide').css( { 'visible' : 'visible'});
            }
        }
    };

    $.ajax( $fragment_refresh );

    $('body').bind( 'added_to_cart', function( event, fragments, cart_hash ) {
        $.ajax( $fragment_refresh );
    });

});





