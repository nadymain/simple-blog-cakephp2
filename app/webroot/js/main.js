$(function(){
	// menu
	$('.btn-menu').click(function (e) {
		e.preventDefault();
		$('.btn-menu').toggleClass('active');
		$('.main-menu').toggleClass('show');
	});

	// dropdown
	$('.dropit').dropit();

	// message
	$('.message').on('click', function () {
		$('.message').slideUp('fast');
	});
});