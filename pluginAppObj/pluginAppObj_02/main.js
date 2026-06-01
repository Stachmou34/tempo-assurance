function animatedslider_pluginAppObj_02() {
    var pluginAppObj_02Swiper,
        fullWidth = false,
        resizeTimer; // Set resizeTimer to empty so it resets on page load

    x5engine.boot.push(function(){           
        resizeAnimatedSwiper_pluginAppObj_02();
        loadSwiper();
    
		var pluginAppObj_02_resizeTo = null,
		pluginAppObj_02_width = 0;
		x5engine.utils.onElementResize(document.getElementById('pluginAppObj_02'), function (rect, target) {
			if (pluginAppObj_02_width == rect.width) {
				return;
			}
			pluginAppObj_02_width = rect.width;
			if (!!pluginAppObj_02_resizeTo) {
				clearTimeout(pluginAppObj_02_resizeTo);
			}
			pluginAppObj_02_resizeTo = setTimeout(function() {
				resizeAnimatedSwiper_pluginAppObj_02();
				loadSwiper();
			}, 50);
		});
    
    
    });

    function resizeAnimatedSwiper_pluginAppObj_02(){
        
        var container_width = $("#pluginAppObj_02").width();
        var heightUI = 350;
        var widthUI  = 940;
        var height = heightUI;
        var width = widthUI;
        var max_width = container_width;
        var controls_padding = 0
        var pagination_padding = 0 
        
        if (!fullWidth || false) {
            //obj in the bp ceil
            max_width = (container_width < width ? container_width : width);
            height = ((max_width - controls_padding) / width) * height;
                        
            width = max_width - controls_padding;
            $("#swiper_pluginAppObj_02").css({"width": max_width,"height": height + pagination_padding});
        }
        else {
            //obj fullwidth
            if (max_width > widthUI) {
                height = heightUI;
            }
            else {
                height = ((max_width - controls_padding) / widthUI) * height;
            }
            
            width = container_width - controls_padding;
            $("#swiper_pluginAppObj_02").css({"height": height + pagination_padding});
        }
            
        $("#pluginAppObj_02 .swiper-container.main").css({"width": width,"height": height});
        $("#pluginAppObj_02 .swiper-button-next, #pluginAppObj_02 .swiper-button-prev").css({"top": height/2});
    }

    function loadSwiper(){
    
        pluginAppObj_02Swiper = new Swiper4('#pluginAppObj_02 .swiper-container.main', {
        freeMode:            false,
        speed:               1000,
        loop:                true,
        loopPreventsSliding: true,
        direction:           'horizontal',
        roundLengths:        true,
        a11y: {
            enabled: true,
            prevSlideMessage: "Précédent",
            nextSlideMessage: "Suivant",
            paginationBulletMessage: "CLIQUEZ POUR LA DIAPOSITIVE {{index}}",
        },
        on: {
            slideChangeTransitionEnd: function () {
                let currentSlideEl = this.slides[this.realIndex];
                currentSlideEl.setAttribute("tabindex", "-1"); // make the element focusable only by calling focus() function
                
                
            },
        },
        navigation: {
 nextEl: '#pluginAppObj_02 .swiper-button-next',
 prevEl: '#pluginAppObj_02 .swiper-button-prev',
},
pagination: {
 clickable: true,
 el: '#pluginAppObj_02 .swiper-pagination',
 type: 'bullets',
},
 autoplay: {
 delay: 3000,
 disableOnInteraction: false,
},
 effect: 'stack',
 
        });
    }

}