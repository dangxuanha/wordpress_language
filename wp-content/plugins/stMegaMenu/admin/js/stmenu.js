/**
 * This file holds the main javascript functions needed to improve the st mega menu backend
 *
 * @author		Christian "Kriesi" Budschedl
 * @copyright	Copyright ( c ) Christian Budschedl
 * @link		http://kriesi.at
 * @link		http://stthemes.com
 * @since		Version 1.0
 * @package 	stFramework
 */

(function($)
{
	var st_mega_menu = {
	
		recalcTimeout: false,
	
		// bind the click event to all elements with the class st_uploader 
		bind_click: function()
		{
			var megmenuActivator = $('.menu-item-st-megamenu', '#menu-to-edit');
				
				megmenuActivator.live('click', function()
				{ 	
					var checkbox = $(this),
						container = checkbox.parents('.menu-item:eq(0)');
				
					if(checkbox.is(':checked'))
					{
						container.addClass('st-mega-active');
					}
					else
					{
						container.removeClass('st-mega-active');
					}
					
					//check if anything in the dom needs to be changed to reflect the (de)activation of the mega menu
					st_mega_menu.recalc();
					
				});
		},
        
        // bind the click event to all elements with the class st-use-title-active 
		bind_click_use_title: function()
		{
			var useTitleActivator = $('.menu-item-st-title-megamenu', '#menu-to-edit');
				
				useTitleActivator.live('click', function()
				{ 	
					var checkbox = $(this),
						container = checkbox.parents('.menu-item:eq(0)');
				
					if(checkbox.is(':checked'))
					{
						container.addClass('st-use-title-active');
					}
					else
					{
						container.removeClass('st-use-title-active');
					}
					
				});
		},
		
		recalcInit: function()
		{
			$( ".menu-item-bar" ).live( "mouseup", function(event, ui) 
			{
				if(!$(event.target).is('a'))
				{
					clearTimeout(st_mega_menu.recalcTimeout);
					st_mega_menu.recalcTimeout = setTimeout(st_mega_menu.recalc, 500);  
				}
			});
		},
		
		
		recalc : function()
		{
			menuItems = $('.menu-item', '#menu-to-edit');
			
			menuItems.each(function(i)
			{
				var item = $(this),
					megaMenuCheckbox = $('.menu-item-st-megamenu', this);
				
				if(!item.is('.menu-item-depth-0'))
				{
					var checkItem = menuItems.filter(':eq('+(i-1)+')');
					if(checkItem.is('.st-mega-active'))
					{
						item.addClass('st-mega-active');
						megaMenuCheckbox.attr('checked','checked');
					}
					else
					{
						item.removeClass('st-mega-active');
						megaMenuCheckbox.attr('checked','');
					}
				}				
				
				
				
				
				
			});
			
		},
		
		//clone of the jqery menu-item function that calls a different ajax admin action so we can insert our own walker
		addItemToMenu : function(menuItem, processMethod, callback) {
			var menu = $('#menu').val(),
				nonce = $('#menu-settings-column-nonce').val();

			processMethod = processMethod || function(){};
			callback = callback || function(){};

			params = {
				'action': 'st_ajax_switch_menu_walker',
				'menu': menu,
				'menu-settings-column-nonce': nonce,
				'menu-item': menuItem
			};

			$.post( ajaxurl, params, function(menuMarkup) {
				var ins = $('#menu-instructions');
				processMethod(menuMarkup, params);
				if( ! ins.hasClass('menu-instructions-inactive') && ins.siblings().length )
					ins.addClass('menu-instructions-inactive');
				callback();
			});
		}
        

};
	

	
	$(function()
	{
		st_mega_menu.bind_click();
        st_mega_menu.bind_click_use_title();
		st_mega_menu.recalcInit();
		st_mega_menu.recalc();
		if(typeof wpNavMenu != 'undefined'){ wpNavMenu.addItemToMenu = st_mega_menu.addItemToMenu; }
 	});

	
})(jQuery);
