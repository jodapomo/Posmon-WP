$ = jQuery.noConflict();


$(document).ready(function(){

    // jQuery extends
    ( function( $ ) {

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
    
                    controlsContainer
    
                    $(controlsContainer).swipe( {
                        
                        swipeLeft:function(event, direction, distance, duration, fingerCount) {
    
                            var currentImage = $(thumbnail).filter(".active"),
                                nextImage,
                                nextImageSrc;
    
                            if ($(currentImage).is(':last-child')) {
                                nextImage = $(thumbnail).filter(":first-child");
                            } else {
                                nextImage = $(currentImage).next();
                            }
                                                
                            nextImageSrc = $(nextImage).attr("full-image");
    
                            $(currentImage).removeClass("active");
                            $(nextImage).addClass("active");
                            
                            mainImage.attr("src", nextImageSrc);
                        },
    
                        swipeRight:function(event, direction, distance, duration, fingerCount) {
    
                            var currentImage = $(thumbnail).filter(".active"),
                                prevImage,
                                prevImageSrc;
    
                            if ($(currentImage).is(':first-child')) {
                                prevImage = $(thumbnail).filter(":last-child");
                            } else {
                                prevImage = $(currentImage).prev();
                            }
                                                
                            prevImageSrc = $(prevImage).attr("full-image");
    
                            $(currentImage).removeClass("active");
                            $(prevImage).addClass("active");
                            
                            mainImage.attr("src", prevImageSrc);
                        },
                        
    
                        // allowPageScroll: "vertical",
    
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
    
                    
                    if ( ( $(window).width() < 700 ) ) {
    
                        var paddingImg = parseInt($(imgContainer).css("padding-bottom"));
    
                        var mobile = $(imgContainer).parent().find(".content-mobile");
                            mobileHeight = $(mobile).height();
    
                        if ( paddingImg > 0 ) {
    
                            if ( imgWidth > containerWidth ) {
    
                                $(imgContainer).addClass("widest");
    
                            } else if ( ( mobileHeight + 25 ) != paddingImg  ) {
                                
                                $(imgContainer).css("padding-bottom", ( mobileHeight + 25 ) + 'px' );
    
                            } else if ( imgHeight > containerHeight ) {
    
                                $(imgContainer).removeClass("widest");
    
                            } 
    
                        } else if (imgWidth > containerWidth) {
    
                            $(imgContainer).css("padding-bottom", ( mobileHeight + 25 ) + 'px' );
    
                        } else if ( imgHeight > containerHeight ) {
    
                            $(imgContainer).removeClass("widest");
    
                        }
    
                    } else if ( imgWidth > containerWidth ) {
    
                        $(imgContainer).css("padding-bottom", 0 );
    
                        $(imgContainer).addClass("widest");
    
                    } else if (imgHeight > containerHeight)  {
    
                        $(imgContainer).css("padding-bottom", 0 );
    
                        $(imgContainer).removeClass("widest");
    
                    } else {
                        $(imgContainer).css("padding-bottom", 0 );
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
    
    
    
    } )( jQuery );

    resizeFrontPageLine();

    smoothScrollIndex();

    alert("VEALO HENRY PORRAS 3");

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

function smoothScrollIndex() {
	if ( $(document.body).hasClass("home")) {
		
		searchTimeout = setTimeout(() => {

			// var laEmpresa = $('#empresa').offset().top;

			// $('#btn-empresa').on('click' , function (e) {
			// 	e.preventDefault();
			// 	$('html, body').animate({
			// 		scrollTop : laEmpresa
			// 	} , 700);
			// });
		
			// var contacto = $('#contacto').offset().top;
		
			// $('#btn-contacto').on('click' , function (e) {
			// 	e.preventDefault();
			// 	$('html, body').animate({
			// 		scrollTop : contacto
			// 	} , 800);
            // });
            
            alert("Erao yo el triple hijueputa culpable");

		}, 1000);

	}
}
