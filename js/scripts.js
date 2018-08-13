$ = jQuery.noConflict();


// ANIMATE CSS

$(document).ready(function(){

	$.fn.extend({
		animateCss: function(animationName, callback) {
			var animationEnd = (function(el) {
				var animations = {
					animation: 'animationend',
			  		OAnimation: 'oAnimationEnd',
			  		MozAnimation: 'mozAnimationEnd',
			  		WebkitAnimation: 'webkitAnimationEnd',
				};
				for (var t in animations) {
					if (el.style[t] !== undefined) {
						return animations[t];
					}
				}
		  	})(document.createElement('div'));
	  
			this.addClass('animated ' + animationName).one(animationEnd, function() {
				$(this).removeClass(animationName);
		
				if (typeof callback === 'function') callback();
			});
	  
		  	return this;
		},

		removeAnimatedClass: function(){
			$(this).removeClass('animated');
			return this;
		},

		productGallery: function () {
  
			return this.each(function () {
	  
				var thumbnail = $(this).find(".product-thumbnail"),
					mainImage = $(this).find(".big-image-container").children();

				// First thumbnail setup
				var first_thumbnail = thumbnail[0],
					first_thumbnail_src = $(first_thumbnail).attr("full-image");
				$(first_thumbnail).addClass("active");
				mainImage.attr("src", first_thumbnail_src);
				
				// Add click envent to the thumbnails
				thumbnail.on("click", function (e) {
					e.preventDefault();
					
					$(this).siblings().removeClass("active");
					$(this).addClass("active");

					var galleryImage = $(this).attr("full-image");
					mainImage.attr("src", galleryImage);
				});

				// Main image controls setup
				var controlsContainer = $(this).find(".controls-container"),
					prevControl = $(controlsContainer).children(".prev"),
					nextControl = $(controlsContainer).children(".next");

				nextControl.on("click", function () {
					var currentImage = $(thumbnail).filter(".active"),
						nextImage,
						nextImageSrc;

					if ($(currentImage).is(':last-child')) {
						nextImage = $(thumbnail).filter(":first-child");
					}else {
						nextImage = $(currentImage).next();
					}
										
					nextImageSrc = $(nextImage).attr("full-image");

					$(currentImage).removeClass("active");
					$(nextImage).addClass("active");
					
					mainImage.attr("src", nextImageSrc);
				});

				prevControl.on("click", function () {
					var currentImage = $(thumbnail).filter(".active"),
						prevImage,
						prevImageSrc;

					if ($(currentImage).is(':first-child')) {
						prevImage = $(thumbnail).filter(":last-child");
					}else {
						prevImage = $(currentImage).prev();
					}
										
					prevImageSrc = $(prevImage).attr("full-image");

					$(currentImage).removeClass("active");
					$(prevImage).addClass("active");
					
					mainImage.attr("src", prevImageSrc);
				});
	  
			});

			
	  
		},
		// Resize slider image
		resizeSliderImage: function () {
			return this.each(function () {
				var imagen = $(this).find(".imagen img"),
					imgContainer = $(imagen).parent();

				var imgWidth = $(imagen).width(),
					containerWidth = $(imgContainer).width();

				var imgHeight = $(imagen).height(),
					containerHeight  = $(imgContainer).height();
				
				if (imgWidth > containerWidth) {
					$(imgContainer).addClass("widest")
				}
				else if (imgHeight > containerHeight) {
					$(imgContainer).removeClass("widest")
				}
			});
		},

		setSizeBigTitle: function () {
			return this.each(function () {
				var title = $(this).text(),
					length = parseInt(title.length);

				var newSize = (14.5 * 5) / length;

				$(this).css('font-size', newSize + 'vw');
				
			});
		},

		setCatalogPagination: function () {
			var itemPerPage,
				width = $(window).width();

			if( width > 1200 ) {
				itemPerPage = 8;
			} else {
				itemPerPage = 6;
			}

			return this.each(function () {
				var holder = $(this).find(".holder"),
					items   = $(this).find(".items"),
					prev   = $(this).find(".arrowPrev"),
					next   = $(this).find(".arrowNext");


				$(holder).jPages({
					containerID : items.attr('id'),
					previous    : prev,
					next        : next,
					perPage : itemPerPage,
					midRange : 20,
				});
				
			});
		},

		clickableProduct: function () {

			return this.each(function () {
				var grid = $(this).parents(".product-category-grid"),
					product_template = $(grid).next(),
					backButton = $(product_template).find(".control.back"),
					loading = $(this).parents(".content").find(".loading");
				
				$(this).on("click", function() {
					
					var product = $(this);

					$(document).on({
						ajaxStart: function() { 
							$(loading).show();
						},
						ajaxComplete: function() { 
							$(loading).hide();
							$(grid).hide();
							$(product_template).show();
						}    
					});

					repaintProduct( product_template, product );

				});

				$(backButton).on("click", function (e) {
					e.preventDefault();

					$(product_template).hide();
					$(grid).show();

					
				});

			});
		},

	});



});

function setNextBackButton(template, item) {
	var prev = $(item).prev().children('.item'),
		next = $(item).next().children('.item');

	var prevButton = $(template).find(".references-nav-controls .control.prev"),
		nextButton = $(template).find(".references-nav-controls .control.next");


	var currentId = $(item).children('.item').attr('id-producto'),
		prevId    = $(prev).attr('id-producto'),
		nextId    = $(next).attr('id-producto');
		
	$(prevButton).off();
	$(nextButton).off();


	if ( !$(item).is(':last-child') ) {

		$(nextButton).removeClass("disabled");

		$(nextButton).on("click", function () {

			repaintProduct( template, next );
	
			$(nextButton).off();
		});	

	}

	if ( !$(item).is(':first-child') ) {

		$(prevButton).removeClass("disabled");

		$(prevButton).on("click", function () {

			repaintProduct( template, prev );
	
			$(prevButton).off();
		});

	}

	if ( $(item).is(':first-child') ||  $(item).is(':last-child')) {
		
		if ( $(item).is(':first-child') ) {
			$(prevButton).addClass("disabled");
		} 

		if ( $(item).is(':last-child') ) {
			$(nextButton).addClass("disabled");
		}
		return;
	}

	

}

function repaintProduct( template, product ) {
	var url_rest = rest_api_route.url;

	var product_id = $(product).attr('id-producto');

	var product_url = url_rest + product_id;

	cleanProduct(template);

				
	$.ajax({
		dataType: 'json',
		url: product_url
	}).done(function(result) {

		repaint(result);

		setNextBackButton( template, $(product).parent() );
	});

	function repaint(product) {
		var title = $(template).find("h3.name"),
			gender = $(template).find("div.gender"),
			descripcion = $(template).find("div.descripcion"),
			options = $(template).find("ul.options"),
			gallery = $(template).find("div.thumbnail-gallery-container");	
			

		$(title).append(product.title.rendered);

		$(gender).append( genderTemplate( product.genero ) );
		
		$(descripcion).append( product.desc );

		$(options).append( opcionesTemplate( product.opciones ) );

		$(gallery).append( galeriaTemplate( product.galeria ) );

		$(template).find("div.product-content").productGallery();
	}

	function cleanProduct(template) {
		var title = $(template).find("h3.name"),
			gender = $(template).find("div.gender"),
			descripcion = $(template).find("div.descripcion"),
			options = $(template).find("ul.options"),
			gallery = $(template).find("div.thumbnail-gallery-container");
	
		$(title).empty();
	
		$(gender).empty();
		
		$(descripcion).empty();
	
		$(options).empty();
	
		$(gallery).empty();
	
		$(template).find("div.product-content .big-image-container img").attr('src', '');		
		
	}

	function galeriaTemplate(galeria) {
		var template = '';
	
		var fullSizeImage = galeria['galeria'];
		var thumbnails = galeria['thumbnails'];
	
		for ( index in thumbnails ) {
			template += '<a class="product-thumbnail" full-image="' + fullSizeImage[index] + '">' + 
							'<img src="' + thumbnails[index][0] + '">';
						'</a>';
			var img = new Image();
			img.src = fullSizeImage[index];
		}
	
		return template;
	}

	function opcionesTemplate(opciones) {
		var template = '';
	
		for ( index in opciones ) {
			template += '<li>' + opciones[index] + '</li>'
		}
	
		return template;
	}


	function genderTemplate(gender) {
		var template = '';
		if ( gender == 'unisex' ) {
	
			template = '' + 
				'<div class="icon unisex">' +
					'<i class="fa fa-female"></i>' +
					'<i class="fa fa-male"></i>' +
				'</div>' +
				'<div class="text">unisex</div>';
	
		} else if ( gender == 'femenino' ) {
	
			template = '' + 
				'<div class="icon">' +
					'<i class="fa fa-female"></i>' +
				'</div>' +
				'<div class="text">femenino</div>';
	
		} else if ( gender == 'masculino' ) { 
	
			template = '' + 
				'<div class="icon">' +
					'<i class="fa fa-male"></i>' +
				'</div>' +
				'<div class="text">masculino</div>';
		}
	
		return template;
	}
	
		
}






function resizeFrontPageLine() {
	var rh = $(window).height(),
		rw = $(window).width(),
		rel = rw / rh;

	if (rw >= 1900 ) {
		$('.main .lineas').removeClass('tallest');
		$('.main .lineas').addClass('full-view');

	} 
	else if( rw < 992 ) {
		$('.main .lineas').removeClass('full-view');
		$('.main .lineas').addClass('tallest');
	}	
	else {
		if( rel < 1.5 || rel > 1.7 ) {
			$('.main .lineas').removeClass('full-view');
			$('.main .lineas').addClass('tallest');

		} 
		else if ( rel > 1.5 ) {
			$('.main .lineas').removeClass('tallest');
			$('.main .lineas').addClass('full-view');
		}
	}
}


$(document).ready(function(){

	$('.product-category-grid').setCatalogPagination();

	$('.product-category-grid .item').clickableProduct();

	$('.slider .big-title').setSizeBigTitle();

	$('.info.telas .big-title').setSizeBigTitle();

	
	// CATALOGO ACORDEON
	$('.catalogo .header').on('click' , function () {
		
		if( $(this).filter( ".active" ).length ){

			// $(this).next().slideToggle('slow');
			$(this).next().removeClass('open');
			$(this).toggleClass("active");

		}else {

			// $('.catalogo .header.active').next().slideToggle('slow');
			$('.catalogo .header.active').next().removeClass('open');
			$('.catalogo .header.active').removeClass("active");

			// $(this).next().slideToggle('slow');
			$(this).next().addClass('open');
			$(this).toggleClass("active");

			var opening = $(this);

			setTimeout(function(){ 
				
				var locationTop = $(opening).offset().top;

				$('html, body').animate({
					scrollTop : locationTop
				} , 500);

			 }, 700);


		}
		return false;

	});

	// GO TO CATALOG BUTTON
	$('.catalog-button').on('click', function() {
		var catalog = $(this).parents(".main").find("section.catalogo");
			catalogLocation = $(catalog).offset().top;

		$('html, body').animate({
			scrollTop : catalogLocation
		} , 600);
	});

	

	
	// PRODUCT GALLERY
	$('.product-content').productGallery();


	// RESIZE INDEX SQUARES

	resizeFrontPageLine();

	$(window).resize(function () {
		resizeFrontPageLine();
	});
	
	// RESIZE SLIDER IMAGE

		// On Init
	setTimeout(() => {
		$('.slider.main').resizeSliderImage();
		$('.slider.blur-bg').resizeSliderImage();
	}, 200);
	
		// On viewport resize
	$(window).resize(function () {
		$('.slider.main').resizeSliderImage();
		$('.slider.blur-bg').resizeSliderImage();
	});


	// MOBILE MENU

	$('.mobile-menu .boton').on('click', function(){
		$(this).toggleClass("open");

		$('.menu ul').slideToggle('slow');

		smoothScrollIndex();

		return false;
	});

	// VALORES
	function nextValor() {
		var desc_actual = $('.valores .descripcion-valor p:not(.hidden)' ),
			desc_container = $( '.valores .descripcion-valor' ),
			index = $(desc_actual).index();

		if ( index == 5 ) {
			index = 0;
		} else {
			index += 1;
		}

		var next = $('.valores ul.row li').get(index),
			desc = $('.valores .descripcion-valor p:nth-child(' + (index + 1)  + ')' ),
			color = $(next).children('p.valor').css('background-color');

		$(desc_actual).addClass("hidden");
		$(desc).removeClass("hidden");
		$(desc_container).css('background-color', color);
	}

	var valoresSlideShow = setInterval(function(){ nextValor(); }, 4000);

	$('.valores ul.row li').on('click mouseover', function () {
		clearInterval(valoresSlideShow);

		var index = $(this).index() + 1,
			desc_container = $( '.valores .descripcion-valor' ),
			desc = $('.valores .descripcion-valor p:nth-child(' + index + ')' ),
			color = $(this).children('p.valor').css('background-color'),
			desc_actual = $('.valores .descripcion-valor p:not(.hidden)' );

		$(desc_actual).addClass("hidden");
		$(desc).removeClass("hidden");
		$(desc_container).css('background-color', color);

	});

	$('.valores ul.row li').on('mouseout', function () {
		valoresSlideShow = setInterval(function(){ nextValor(); }, 4000);
	})


	// HOOK FLEXSLIDER
	$('.flexslider-big').flexslider({
		animation: "slide",
		touch: true,
		slideshowSpeed: 5000,
		animationSpeed: 800,   
		slideshow: true,
		useCSS: false,
		start: function(){
			$('.slider.main.flex-active-slide .big-title').animateCss('fadeInDown');
			$('.slider.main.flex-active-slide img').animateCss('fadeInRight');
			$('.slider.main.flex-active-slide .descripcion').animateCss('fadeInUp');
		},
		before: function(){
			$('.slider.main.flex-active-slide .big-title').animateCss('fadeOutUp', function() {
				$('.slider.main:not(.flex-active-slide)  .big-title').removeAnimatedClass();
			});
			$('.slider.main.flex-active-slide img').animateCss('fadeOut', function() {
				$('.slider.main:not(.flex-active-slide)  img').removeAnimatedClass();
			});
			$('.slider.main.flex-active-slide .descripcion').animateCss('fadeOutDown', function() {
				$('.slider.main:not(.flex-active-slide)  .descripcion').removeAnimatedClass();
			});


			$('.slider.blur-bg.flex-active-slide .titulo').animateCss('fadeOutUp', function() {
				$('.slider.blur-bg:not(.flex-active-slide)  .titulo').removeAnimatedClass();
			});
			$('.slider.blur-bg.flex-active-slide img').animateCss('fadeOut', function() {
				$('.slider.blur-bg:not(.flex-active-slide)  img').removeAnimatedClass();
			});
			$('.slider.blur-bg.flex-active-slide .descripcion').animateCss('fadeOutDown', function() {
				$('.slider.blur-bg:not(.flex-active-slide)  .descripcion').removeAnimatedClass();
			});


			$('.slider.full-bg.flex-active-slide .titulo').animateCss('fadeOut', function() {
				$('.slider.full-bg:not(.flex-active-slide)  .titulo').removeAnimatedClass();
			});
			$('.slider.full-bg.flex-active-slide .descripcion').animateCss('fadeOutDown', function() {
				$('.slider.full-bg:not(.flex-active-slide)  .descripcion').removeAnimatedClass();
			});
			

			$('.slider.half-img.flex-active-slide .titulo').animateCss('fadeOut', function() {
				$('.slider.half-img:not(.flex-active-slide) .titulo').removeAnimatedClass();
			});
			
			$('.slider.half-img:not(.flex-active-slide) .imagen').removeAnimatedClass();

			$('.slider.half-img.flex-active-slide .descripcion').animateCss('fadeOutDown', function() {
				$('.slider.half-img:not(.flex-active-slide) .descripcion').removeAnimatedClass();
			});
		},
		after: function(){
			$('.slider.main.flex-active-slide .big-title').animateCss('fadeInDown');
			$('.slider.main.flex-active-slide img').animateCss('fadeInRight');
			$('.slider.main.flex-active-slide .descripcion').animateCss('fadeInUp');

			$('.slider.blur-bg.flex-active-slide .titulo').animateCss('fadeInDown');
			$('.slider.blur-bg.flex-active-slide img').animateCss('fadeInRight');
			$('.slider.blur-bg.flex-active-slide .descripcion').animateCss('fadeInUp');

			$('.slider.full-bg.flex-active-slide .titulo').animateCss('fadeInDown');
			$('.slider.full-bg.flex-active-slide .descripcion').animateCss('fadeInUp');

			$('.slider.half-img.flex-active-slide .titulo').animateCss('fadeInLeft');
			$('.slider.half-img.flex-active-slide .descripcion').animateCss('fadeInUp');
			$('.slider.half-img.flex-active-slide .imagen').animateCss('slideInRight');
		}
	});

	

	$('.flexslider-content').flexslider({
		animation: "fade",
		touch: true,
		slideshow: false,
		useCSS: true,
	});

	smoothScrollIndex();


});


function smoothScrollIndex() {
	if ( $(document.body).hasClass("home")) {
		
		setTimeout(() => {

			var laEmpresa = $('#empresa').offset().top;

			$('#btn-empresa').on('click' , function (e) {
				e.preventDefault();
				$('html, body').animate({
					scrollTop : laEmpresa
				} , 700);
			});
		
			var contacto = $('#contacto').offset().top;
		
			$('#btn-contacto').on('click' , function (e) {
				e.preventDefault();
				$('html, body').animate({
					scrollTop : contacto
				} , 800);
			});

		}, 1000);

	}
}

