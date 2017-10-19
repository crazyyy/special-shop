(function($){
	$(document).ready(function(){

		/*fix the situation when the menu is visible from the submenu.*/
		$('#access').find('div > ul > li').each(function(){
			if($(this).children('ul').length > 0){
				$(this).css({ 'z-index': '2' });
			} else {
				$(this).css({ 'z-index': '1' });
			}
		});

		/*fix menu:hover*/
		$('#access').find('div > ul > li:not(.current-menu-item, .current-menu-ancestor, .current_page_item, .current_page_ancestor) > a:only-child').hover( function() {
			$(this).css('background-color', '#2e6eae');
		}, function() {
			$(this).css('background-color', 'transparent');
		});
	});
})(jQuery);
