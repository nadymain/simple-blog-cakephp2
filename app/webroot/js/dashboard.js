$(function(){
	// dropdown
	$(document).on('click', '.dropdown>a', function (e) {
		e.preventDefault();
	});
	$(document).on('click', '.dropdown', function (e) {
		e.stopPropagation();
		$(".dropdown").not(this).removeClass("active");
		$(this).toggleClass("active");
	});
	$(document).click(function () {
		$(".dropdown").removeClass("active");
	});

	// message
	$('.message').on('click', function () {
		$('.message').slideUp('fast');
	});

	// aside slide
	$('.btn-menu a').click(function (e) {
		e.preventDefault();
		$('.btn-menu a').toggleClass('show');
		if ($(window).outerWidth() <= 899) {
			$('body').toggleClass('aside-on');
			$('body').removeClass('aside-off');
			if ($('body').hasClass('aside-on')) {
				$('.aside').animate({
					'left': '0'
				}, 'fast')
			} else {
				$('.aside').animate({
					'left': '-18rem'
				}, 'fast', function () {
					$(this).removeAttr('style')
				})
			}
		} else {
			$('body').toggleClass('aside-off');
			$('body').removeClass('aside-on');
			if ($('body').hasClass('aside-off')) {
				$('.aside').animate({
					'left': '-18rem'
				}, 'fast');
				$('.main').animate({
					'margin-left': '0'
				}, 'fast')
			} else {
				$('.aside').animate({
					'left': '0'
				}, 'fast', function () {
					$(this).removeAttr('style')
				});
				$('.main').animate({
					'margin-left': '18rem'
				}, 'fast', function () {
					$(this).removeAttr('style')
				})
			}
		}
	});
});