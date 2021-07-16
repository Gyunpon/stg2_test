$(function() {
	var inHeight = $('.inner_menu').innerHeight();

	if ( inHeight <= 800 ) {
		$('.inner_menu').addClass('scroll');
		$('.inner_menu_bottom').addClass('fixed');
	} else if ( 801 <= inHeight ) {
      $('.inner_menu').removeClass('scroll');
      $('.inner_menu_bottom').removeClass('fixed');
    }
});