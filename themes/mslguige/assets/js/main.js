(function($) {
  
  "use strict";  

  $(window).on('load', function() {
  	// Material
	$.material.init();

	// Dropdown 
  	$('.dropdown-toggle').dropdown()

  	$('.search-icon').on('click',function() {
    $('.navbar-form').fadeIn(300);
    $('.navbar-form input').focus();
	  });
	  $('.navbar-form input').blur(function() {
	    $('.navbar-form').fadeOut(300);
	 });

  	// Carousel
	$('.carousel').carousel()

	// Preloader
    $('#preloader').fadeOut();

    // Sticky Nav
    $(window).on('scroll', function() {
        if ($(window).scrollTop() > 200) {
            $('.scrolling-navbar').addClass('top-nav-collapse');
        } else {
            $('.scrolling-navbar').removeClass('top-nav-collapse');
        }
    });

    //  VIDEO POP-UP
    $('.video-popup').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false,
    });

    //WOW Scroll Spy
	var wow = new WOW({
	    //disabled for mobile
	    mobile: false
	});
	wow.init();
	// Testimonial Carousel
	  var owl = $(".testimonials-carousel");
	  owl.owlCarousel({
	    navigation: false,
	    pagination: true,
	    slideSpeed: 1000,
	    stopOnHover: true,
	    autoPlay: true,
	    items: 1,
	    itemsDesktopSmall: [1024, 1],
	    itemsTablet: [600, 1],
	    itemsMobile: [479, 1]
	  });

	  // Client Owl Carousel

	$("#client-logo").owlCarousel({
	    navigation: false,
	    pagination: false,
	    slideSpeed: 1000,
	    stopOnHover: true,
	    autoPlay: true,
	    items: 4,
	    itemsDesktopSmall: [1024, 3],
	    itemsTablet: [600, 1],
	    itemsMobile: [479, 1]
	});

	// Flickr Carousel
	$("#flickr-carousel").owlCarousel({
	  slideSpeed : 300,
	  paginationSpeed : 400,
	  items : 1,
	  autoPlay: 3000,
	  stopOnHover : true,

	});

	// Image Carousel
	$("#Material-image-carousel").owlCarousel({
	  slideSpeed : 300,
	  paginationSpeed : 400,
	  items : 4,
	  autoPlay: 3000,
	  stopOnHover : true,
	});


	// Counter JS
    $('.work-counter-section').on('inview', function(event, visible, visiblePartX, visiblePartY) {
        if (visible) {
            $(this).find('.timer').each(function() {
                var $this = $(this);
                $({
                    Counter: 0
                }).animate({
                    Counter: $this.text()
                }, {
                    duration: 3000,
                    easing: 'swing',
                    step: function() {
                        $this.text(Math.ceil(this.Counter));
                    }
                });
            });
            $(this).off('inview');
        }
    });	

	// MixitUp Init
	$('#Material-portfolio').mixItUp(); 

    $('#myTab a').on('click',function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	})

	// Slick Nav 
    $('.wpb-mobile-menu').slicknav({
      prependTo: '.navbar-header',
      parentTag: 'span',
      allowParentLinks: true,
      duplicate: false,
      label: '',
      closedSymbol: '<i class="mdi mdi-chevron-right"></i>',
      openedSymbol: '<i class="mdi mdi-chevron-down"></i>',
    });

	 // Back Top Link
	  var offset = 200;
	  var duration = 500;
	  $(window).scroll(function() {
	    if ($(this).scrollTop() > offset) {
	      $('.back-to-top').fadeIn(400);
	    } else {
	      $('.back-to-top').fadeOut(400);
	    }
	  });
	  
	  $('.back-to-top').click(function(event) {
	    event.preventDefault();
	    $('html, body').animate({
	      scrollTop: 0
	    }, 600);
	    return false;
	  });

  });      

}(jQuery));


/*******************************
 * COURS API CALL
 * 
 * ****************************/
 var token = "";
var params = {email:"admin@test.com", password:"test123"}
$.ajax({
	url: "http://localhost/cours-api/public/api/login",
	method: "POST",
	data:params,
	success: function(response) {
		token = response["data"]["api_token"];
		console.log(token);
		$.ajax({
			url: "http://localhost/cours-api/public/api/cours/",
			method: "GET",
			headers: {
				"Authorization" : "Bearer " + token
			},
			success: function(response) {
				console.log(response);
				loadCours(response);
			}
		});
	}
});

function loadCours(data){
    let html = "";
   for(let i = 0; i< data.length || i ==10; i++){
       
       html+= '<div class="card border-success mb-3 item active" style="max-width: 18rem;">'
       +'<div class="card-header bg-transparent border-success">'+data[i]['categorie'][0]+'</div>'
       +'<div class="card-body text-success cours-body">'
        +'<h5 class="card-title">'+data[i]['titre']+'</h5>'
    +'<p class="card-text">'+data[i]['description']+'<</p>'
  +'</div>'
  +'<div class="card-footer bg-transparent border-success">'
      +'<div>Debut : <span class="card-text"><small class="text-muted">Last updated 3 mins ago</small></span></div>'
      +'<div>Fin : <span class="card-text"><small class="text-muted">Last updated 3 mins ago</small></span></div>'
      +'<div>Lieu : <span class="card-text"><small class="text-muted">'+data[i]['organisateur']['adresse']+'</small></span></div>'
  +'</div>'
+'</div>'
   }
   console.log(html);
   $('#team-carousel').html(html);
   	// Image Carousel
	$("#team-carousel").owlCarousel({
	  slideSpeed : 300,
	  paginationSpeed : 400,
	  items : 4,
	  autoPlay: 3000,
	  stopOnHover : true,
	});

}
