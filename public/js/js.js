

$(document).ready(function(){
	$(window).scroll(function () {
		if ($(this).scrollTop() > 50) {
			$('#back-to-top').fadeIn();
		} else {
			$('#back-to-top').fadeOut();
		}
	});
// scroll body to 0px on click
$('#back-to-top').click(function () {
	$('#back-to-top').tooltip('hide');
	$('body,html').animate({
		scrollTop: 0
	}, 800);
	return false;
});

$('#back-to-top').tooltip('show');

});



$('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
	if (!$(this).next().hasClass('show')) {
		$(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
	}
	var $subMenu = $(this).next(".dropdown-menu");
	$subMenu.toggleClass('show');

	$(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
		$('.dropdown-submenu .show').removeClass("show");
	});

	return false;
});


var i=0;
function expand(){
	if(i==0){
		document.getElementById("menua").style.transform="scale(2) translate(0, -25%) rotate(90deg)"; 
		document.getElementById("plusa").style.transform="rotate(360deg)"; 
		i=1;
	}
	else{   
		document.getElementById("menua").style.transform="scale(2) translate(50%, -25%) rotate(90deg)"; 
		document.getElementById("plusa").style.transform="rotate(0deg)"; 
		i=0;
	}
}



// Increase/descrease font size
$('#increasetext').click(function() {
	curSize = parseInt($('.menu-fsc').css('font-size')) + 2;
	if (curSize <= 16)
		$('.menu-fsc').css('font-size', curSize);
});

$('#resettext').click(function() {
	if (curSize != 14)
		$('.menu-fsc').css('font-size', 14);
});

$('#decreasetext').click(function() {
	curSize = parseInt($('.menu-fsc').css('font-size')) - 2;
	if (curSize >= 12)
		$('.menu-fsc').css('font-size', curSize);
});
// font size change



// Increase/descrease font size
$('#increasetext').click(function() {
	curSize = parseInt($('.h1-fsc').css('font-size')) + 2;
	if (curSize <= 45)
		$('.h1-fsc').css('font-size', curSize);
});

$('#resettext').click(function() {
	if (curSize != 40)
		$('.h1-fsc').css('font-size', 40);
});

$('#decreasetext').click(function() {
	curSize = parseInt($('.h1-fsc').css('font-size')) - 2;
	if (curSize >= 35)
		$('.h1-fsc').css('font-size', curSize);
});
// font size change


// Increase/descrease font size
$('#increasetext').click(function() {
	curSize = parseInt($('.h2-fsc').css('font-size')) + 2;
	if (curSize <= 37)
		$('.h2-fsc').css('font-size', curSize);
});

$('#resettext').click(function() {
	if (curSize != 32)
		$('.h2-fsc').css('font-size', 32);
});

$('#decreasetext').click(function() {
	curSize = parseInt($('.h2-fsc').css('font-size')) - 2;
	if (curSize >= 27)
		$('.h2-fsc').css('font-size', curSize);
});
// font size change


// Increase/descrease font size
$('#increasetext').click(function() {
	curSize = parseInt($('.h3-fsc').css('font-size')) + 2;
	if (curSize <= 33)
		$('.h3-fsc').css('font-size', curSize);
});

$('#resettext').click(function() {
	if (curSize != 28)
		$('.h3-fsc').css('font-size', 28);
});

$('#decreasetext').click(function() {
	curSize = parseInt($('.h3-fsc').css('font-size')) - 2;
	if (curSize >= 23)
		$('.h3-fsc').css('font-size', curSize);
});
// font size change


// Increase/descrease font size
$('#increasetext').click(function() {
	curSize = parseInt($('.h4-fsc').css('font-size')) + 2;
	if (curSize <= 29)
		$('.h4-fsc').css('font-size', curSize);
});

$('#resettext').click(function() {
	if (curSize != 24)
		$('.h4-fsc').css('font-size', 24);
});

$('#decreasetext').click(function() {
	curSize = parseInt($('.h4-fsc').css('font-size')) - 2;
	if (curSize >= 19)
		$('.h4-fsc').css('font-size', curSize);
});
// font size change


// Increase/descrease font size
$('#increasetext').click(function() {
	curSize = parseInt($('.h5-fsc').css('font-size')) + 2;
	if (curSize <= 25)
		$('.h5-fsc').css('font-size', curSize);
});

$('#resettext').click(function() {
	if (curSize != 20)
		$('.h5-fsc').css('font-size', 20);
});

$('#decreasetext').click(function() {
	curSize = parseInt($('.h5-fsc').css('font-size')) - 2;
	if (curSize >= 15)
		$('.h5-fsc').css('font-size', curSize);
});
// font size change


// Increase/descrease font size
$('#increasetext').click(function() {
	curSize = parseInt($('.h6-fsc').css('font-size')) + 2;
	if (curSize <= 21)
		$('.h6-fsc').css('font-size', curSize);
});

$('#resettext').click(function() {
	if (curSize != 16)
		$('.h6-fsc').css('font-size', 16);
});

$('#decreasetext').click(function() {
	curSize = parseInt($('.h6-fsc').css('font-size')) - 2;
	if (curSize >= 11)
		$('.h6-fsc').css('font-size', curSize);
});
// font size change


// Increase/descrease font size
$('#increasetext').click(function() {
	curSize = parseInt($('.p-fsc').css('font-size')) + 2;
	if (curSize <= 21)
		$('.p-fsc').css('font-size', curSize);
});

$('#resettext').click(function() {
	if (curSize != 16)
		$('.p-fsc').css('font-size', 16);
});

$('#decreasetext').click(function() {
	curSize = parseInt($('.p-fsc').css('font-size')) - 2;
	if (curSize >= 11)
		$('.p-fsc').css('font-size', curSize);
});
// font size change



$('#increasetext').click(function() {
	curSize = parseInt($('.menu-fsc').css('font-size')) + 2;
	if (curSize <= 16)
		$('.menu-fsc').css('font-size', curSize);
});

$('#resettext').click(function() {
	if (curSize != 14)
		$('.menu-fsc').css('font-size', 14);
});

$('#decreasetext').click(function() {
	curSize = parseInt($('.menu-fsc').css('font-size')) - 2;
	if (curSize >= 12)
		$('.menu-fsc').css('font-size', curSize);
});
// font size change




// Increase/descrease font size
$('#increasetext').click(function() {
	curSize = parseInt($('.list-group-item').css('font-size')) + 2;
	if (curSize <= 21)
		$('.list-group-item').css('font-size', curSize);
});

$('#resettext').click(function() {
	if (curSize != 16)
		$('.list-group-item').css('font-size', 16);
});

$('#decreasetext').click(function() {
	curSize = parseInt($('.list-group-item').css('font-size')) - 2;
	if (curSize >= 11)
		$('.list-group-item').css('font-size', curSize);
});
// font size change



// Increase/descrease font size
$('#increasetext').click(function() {
	curSize = parseInt($('.badge-pill').css('font-size')) + 2;
	if (curSize <= 17)
		$('.badge-pill').css('font-size', curSize);
});

$('#resettext').click(function() {
	if (curSize != 12)
		$('.badge-pill').css('font-size', 12);
});

$('#decreasetext').click(function() {
	curSize = parseInt($('.badge-pill').css('font-size')) - 2;
	if (curSize >= 7)
		$('.badge-pill').css('font-size', curSize);
});
// font size change





// Increase/descrease font size
$('#increasetext').click(function() {
	curSize = parseInt($('.border-card').css('font-size')) + 2;
	if (curSize <= 21)
		$('.border-card').css('font-size', curSize);
});

$('#resettext').click(function() {
	if (curSize != 16)
		$('.border-card').css('font-size', 16);
});

$('#decreasetext').click(function() {
	curSize = parseInt($('.border-card').css('font-size')) - 2;
	if (curSize >= 11)
		$('.border-card').css('font-size', curSize);
});
// font size change






const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');
const currentTheme = localStorage.getItem('theme');

if (currentTheme) {
	document.documentElement.setAttribute('data-theme', currentTheme);
	
	if (currentTheme === 'dark') {
		toggleSwitch.checked = true;
	}
}

function switchTheme(e) {
	if (e.target.checked) {
		document.documentElement.setAttribute('data-theme', 'dark');
		localStorage.setItem('theme', 'dark');
	}
	else {        document.documentElement.setAttribute('data-theme', 'light');
	localStorage.setItem('theme', 'light');
}    
}

toggleSwitch.addEventListener('change', switchTheme, false);








$('.menu, .overlay').click(function () {
	$('.menu').toggleClass('clicked');
	$('#nav').toggleClass('show');
	$( "#nav-alt" ).removeClass( "show" );
	$( ".menu-alt" ).removeClass( "clicked" );
});

$('.menu-alt, .overlay-alt').click(function () {
	$('.menu-alt').toggleClass('clicked');
	$('#nav-alt').toggleClass('show');
	$( "#nav" ).removeClass( "show" );
	$( ".menu" ).removeClass( "clicked" );
});

// navbar ends







$(document).ready(function(){
	$(".fancybox").fancybox({
		openEffect: "none",
		closeEffect: "none"
	});

	$(".zoom").hover(function(){

		$(this).addClass('transition');
	}, function(){

		$(this).removeClass('transition');
	});
});


$(".video-play").on('click', function(e) {
	e.preventDefault();
	var vidWrap = $(this).parent(),
	iframe = vidWrap.find('.video iframe'),
	iframeSrc = iframe.attr('src'),
	iframePlay = iframeSrc += "?autoplay=1";
	vidWrap.children('.video-thumbnail').fadeOut();
	vidWrap.children('.video-play').fadeOut();
	vidWrap.find('.video iframe').attr('src', iframePlay);
});



