(function($) {
	
	"use strict";
	
	
	//Hide Loading Box (Preloader)
	function handlePreloader() {
		if($('.preloader').length){
			$('.preloader').delay(500).fadeOut(500);
		}
	}
	
	
	//Add tri line border in Main Navigation
	$('.navbar-collapse .navigation > li > a').append('<div class="tri-line clearfix"><span class="line one"></span><span class="line two"></span><span class="line three"></span></div>');
	
	//Update Header Style + Scroll to Top
	function headerStyle() {
		if($('.main-header').length){
			var windowpos = $(window).scrollTop();
			var topHeight = $('.header-top').innerHeight();
			if (windowpos >= topHeight) {
				$('.main-header').addClass('header-fixed');
				$('#side-navigation').addClass('scrolled-down');
				$('.scroll-to-top').fadeIn(300);
			} else {
				$('.main-header').removeClass('header-fixed');
				$('#side-navigation').removeClass('scrolled-down');
				$('.scroll-to-top').fadeOut(300);
			}
		}
	}
	
	
	//Update Sidebar Style / Visible on small Screens
	function sideBar() {
		if($('#side-navigation').length){
			var windowWidth = $(window).width();
			if (windowWidth <= 767) {
				$('#side-navigation').addClass('visible-sidebar');
			} else {
				$('#side-navigation').removeClass('visible-sidebar');
			}
		}
	}
	
	
	//Update Default Banner to Fullscreen
	function videoBg() {
		if($('.window-size').length){
			var defBannerHeight = $('.window-size .auto-container').innerHeight();
			var windowHeight = $(window).height() - $('.header-top').height();
			if (windowHeight >= defBannerHeight) {
				$('.window-size').css({'height':windowHeight,'min-height':windowHeight});
				$('.window-size .auto-container').css({'position':'absolute','height':windowHeight,'min-height':windowHeight,});
			} else {
				$('.window-size').css({'height':'auto','min-height':windowHeight});
				$('.window-size .auto-container').css({'min-height':windowHeight,'height':windowHeight});
			}
		}
	}
	
	//Play HTML5 Video when page is loaded
	function playBannerVideo() {
		if($('.banner-video').length){
			$('.banner-video').get(0).play();
		}
	}
	
	
	//Parallax Scroll
	if($('.parallax-background .window-size').length){
		$('.parallax-background .window-size').parallax("20%", 0.4);
	}
	
	
	//Sidebar Nav Dropdown Toggle
	if($('#side-navigation li.dropdown .submenu').length){
		
		$('#side-navigation .toggle-nav').on('click', function() {
			$('#side-navigation').toggleClass('toggled-sidebar');
		});
			
		$('#side-navigation li.dropdown').append('<div class="dropdown-btn"></div>');
		
		//Dropdown Button
		$('#side-navigation li.dropdown .dropdown-btn').on('click', function() {
			$(this).prev('.submenu').slideToggle(500);
		});
	}
	
	//Add Scroll Bar To Sidebar
	if($('#side-navigation .sidebar-inner').length){
		$("#side-navigation .sidebar-inner").mCustomScrollbar({
			axis:"y",
			autoExpandScrollbar:false
		});
	}
	
	
	//Main Slider / Revolution Slider
	if($('.tp-banner-container').length){

		jQuery('.main-slider .tp-banner').show().revolution({
		  delay:7000,
		  startwidth:1200,
		  startheight:690,
		  hideThumbs:600,
	
		  thumbWidth:80,
		  thumbHeight:50,
		  thumbAmount:5,
	
		  navigationType:"bullet",
		  navigationArrows:"0",
		  navigationStyle:"preview4",
	
		  touchenabled:"on",
		  onHoverStop:"off",
	
		  swipe_velocity: 0.7,
		  swipe_min_touches: 1,
		  swipe_max_touches: 1,
		  drag_block_vertical: false,
	
		  parallax:"mouse",
		  parallaxBgFreeze:"on",
		  parallaxLevels:[7,4,3,2,5,4,3,2,1,0],
	
		  keyboardNavigation:"on",
	
		  navigationHAlign:"center",
		  navigationVAlign:"bottom",
		  navigationHOffset:0,
		  navigationVOffset:20,
	
		  soloArrowLeftHalign:"left",
		  soloArrowLeftValign:"bottom",
		  soloArrowLeftHOffset:20,
		  soloArrowLeftVOffset:0,
	
		  soloArrowRightHalign:"right",
		  soloArrowRightValign:"bottom",
		  soloArrowRightHOffset:20,
		  soloArrowRightVOffset:0,
	
		  shadow:0,
		  fullWidth:"on",
		  fullScreen:"off",
	
		  spinner:"spinner4",
	
		  stopLoop:"off",
		  stopAfterLoops:-1,
		  stopAtSlide:-1,
	
		  shuffle:"off",
	
		  autoHeight:"off",
		  forceFullWidth:"on",
	
		  hideThumbsOnMobile:"on",
		  hideNavDelayOnMobile:1500,
		  hideBulletsOnMobile:"on",
		  hideArrowsOnMobile:"off",
		  hideThumbsUnderResolution:0,
	
		  hideSliderAtLimit:0,
		  hideCaptionAtLimit:0,
		  hideAllCaptionAtLilmit:0,
		  startWithSlide:0,
		  videoJsPath:"",
		  fullScreenOffsetContainer: ".header-top"
	  });

		
	}
	
	
	//Responsive Videos
	if($('.responsive-video').length){
		$(".responsive-video").fitVids();
	}
	
	
	//Donation Meter
	if($('.proj-donation .bar-inner').length){
		$(".proj-donation .bar-inner").each(function() {
			var progressWidth = ($(this).attr('data-don-received') / $(this).attr('data-don-total'))*100;
			$(this).css('width',progressWidth+'%');
		});
	}
	
	
	//Countdown Timer
	if($('#countdown-timer').length){                     
		$('#countdown-timer').countdown('2015/12/25', function(event) {
			var $this = $(this).html(event.strftime('' + '<div class="counter-column"><span class="count">%d</span><span class="colon">:</span><br>DAYS</div> ' + '<div class="counter-column"><span class="count">%H</span><span class="colon">:</span><br>HOURS</div>  ' + '<div class="counter-column"><span class="count">%M</span><span class="colon">:</span><br>MINUTES</div>  ' + '<div class="counter-column"><span class="count">%S</span><br>SECOND</div>'));
		});
	}
	
	
	//Tabs Box
	if($('.tabs-box').length){
		$('.tabs-box .tab-btn').on('click', function(e) {
			e.preventDefault();
			var target = $($(this).attr('href'));
			$('.tabs-box .tab-btn').removeClass('active-btn');
			$(this).addClass('active-btn');
			$('.tabs-box .tab').fadeOut(0);
			$('.tabs-box .tab').removeClass('active-tab');
			$(target).fadeIn(300);
			$(target).addClass('active-tab');
			var windowWidth = $(window).width();
			if (windowWidth <= 700) {
				$('html, body').animate({
				   scrollTop: $('.tabs-box .tabs-content').offset().top-10
				 }, 1000);
			}
		});
		
	}
	
	//Jquery Knob animation 
	if($('.dial').length){
		$('.dial').appear(function(){
          var elm = $(this);
          var color = elm.attr('data-fgColor');  
          var perc = elm.attr('value');  
 
          elm.knob({ 
               'value': 0, 
                'min':0,
                'max':100,
                'skin':'tron',
                'readOnly':true,
                'thickness':0.20,
				'dynamicDraw': true,
				'displayInput':false
          });

          $({value: 0}).animate({ value: perc }, {
			  duration: 1500,
              easing: 'swing',
              progress: function () { elm.val(Math.ceil(this.value)).trigger('change');
              }
          });

          //circular progress bar color
          $(this).append(function() {
              elm.parent().parent().find('.circular-bar-content').css('color',color);
              elm.parent().parent().find('.circular-bar-content label').text(perc+'%');
          });

          },{accY: 20});
    }
	
	//Client Logos Slider
	if ($('.sponsors-section .slider').length) {
		$('.sponsors-section .slider').owlCarousel({
			loop:true,
			margin:10,
			nav:true,
			autoplay: 3000,
			smartSpeed:500,
			responsive:{
				0:{
					items:2
				},
				600:{
					items:2
				},
				800:{
					items:3
				},
				1000:{
					items:4
				},
				1100:{
					items:5
				}
			}
		});    		
	}
	
	//Image Carousel Slider
	if ($('.image-carousel .slider').length) {
		$('.image-carousel .slider').owlCarousel({
			loop:true,
			  navigation : false,
			  slideSpeed : 500,
			  responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				1024:{
					items:1
				},
				1200:{
					items:1
				},
				1400:{
					items:1
				}
			}
		});    		
	}
	
	
	// Fact Counter
	function factCounter() {
		if($('.fact-counter').length){
			$('.counter-column.animated').each(function() {
		
				var $t = $(this),
					n = $t.find(".count-text").attr("data-stop"),
					r = parseInt($t.find(".count-text").attr("data-speed"), 10);
					
				if (!$t.hasClass("counted")) {
					$t.addClass("counted");
					$({
						countNum: $t.find(".count-text").text()
					}).animate({
						countNum: n
					}, {
						duration: r,
						easing: "linear",
						step: function() {
							$t.find(".count-text").text(Math.floor(this.countNum));
						},
						complete: function() {
							$t.find(".count-text").text(this.countNum);
						}
					});
				}
				
			});
		}
	}
	
	//Contact Form Validation
	if($('#contact-form').length){
		$('#contact-form').validate({ // initialize the plugin
			rules: {
				username: {
					required: true
				},
				email: {
					required: true,
					email: true
				},
				subject: {
					required: true
				},
				message: {
					required: true
				}
			}
		});
	}
	
	// Google Map Settings
	if($('#map-location').length){
		var map;
		 map = new GMaps({
			el: '#map-location',
			zoom: 14,
			scrollwheel:false,
			//Set Latitude and Longitude Here
			lat: -37.817085,
			lng: 144.955631
		  });
		  
		  //Add map Marker
		  map.addMarker({
			lat: -37.817085,
			lng: 144.955631,
			infoWindow: {
			  content: '<p><strong>Envato</strong><br>Melbourne VIC 3000, Australia</p>'
			}
		 
		});
	}
	
	// Scroll to top
	if($('.scroll-to-top').length){
		$(".scroll-to-top").on('click', function() {
		   // animate
		   $('html, body').animate({
			   scrollTop: $('html, body').offset().top
			 }, 1000);
	
		});
	}
	
	// Elements Animation
	if($('.wow').length){
		var wow = new WOW(
		  {
			boxClass:     'wow',      // animated element css class (default is wow)
			animateClass: 'animated', // animation css class (default is animated)
			offset:       0,          // distance to the element when triggering the animation (default is 0)
			mobile:       true,       // trigger animations on mobile devices (default is true)
			live:         true       // act on asynchronously loaded content (default is true)
		  }
		);
		wow.init();
	}

	// gallery filter activation
    function GalleryFilter () {

    	if ($('#image-gallery-mix').length) {
    		$('.gallery-filter').find('li').each(function () {
    			$(this).addClass('filter');
    		});
    		$('#image-gallery-mix').mixItUp();
    	};
    	if($('.gallery-filter.masonary').length){
			$('.gallery-filter.masonary span').on('click', function(){
				var selector = $(this).parent().attr('data-filter');
				$('.gallery-filter.masonary span').parent().removeClass('active');
				$(this).parent().addClass('active');
				$('#image-gallery-isotope').isotope({ filter: selector });
				return false;
			});
    	}
    }
    // gallery fancybox activator 
    function GalleryFancyboxActivator () {
    	var galleryFcb = $('.fancybox');
    	if(galleryFcb.length){
    		galleryFcb.fancybox();
    	}
    }
	// Adding hover effect to gallery 
	function galleryHover () {
		// hover effect for masonary gallery
		if ($('.masonary-gallery').length) {
			$('.masonary-gallery .content-wrap').each(function () {
				$(this).addClass('hvr-shutter-in-vertical');
			});
		};
		// hover effect for normal gallery
		if ($('.normal-gallery').length) {
			$('.normal-gallery .content-wrap').each(function () {
				$(this).addClass('hvr-rectangle-out');
				$(this).parent().parent().addClass('mix');
			});
		};
			
	}
	// Gallery masonary style
	function galleryMasonaryLayout () {
		if ($('.masonary-gallery').length) {
			$('.masonary-gallery').isotope({
				layoutMode:'masonry'
			});
		}
	}
	//Schedule Box Tabs
	if($('.schedule-box').length){
		
		//Tabs
		$('.schedule-box .tab-btn').on('click', function() {
			var target = $($(this).attr('data-id'));
			$('.schedule-box .tab-btn').removeClass('active');
			$(this).addClass('active');
			$('.schedule-box .tab').fadeOut(0);
			$('.schedule-box .tab').removeClass('current');
			$(target).fadeIn(300);
			$(target).addClass('current');
			var windowWidth = $(window).width();
			if (windowWidth <= 700) {
				$('html, body').animate({
				   scrollTop: $('.tabs-box').offset().top
				 }, 1000);
			}
		});
		
		//Accordion
		$('.schedule-box .hour-box .toggle-btn').on('click', function() {
			var target = $($(this).next('.content-box'));
			$(this).toggleClass('active');
			$(target).slideToggle(300);
			$(target).parents('.hour-box').toggleClass('active-box');
		});
		
	}


/* ==========================================================================
   When document is ready, do
   ========================================================================== */
   
	$(document).on('ready', function() {
		headerStyle();
		sideBar();
		factCounter();
		videoBg();
		GalleryFilter();
		GalleryFancyboxActivator();
		galleryHover();
		galleryMasonaryLayout();
	});

/* ==========================================================================
   When document is Scrollig, do
   ========================================================================== */
	
	$(window).on('scroll', function() {
		headerStyle();
		factCounter();
	});
	
/* ==========================================================================
   When document is loading, do
   ========================================================================== */
	
	$(window).on('load', function() {
		handlePreloader();
		videoBg();
		playBannerVideo();
	});
	
/* ==========================================================================
   When Window is Resizing, do
   ========================================================================== */
	
	$(window).on('resize', function() {
		sideBar();
		videoBg();
	});
	
})(window.jQuery);