(function($){
    "use strict";
    $.fn.stBuildMegaMenu = function(options) { 
        var megaMenu = $('#megaMenu'); 
        var navDd = $('#megaMenu #megaST .nav-dd');
        var navLi = navDd.parent();
        var linkNav = $('a.link-depth-0', navLi);
        var marginNavLi = 0;
        var megaMenuWidth = megaMenu.outerWidth();
        var totalItemNav = 0;
        navDd.each(function () {
            totalItemNav += $(this).parent().outerWidth();
        });
        navDd.css({'visibility' : 'hidden', 'display': 'block'});
        var stMegamenuType = (typeof(options.type)!=='undefined') ? options.type : 'hover';
        var stMegamenuEffect = (typeof(options.effect)!=='undefined') ? options.effect : 'slide';
        var stMegamenuSpeed = (typeof(options.speed)!=='undefined') ? options.speed : 200;
        var stMegamenuAlign = (typeof(options.align)!=='undefined') ? options.align : 'no';
        var navWidth = 0;
        
        $('#megaMenu #megaST li.menu-item-depth-0').last().css({'padding':'0'});
        var w_w = jQuery(window).width();
        if (stMegamenuAlign === 'yes' && w_w > 1024) { 
            var h = $(megaMenu, 'ul.megaMenu'),
            k = $('#megaMenu #megaST li.menu-item-depth-0');
            h.css({
                /*'height': '0'*/
            });
            k.each(function(){
                navWidth += $(this).outerWidth();
            });
            var j,
                l = megaMenuWidth - navWidth,
                g = l % (k.length - 1);
                marginNavLi = j = Math.floor(l / (k.length - 1));
            k.each(function(){
                if (g > 0) {
                    $(this).css({
                       //'width': '+=1'
                       'width': 'auto'
                    });
                }
                g--;
            });
            if (j < 0) {j=0;}    
            k.filter(':not(:last)').css('margin-right', j + 'px');
            h.css({
                visibility: "visible",
                overflow: "visible"
            });
           // h.fadeIn();
        }  
        // set margin for menu
        navDd.each(function () {
            var ddWidth     = 0;
            var navDdItem       = $(this);
            var navLi       = navDdItem.parent();
            var linkNav     = $('a.link-depth-0', navLi);
            
            // reset CSS
            navDdItem.attr('style', '');
            //navDd.show();
            if (navDd.hasClass('auto-col')) {
                var navDdCol = 0;
                $('ul.menu-row.sub-menu-0', navDdItem).each(function(){
                    var temp = 0;
                    $('li.col.menu-item-depth-1', $(this)).each(function(){
                       temp += parseInt($(this).attr('col'));
                    });
                    if (temp > navDdCol) { navDdCol = temp; }
                });
                // when use 6 colums : if (navDdCol > 6) { navDdCol = 6; }
                if (navDdCol > 12) { navDdCol = 12; }
                navDdItem.addClass('col'+ navDdCol);
            }
            ddWidth = navDdItem.outerWidth();
            var pgWidth = $('#megaMenu').outerWidth(true); 
            /*
            if (ddWidth > pgWidth) {
                ddWidth = pgWidth;
            }
            */
            //ddWidth = pgWidth;            
            var navPos = navLi.position().left;
            var navLoc = Math.ceil((navPos / pgWidth) * 100); 
            //navWidth = ddWidth + 5;
            navWidth = ddWidth;
            var navLiWidth=navLi.width();
            var subWidth=ddWidth-navLiWidth;
            if((subWidth) < 5){navWidth=navWidth+4;}
            var liWidth = navLi.outerWidth(true);
            var newPos;
            navDdItem.width(navWidth);
            if (navLoc < 50) {
                navDdItem.css({
                    left: "0px"//left: "-1px"
                });
                if (navWidth > (pgWidth - navPos)) {
                    subWidth = navWidth - (pgWidth - navPos);
                    newPos = -subWidth;
                    navDdItem.css({
                        left: newPos,
                        right: 'auto',
                        display:  'block',
                        visibility : 'hidden'
                    });
                    var t = navDdItem.offset().left;
                    if(t<0){
                        while(t<0){
                            t++;
                            newPos++;
                        }
                        newPos+=15;
                    }
                    navDdItem.css({
                        left: newPos,
                        display:  'block',
                        visibility : 'hidden'
                    });
                }
            } else {
                navDdItem.css({
                    right: "0px"//right: "-1px"
                });
                var subPosi = parseInt(navPos + navLi.outerWidth());
                if (0 < (navWidth - subPosi)) {
                    subWidth = navWidth - subPosi;
                    newPos = -subWidth;
                    navDdItem.css({
                        right: newPos,
                        left: 'auto',
                        display:  'block',
                        visibility : 'hidden'
                    });
                    var iw = navDdItem.outerWidth();
                    var iof = navDdItem.offset();
                    var t=  iw+iof.left;
                    // if the menu item over the right window
                    if(t>w_w){
                        while(t>w_w){
                            t--;
                            newPos++;
                        }
                        newPos+=15;
                    }
                    navDdItem.css({
                        right: newPos,
                        display:  'block',
                        visibility : 'hidden'
                    });
                }
            }
            
            // Center Width
            if (navLoc >= 33 && navLoc <= 66) {
                if ((navWidth/pgWidth) >= (2/3) && (navWidth/pgWidth) <= (5/6)) {
                    //var centerWidth = (navWidth - navLi.innerWidth()) / 2 + 15;
                    var centerWidth = (navWidth - navLi.innerWidth()) / 2 + (navLi.innerWidth() - navLi.width()) / 2;
                    navDdItem.css({
                        'left': -centerWidth,
                        'right': 'auto'
                    });
                }
            }
        });
        $( "body" ).trigger({
            type:"st_megaMenu_added",
            menu: megaMenu
        });
        
        switch (stMegamenuType){
            case 'click':
                    //With Megamenu
                    var linkNavParent = $('#megaMenu #megaST .with-megamenu a.link-depth-0'),
                        navDdCurrent;
                    linkNavParent.click(function () {
                            navDdCurrent = $(this).next();
                           // navDd.css({'visibility' : 'hidden', 'display' : 'block'});
                            $('#megaMenu #megaST .no-megamenu ul').hide();
                            $('#megaMenu #megaST .no-megamenu, #megaMenu .no-megamenu li, #megaMenu #megaST .with-megamenu').removeClass('active');
                            navDd.hide();
                            $(this).parent().addClass('active');
                            if (stMegamenuEffect==='slide'){
                                navDdCurrent.css({'visibility' : 'hidden'}).hide().slideDown(stMegamenuSpeed).css({'visibility' : 'visible'});
                            }
                            else {
                                navDdCurrent.css({'visibility' : 'hidden'}).hide().fadeIn(stMegamenuSpeed).css({'visibility' : 'visible'});
                            }
                           $(this).parent().find('iframe').each(function() {
                                var temp = $(this).attr('src');
                                $(this).attr('src', temp).hide().fadeIn('mdeium');;
                            });
                        return false;
                    });
                    
                    /* Megamenu Depth 2 */
                    var ulSubMenu2,
                        subMenuDepth2;
                    $('#megaST .with-megamenu .menu-row .menu-item-depth-2.item-parent > a').click(function(){
                            subMenuDepth2 = $('.with-megamenu .menu-row .menu-item-depth-2.item-parent .sub-menu-2');
                            ulSubMenu2 = $(this).next();
                            $(this).parent().addClass('active');
                            if (stMegamenuEffect==='slide'){
                                ulSubMenu2.hide().slideDown(stMegamenuSpeed);
                            }
                            else {
                                ulSubMenu2.hide().fadeIn(stMegamenuSpeed);    
                            }
                            return false;
                    });
                    
                    //No Megamenu
                    var linkNavNoMega = $('#megaMenu #megaST .no-megamenu a.link-depth-0'),
                        uLCurrent;
                    linkNavNoMega.click(function () {
                            uLCurrent = $(this).next();
                            $('#megaMenu #megaST .no-megamenu ul').hide();
                            $('#megaMenu #megaST .no-megamenu, #megaMenu #megaST .no-megamenu li, #megaMenu #megaST .with-megamenu').removeClass('active');
                            navDd.hide();
                            navLi.removeClass('active');
                            $(this).parent().addClass('active');
                            if (stMegamenuEffect==='slide'){
                                uLCurrent.hide().slideDown(stMegamenuSpeed);
                            }
                            else {
                                uLCurrent.hide().fadeIn(stMegamenuSpeed);    
                            }
                            if ($(this).attr('href') === '#') {return false;}
                            else {return true;}
                    });
                    
                    var ulChild,
                        noMegaMenuUl;
                    $('#megaST .no-megamenu .item-parent > a').click(function(){
                            noMegaMenuUl = $('.no-megamenu ul');
                            ulChild = $(this).next();
                            $(this).parent().addClass('active');
                            if (stMegamenuEffect==='slide'){
                                ulChild.hide().slideDown(stMegamenuSpeed);
                            }
                            else {
                                ulChild.hide().fadeIn(stMegamenuSpeed);    
                            }
                            if ($(this).attr('href') === '#') {return false;}
                            else {return true;}
                    });
                    
                    jQuery(document).click(function(e) {
                        if (typeof(navDdCurrent) !== 'undefined' && navDdCurrent.has(e.target).length === 0) {
                            $('#megaST .with-megamenu').removeClass('active');
                            if (navDdCurrent.parent().hasClass('no-megamenu')) {
                                navDdCurrent.parent().removeClass('active');
                            }
                            if (stMegamenuEffect==='slide'){
                               navDdCurrent.stop(true, true).slideUp('fast');
                            }
                            else {
                               navDdCurrent.stop(true, true).fadeOut('fast');    
                            }
                        }
                        
                        if (typeof(uLCurrent) !== 'undefined' && uLCurrent.has(e.target).length === 0) {
                            uLCurrent.parent().removeClass('active');
                            if (stMegamenuEffect==='slide'){
                               uLCurrent.stop(true, true).slideUp('fast');
                            }
                            else {
                               uLCurrent.stop(true, true).fadeOut('fast');    
                            }
                        }
                        
                        if (typeof(noMegaMenuUl) !== 'undefined' && noMegaMenuUl.has(e.target).length === 0) {
                            $('#megaMenu .no-megamenu ul li').removeClass('active');
                            if (stMegamenuEffect==='slide'){
                                noMegaMenuUl.stop(true, true).slideUp('fast');
                            }
                            else {
                                noMegaMenuUl.stop(true, true).fadeOut('fast');    
                            }
                        }
                        
                        if (typeof(subMenuDepth2) !== 'undefined' && subMenuDepth2.has(e.target).length === 0) {
                            $('#megaMenu .with-megamenu ul.sub-menu-1 li').removeClass('active');
                            if (stMegamenuEffect==='slide'){
                                subMenuDepth2.stop(true, true).slideUp('fast');
                            }
                            else {
                                subMenuDepth2.stop(true, true).fadeOut('fast');    
                            }
                        }
                    });
                return false;
            break;
        
            default :
                //--- This is hover
                var linkNavParent = $('#megaMenu #megaST .with-megamenu'),
                    navDdCurrent = '';
                linkNavParent.mouseenter(function () {
                    $(this).addClass('active');
                    navDdCurrent = $('.nav-dd', $(this));
                    if (stMegamenuEffect==='slide'){
                        navDdCurrent.addClass('nav-active').css({'visibility' : 'visible'}).hide().stop(true, true).slideDown(stMegamenuSpeed).css({'visibility' : 'visible'});
                    }
                    else {
                        navDdCurrent.addClass('nav-active').hide().css({'visibility' : 'visible'}).stop(true, true).fadeIn(stMegamenuSpeed).css({'visibility' : 'visible'});
                    }
                    $(this).find('iframe').each(function() {
                        var temp = $(this).attr('src');
                        $(this).attr('src', temp).hide().fadeIn('mdeium');
                    });
                }).mouseleave(function (b){
                        $(this).removeClass('active');
                        navDdCurrent = $('.nav-dd', $(this));
                        if (stMegamenuEffect==='slide'){
                            navDdCurrent.removeClass('nav-active').slideUp('fast');
                        }
                        else {
                            navDdCurrent.removeClass('nav-active').fadeOut('fast');
                        }
                 });
                /* Megamenu Depth 2 */
                var ulSubMenu2,
                    subMenuDepth2;
                $('#megaMenu #megaST .with-megamenu .menu-row .menu-item-depth-2.item-parent').mouseenter(function(){
                    subMenuDepth2 = $('.with-megamenu .menu-row .menu-item-depth-2.item-parent .sub-menu-2');
                    ulSubMenu2 = $(this).children('ul.menu-row');
                    $(this).parent().addClass('active');
                    if (stMegamenuEffect==='slide'){
                        ulSubMenu2.hide().stop(true, true).slideDown(stMegamenuSpeed);
                    }
                    else {
                        ulSubMenu2.hide().stop(true, true).fadeIn(stMegamenuSpeed);
                    }
                    if ($(this).attr('href') === '#') {return false;}
                    else {return true;}
                }).mouseleave(function (b) {
                        ulSubMenu2 = $(this).children('ul.menu-row');
                        if (stMegamenuEffect==='slide'){
                            ulSubMenu2.slideUp('fast');
                        }
                        else {
                            ulSubMenu2.fadeOut('fast');
                        }
                    });
                //No Megamenu
                var linkNavNoMega = $('#megaMenu #megaST .no-megamenu'),
                    uLCurrent;
                linkNavNoMega.mouseenter(function () {
                    uLCurrent = $('ul.sub-menu-0', $(this));
                    $('#megaMenu .no-megamenu ul').hide();
                    $('#megaMenu .no-megamenu, #megaMenu .no-megamenu li').removeClass('active');
                    $(this).parent().addClass('active');
                    if (stMegamenuEffect==='slide'){
                        uLCurrent.hide().stop(true, true).slideDown(stMegamenuSpeed);
                    }
                    else {
                        uLCurrent.hide().stop(true, true).fadeIn(stMegamenuSpeed);
                    }
                }).mouseleave(function (b) {
                        uLCurrent = $('ul.sub-menu-0', $(this));
                        if (stMegamenuEffect==='slide'){
                            uLCurrent.stop(true, true).slideUp('fast');
                        }
                        else {
                            uLCurrent.stop(true, true).fadeOut('fast');
                        }
                    });
                var ulChild,
                    noMegaMenuUl;
                $('#megaMenu #megaST .no-megamenu .item-parent').mouseenter(function(){
                    noMegaMenuUl = $('.no-megamenu ul');
                    ulChild = $(this).children('ul.menu-row');
                    $(this).parent().addClass('active');
                    if (stMegamenuEffect==='slide'){
                        ulChild.hide().stop(true, true).slideDown(stMegamenuSpeed);
                    }
                    else {
                        ulChild.hide().stop(true, true).fadeIn(stMegamenuSpeed);
                    }
                    if ($(this).attr('href') === '#') {return false;}
                    else {return true;}
                }).mouseleave(function (b) {
                        ulChild = $(this).children('ul.menu-row');
                        if (stMegamenuEffect==='slide'){
                            ulChild.stop(true, true).slideUp('fast');
                        }
                        else {
                            ulChild.stop(true, true).fadeOut('fast');
                        }
                    });
                //----
            break;
        }
        //navDd.hide();
    };    
})(jQuery);
jQuery(document).ready(function(){
    "use strict";
    // Copy Menu for Responsive
    var html = jQuery('#megaMenu #megaST').html();
    var textNav = 'Main Navigation';
    // Call settings for Megamenu window.stMegamenuSettings
    if (typeof(window.stMegamenuSettings.textnav) !== 'undefined') {
        textNav = window.stMegamenuSettings.textnav;
    }
    var is_exists_mobile=  false;
    if(jQuery("#menuMobile").length>0){
         jQuery("#menuMobile").addClass('menuResponsive').html(html);
         jQuery('#menuMobile').parent().addClass('megaMenu');
        is_exists_mobile= true;
    }else{
        jQuery('#megaMenu').append('<div class="megaMenuToggle" id="megaMenuToggle">'+textNav+'<span class="megaMenuToggle-icon icon-align-justify"></span></div><ul id="menuMobile" class="menuResponsive">'+html+'</ul>');
        jQuery('#menuMobile [data-toggle="tab"], #menuMobile [data-toggle="collapse"]').each(function() {
            var $this = jQuery(this);
            var href = $this.attr('href');
            var dt_parent = $this.attr('data-parent');
            $this.attr('href', href +'-mobile');
            href = href.replace('#', '');
            $this.parents('#menuMobile').find('#'+ href).attr('id', href +'-mobile');
            if (dt_parent != undefined && (dt_parent != '' || dt_parent != 'false')) {
                $this.attr('data-parent', dt_parent +'-mobile');
                dt_parent = dt_parent.replace('#', '');
                $this.parents('#menuMobile').find('#'+ dt_parent).attr('id', dt_parent +'-mobile');
            }
        });
    }
    jQuery('#megaMenuToggle').click(function(){
        jQuery('#megaMenu #menuMobile').slideToggle();
        jQuery('#megaMenu').find('iframe').each(function() {
            var temp = jQuery(this).attr('src');
            jQuery(this).attr('src', temp);
        });
    });
    jQuery.fn.stBuildMegaMenu(window.stMegamenuSettings);
    jQuery(window).resize(function() {
        jQuery.fn.stBuildMegaMenu(window.stMegamenuSettings);
        var w_w = jQuery(window).width();
        if (w_w>=1007) {
            if(is_exists_mobile){
            }else{
                jQuery('#megaMenuToggle').hide();
                jQuery('#menuMobile').hide();
            }
            jQuery('#megaMenu #megaST').show();
        }
        else {
            jQuery('#megaMenuToggle').show();
            jQuery('#megaMenu #megaST').hide();
        }
    });
    jQuery(window).trigger('resize');
});
