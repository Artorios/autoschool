$(document).ready(function(){

	initSlicks();
	$(function() {
		$('.select').selectric();
	});
	$(".menu-toggle").on("click", function () {
		$(this).toggleClass("active");
	});
	$(".ticket").on("click", function () {
		$(this).toggleClass("active");
	});

	if( window.innerWidth >= 991 ){
		$(".menu-toggle-wrapper").on("click", function () {asfdadsffads
			$(".inner-main-content").toggleClass("sidebar-narrow");
		});
	}
});
function initSlicks() {
	$('.slick-video').slick();
	$('.slick-text').slick({
		infinite: true,
		slidesToShow: 2,
		slidesToScroll: 1,
		responsive: [
			{
				breakpoint: 767,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
				}
			}
		]
	});
	$('.slick-training').slick({
		infinite: false,
		slidesToShow: 12,
		speed: 100,
		slidesToScroll: 3, //set 3 slides for responsive
		responsive: [
			{
				breakpoint: 1199,
				settings: {
					slidesToShow: 9,
					slidesToScroll: 1,
					infinite: true,
				}
			},
			{
				breakpoint: 991,
				settings: {
					slidesToShow: 7,
					slidesToScroll: 1
				}
			},
			{
				breakpoint: 767,
				settings: {
					slidesToShow: 4,
					slidesToScroll: 1
				}
			}
		]
	});
}
