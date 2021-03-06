(function ($) {
     setStickyNav();
     //setAnimation();
     initSmoothScrolling();
     initAOS();

    
    // If Element Exists function
     $.fn.exists = function(callback) {
       var args = [].slice.call(arguments, 1);
       if (this.length) {
         callback.call(this, args);
       }
       return this;
     };
     
     $('.My-Class').exists(function() {
       //it exists. Do something.
     });




    function setStickyNav() {
        var distance = $('#wrapper-navbar .navbar').offset().top;
        
        setHeaderStatus(distance);

        $(window).scroll(function () {
            setHeaderStatus(distance);
        });

        $(window).resize(function() {
            $('body').css('margin-top', $('#wrapper-navbar').height());
            $('.admin-bar').css('margin-top', $('#wrapper-navbar').height()-35);
        }).resize();
    }

    function setHeaderStatus(distance) {
        var top = $(window).scrollTop();
        top <= distance ? $('#wrapper-navbar .navbar').removeClass('active') : $('#wrapper-navbar .navbar').addClass('active');
    }



    function initFreehandAnimation() {
        setAnimation();

        $(window).scroll(function () {
            setAnimation();
        });
    }

    function setAnimation() {
        $('.animate').each((i, el) => {
            let element = $(el);
            if (isElementXPercentInViewport(element, 50)) {
                element.addClass('active');
            }
        });
    }

    function initAOS() {
        AOS.init({
            offset: 120, // offset (in px) from the original trigger point
            delay: 250, // values from 0 to 3000, with step 50ms
            duration: 1000, // values from 0 to 3000, with step 50ms
            easing: 'freehand-easing', // default easing for AOS animations
            once: false, // whether animation should happen only once - while scrolling down
            mirror: false, // whether elements should animate out while scrolling past them
            anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation
        });
    }
    
     //Add active class to navbar toggler for animation
    $('.navbar-toggler').click(function() {
        $(this).toggleClass('active');
    });

    // // Smooth Scrolling
    function initSmoothScrolling() {
        $('.navbar-nav a[href*="#"], .smooth-scroll').not('[href="#"]').not('[href="#0"]').click(function (event) {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');

                if (target.length) {
                    event.preventDefault();

                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000, function () {
                        var $target = $(target);
                        $target.focus();

                        if ($target.is(":focus")) {
                            return false;
                        } else {
                            $target.attr('tabindex', '-1');
                            $target.focus();
                        }
                    });
                }
            }
        });
    }

    /*
        How to tell if a DOM element is visible in the current viewport?
        http://stackoverflow.com/questions/123999/how-to-tell-if-a-dom-element-is-visible-in-the-current-viewport
    */
    function isElementXPercentInViewport(el, percentVisible) {
        if (typeof jQuery === "function" && el instanceof jQuery) {
            el = el[0];
        }

        let rect = el.getBoundingClientRect(), windowHeight = (window.innerHeight || document.documentElement.clientHeight);

        return !(
            Math.floor(100 - (((rect.top >= 0 ? 0 : rect.top) / +-(rect.height / 1)) * 100)) < percentVisible ||
            Math.floor(100 - ((rect.bottom - windowHeight) / rect.height) * 100) < percentVisible
        )
    };
})(jQuery);