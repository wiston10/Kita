/*-----------------------------------------------------------------

Template Name: KITA Schwanenaescht - Tagesbetreuung Website<
Author:  Gramentheme
Author URI: https://themeforest.net/user/gramentheme/portfolio
Version: 1.0.0
Description: KITA Schwanenaescht - Tagesbetreuung Website<

-------------------------------------------------------------------
CSS TABLE OF CONTENTS
-------------------------------------------------------------------

01. header
02. animated text with swiper slider
03. magnificPopup
04. counter up
05. wow animation
06. nice select
07. swiper slider
08. search popup
09. preloader 


------------------------------------------------------------------*/

(function($) {
    "use strict";

    function loadSharedComponents() {
        const componentNodes = document.querySelectorAll('[data-component]');

        if (!componentNodes.length) {
            return Promise.resolve();
        }

        const requests = Array.from(componentNodes).map(function(node) {
            const componentPath = node.getAttribute('data-component');

            return fetch(componentPath)
                .then(function(response) {
                    if (!response.ok) {
                        throw new Error('Failed to load ' + componentPath);
                    }

                    return response.text();
                })
                .then(function(markup) {
                    node.innerHTML = markup;
                })
                .catch(function(error) {
                    console.error(error);
                });
        });

        return Promise.all(requests);
    }

    function initializeSite() {

        //>> Mobile Menu Js Start <<//
        $('#mobile-menu').meanmenu({
            meanMenuContainer: '.mobile-menu',
            meanScreenWidth: "1199",
            meanExpand: ['<i class="far fa-plus"></i>'],
        });

        //>> Sidebar Toggle Js Start <<//
        $(".offcanvas__close,.offcanvas__overlay").on("click", function() {
            $(".offcanvas__info").removeClass("info-open");
            $(".offcanvas__overlay").removeClass("overlay-open");
        });
        $(".sidebar__toggle").on("click", function() {
            $(".offcanvas__info").addClass("info-open");
            $(".offcanvas__overlay").addClass("overlay-open");
        });

        //>> Body Overlay Js Start <<//
        $(".body-overlay").on("click", function() {
            $(".offcanvas__area").removeClass("offcanvas-opened");
            $(".df-search-area").removeClass("opened");;
            $(".body-overlay").removeClass("opened");
        });

        //>> Sticky Header Js Start <<//

        $(window).scroll(function() {
            if ($(this).scrollTop() > 250) {
                $("#header-sticky").addClass("sticky");
            } else {
                $("#header-sticky").removeClass("sticky");
            }
        });

        //>> Hero-3 Slider Start <<//
        const sliderActive1 = ".hero-slider";
        const sliderInit1 = new Swiper(sliderActive1, {
            loop: true,
            slidesPerView: 1,
            effect: "fade",
            speed: 2000,
            autoplay: {
            delay: 4000,
            disableOnInteraction: false,
            },
            pagination: {
                el: ".dot",
                clickable: true,
            },
            
        });
        // content animation when active start here
        function animated_swiper(selector, init) {
             let animated = function animated() {
                 $(selector + " [data-animation]").each(function () {
                     let anim = $(this).data("animation");
                     let delay = $(this).data("delay");
                     let duration = $(this).data("duration");
                     $(this)
                         .removeClass("anim" + anim)
                         .addClass(anim + " animated")
                         .css({
                             webkitAnimationDelay: delay,
                             animationDelay: delay,
                             webkitAnimationDuration: duration,
                             animationDuration: duration,
                         })
                         .one("animationend", function () {
                             $(this).removeClass(anim + " animated");
                         });
                 });
             };
             animated();
             init.on("slideChange", function () {
                 $(sliderActive1 + " [data-animation]").removeClass("animated");
             });
             init.on("slideChange", animated);
        }
        animated_swiper(sliderActive1, sliderInit1);

         if($('.hero-slider1').length > 0) {
        const heroSlider1 = new Swiper(".hero-slider1", {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            //Pagination
            pagination: {
                el: ".hero-dot",
                clickable: true,
            },

            speed: 500,
            breakpoints: {
                '1600': {
                    slidesPerView: 1,
                },
                '1200': {
                    slidesPerView: 1,
                },
                '992': {
                    slidesPerView: 1,
                },
                '768': {
                    slidesPerView: 1,
                },
                '576': {
                    slidesPerView: 1,
                },
                '0': {
                    slidesPerView: 1,
                },
            },
        });
    }

      /* ================================
      Hover Active Js Start
    ================================ */

    $(".activities-wrapper-items5, .values-list li, .counter-box-items5, .program-box-items-6 ").hover(
		// Function to run when the mouse enters the element
		function () {
			// Remove the "active" class from all elements
			$(".activities-wrapper-items5, .values-list li, .counter-box-items5, .program-box-items-6").removeClass("active");
			// Add the "active" class to the currently hovered element
			$(this).addClass("active");
		}
	);

     /* ================================
      Program Slider Js Start
    ================================ */
   if ($('.program-slider').length > 0) {
    const programSlider = new Swiper(".program-slider", {
        spaceBetween: 30,
        speed: 1300,
        loop: true,
        autoplay: {
            delay: 2000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".dot2",
            clickable: true,
        },
        breakpoints: {
            1399: {
                slidesPerView: 3,
            },
            1199: {
                slidesPerView: 2.5,
            },
            991: {
                slidesPerView: 2,
            },
            767: {
                slidesPerView: 1.5,
            },
            575: {
                slidesPerView: 1,
            },
            0: {
                slidesPerView: 1,
            },
        },
    });
   }

    if ($('.program-slider-7').length > 0) {
    const programSlider7 = new Swiper(".program-slider-7", {
        spaceBetween: 30,
        speed: 1300,
        loop: true,
        autoplay: {
            delay: 2000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".array-next",
            prevEl: ".array-prev",
        },
        breakpoints: {
            1399: {
                slidesPerView: 3,
            },
            1199: {
                slidesPerView: 2,
            },
            991: {
                slidesPerView: 2.6,
            },
            767: {
                slidesPerView: 2,
            },
            575: {
                slidesPerView: 1,
            },
            0: {
                slidesPerView: 1,
            },
        },
    });
   }

   if ($('.extra-activities-slider-6').length > 0) {
    const extraActivitiesSlider6 = new Swiper(".extra-activities-slider-6", {
        spaceBetween: 30,
        speed: 1300,
        loop: true,
        autoplay: {
            delay: 2000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".dot",
            clickable: true,
        },
        breakpoints: {
            991: {
                slidesPerView: 2,
            },
            767: {
                slidesPerView: 1.5,
            },
            575: {
                slidesPerView: 1.4,
            },
            0: {
                slidesPerView: 1,
            },
        },
    });
   }

        //>> Video Popup Start <<//
        $(".img-popup").magnificPopup({
            type: "image",
            gallery: {
                enabled: true,
            },
        });

        $('.video-popup').magnificPopup({
            type: 'iframe',
            callbacks: {
            }
        });
        
        //>> Counterup Start <<//
        $(".count").counterUp({
            delay: 15,
            time: 4000,
        });

          /* ================================
      Custom Accordion Js Start
    ================================ */

   if ($('.accordion-box').length) {
        $(".accordion-box").on('click', '.acc-btn', function () {
            var outerBox = $(this).closest('.accordion-box');
            var target = $(this).closest('.accordion');
            var accBtn = $(this);
            var accContent = accBtn.next('.acc-content');

            if (target.hasClass('active-block')) {
                // Already open, so close it
                accBtn.removeClass('active');
                target.removeClass('active-block');
                accContent.slideUp(300);
            } else {
                // Close all others
                outerBox.find('.accordion').removeClass('active-block');
                outerBox.find('.acc-btn').removeClass('active');
                outerBox.find('.acc-content').slideUp(300);

                // Open clicked one
                accBtn.addClass('active');
                target.addClass('active-block');
                accContent.slideDown(300);
            }
        });
    }

     const programSlider8 = new Swiper(".program-slider-8", {
            spaceBetween: 30,
            speed: 1300,
            loop: true,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".dot2",
                clickable: true,
            },

            breakpoints: {
                1199: {
                    slidesPerView: 4,
                },
                991: {
                    slidesPerView: 3,
                },
                767: {
                    slidesPerView: 2,
                },
                575: {
                    slidesPerView: 1,
                },
                0: {
                    slidesPerView: 1,
                },
            },
        });

    /* ================================
      Team Hover Js Start
    ================================ */

    if (document.querySelectorAll(".team-main-items").length) {

        const teamItems = document.querySelectorAll(".team-main-items");

        teamItems.forEach((item) => {
            item.addEventListener("mouseenter", function () {

                // remove active from all
                teamItems.forEach((el) => {
                    el.classList.remove("active");
                });

                // add active to hovered item
                this.classList.add("active");
            });
        });

    }

        //>> Wow Animation Start <<//
        new WOW().init();

        //>> Nice Select Start <<//
        if ($('.single-select').length) {
            $('.single-select').niceSelect();
        }


        //>> Team Slider Start <<//
        const teamSlider = new Swiper(".team-slider", {
            spaceBetween: 30,
            speed: 1300,
            loop: true,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".array-prev",
                prevEl: ".array-next",
            },
            pagination: {
                el: ".dot",
                clickable: true,
            },
            breakpoints: {
                1299: {
                    slidesPerView: 4,
                },
                1199: {
                    slidesPerView: 3,
                },
                767: {
                    slidesPerView: 2,
                },
                575: {
                    slidesPerView: 2,
                },
                0: {
                    slidesPerView: 1,
                },
            },
        });

        const teamSlider2 = new Swiper(".team-slider-2", {
            spaceBetween: 30,
            speed: 1500,
            loop: true,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".array-prev",
                prevEl: ".array-next",
            },
            breakpoints: {
                1199: {
                    slidesPerView: 3,
                },
                767: {
                    slidesPerView: 2,
                },
                575: {
                    slidesPerView: 1,
                },
                0: {
                    slidesPerView: 1,
                },
            },
        });

        if ($('.team-slider-5').length > 0) {
            const teamSlider5 = new Swiper(".team-slider-5", {
                spaceBetween: 30,
                speed: 1300,
                loop: true,
                autoplay: {
                    delay: 2000,
                    disableOnInteraction: false,
                },
            pagination: {
                    el: ".dotss",
                    clickable: true,
                },
                breakpoints: {
                    
                    1199: {
                        slidesPerView: 4,
                    },
                    991: {
                        slidesPerView: 3,
                    },
                    767: {
                        slidesPerView: 2,
                    },
                    575: {
                        slidesPerView: 1.4,
                    },
                    0: {
                        slidesPerView: 1,
                    },
                },
            });
        }

         if ($('.team-slider-7').length > 0) {
            const teamSlider3 = new Swiper(".team-slider-7", {
                spaceBetween: 30,
                speed: 1300,
                loop: true,
                autoplay: {
                    delay: 2000,
                    disableOnInteraction: false,
                },
            pagination: {
                    el: ".dot",
                    clickable: true,
                },
                breakpoints: {
                    1399: {
                        slidesPerView: 4,
                    },
                    1199: {
                        slidesPerView: 3,
                    },
                    991: {
                        slidesPerView: 2.5,
                    },
                    767: {
                        slidesPerView: 2,
                    },
                    575: {
                        slidesPerView: 1.4,
                    },
                    0: {
                        slidesPerView: 1,
                    },
                },
            });
            }

        //>> Testimonial Slider Start <<//
        const testimonialSlider = new Swiper(".testimonial-slider", {
            spaceBetween: 30,
            speed: 1500,
            loop: true,
            autoplay: {
                delay: 1000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".dot",
                clickable: true,
            },
            breakpoints: {
                1199: {
                    slidesPerView: 3,
                },
                767: {
                    slidesPerView: 2,
                },
                575: {
                    slidesPerView: 1,
                },
                0: {
                    slidesPerView: 1,
                },
            },
        });

        const testimonialSlider2 = new Swiper(".testimonial-slider-2", {
            spaceBetween: 30,
            speed: 1500,
            loop: true,
            autoplay: {
                delay: 1000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".array-prev",
                prevEl: ".array-next",
            },
        });

        const testimonialSlider3 = new Swiper(".testimonial-slider-3", {
            spaceBetween: 30,
            speed: 1500,
            loop: true,
            autoplay: {
                delay: 1000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".array-prev",
                prevEl: ".array-next",
            },
        });

        if ($('.testimonial-slider-5').length > 0) {
            const testimonialSlider5 = new Swiper(".testimonial-slider-5", {
                spaceBetween: 30,
                speed: 1300,
                loop: true,
                centeredSlides: true,
                autoplay: {
                    delay: 1500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".dot",
                    clickable: true,
                },
                breakpoints: {
                    1699: {
                        slidesPerView: 4,
                    },
                    1399: {
                        slidesPerView: 3.2,
                    },
                    1300: {
                        slidesPerView: 2.8,
                    },
                    1199: {
                        slidesPerView: 2.8,
                    },
                    991: {
                        slidesPerView: 3,
                    },
                    767: {
                        slidesPerView: 2.5,
                    },
                    575: {
                        slidesPerView: 1.8,
                    },
                    0: {
                        slidesPerView: 1.4,
                    },
                },
            });
        }

         if ($('.testimonial-slider-6').length > 0) {
            const testimonialSlider6 = new Swiper(".testimonial-slider-6", {
                spaceBetween: 30,
                speed: 1300,
                loop: true,
                autoplay: {
                    delay: 1500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".dot01",
                    clickable: true,
                },
                breakpoints: {
                    1399: {
                        slidesPerView: 4,
                    },
                    1199: {
                        slidesPerView: 3,
                    },
                    991: {
                        slidesPerView: 3,
                    },
                    767: {
                        slidesPerView: 2,
                    },
                    575: {
                        slidesPerView: 1.4,
                    },
                    0: {
                        slidesPerView: 1,
                    },
                },
            });
        }

        if ($('.testimonial-slider-7').length > 0) {
            const testimonialSlider7 = new Swiper(".testimonial-slider-7", {
                spaceBetween: 30,
                speed: 1300,
                loop: true,
                autoplay: {
                    delay: 1500,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: ".array-next",
                    prevEl: ".array-prev",
                },
                breakpoints: {
                    1399: {
                        slidesPerView: 3,
                    },
                    1199: {
                        slidesPerView: 3,
                    },
                    991: {
                        slidesPerView: 2,
                    },
                    767: {
                        slidesPerView: 1,
                    },
                    575: {
                        slidesPerView: 1,
                    },
                    0: {
                        slidesPerView: 1,
                    },
                },
            });
        }

        if ($('.news-slider-6').length > 0) {
            const newsSlider6 = new Swiper(".news-slider-6", {
                spaceBetween: 30,
                speed: 1300,
                loop: true,
                centeredSlides: true,
                autoplay: {
                    delay: 2000,
                    disableOnInteraction: false,
                },
            pagination: {
                    el: ".dot0",
                    clickable: true,
                },
                breakpoints: {
                    1399: {
                        slidesPerView: 4,
                    },
                    1199: {
                        slidesPerView: 3,
                    },
                    991: {
                        slidesPerView: 2.7,
                    },
                    767: {
                        slidesPerView: 2,
                    },
                    575: {
                        slidesPerView: 1.4,
                    },
                    0: {
                        slidesPerView: 1,
                    },
                },
            });
        }

         /* ================================
       Banner Active Js Start
    ================================ */

       if($('.banner-active').length > 0) {
            const bannerActive = new Swiper(".banner-active", {
                speed:1500,
                loop: true,
                slidesPerView: 1,
                effect:'fade',
                autoplay: {
                    delay: 3000,         
                    disableOnInteraction: false,
                    pauseOnMouseEnter: false,  
                },
                pagination: {
                    el: ".hero-dot",
                    clickable: true,
                },
            });
        }


        //>> Instagram Slider Start <<//
        const instagramBannerSlider = new Swiper(".instagram-banner-slider", {
            spaceBetween: 30,
            speed: 1500,
            loop: true,
            autoplay: {
                delay: 1000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".array-prev",
                prevEl: ".array-next",
            },
            breakpoints: {
                1399: {
                    slidesPerView: 6,
                },
                1199: {
                    slidesPerView: 5,
                },
                991: {
                    slidesPerView: 4,
                },
                767: {
                    slidesPerView: 3,
                },
                650: {
                    slidesPerView: 2,
                },
                575: {
                    slidesPerView: 1,
                },
                0: {
                    slidesPerView: 1,
                },
            },
        });

        //>> Brand Slider Start <<//
        const brandSlider = new Swiper(".brand-slider", {
            spaceBetween: 30,
            speed: 1300,
            loop: true,
            centeredSlides: true,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },

            breakpoints: {
                1199: {
                    slidesPerView: 5,
                },
                991: {
                    slidesPerView: 4,
                },
                767: {
                    slidesPerView: 3,
                },
                575: {
                    slidesPerView: 2,
                },
                0: {
                    slidesPerView: 1,
                },
            },
        });

        if ($('.brand-slider-5').length > 0) {
        const brandSlider5 = new Swiper(".brand-slider-5", {
            spaceBetween: 50,
            speed: 1300,
            loop: true,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".array-next",
                prevEl: ".array-prev",
            },
            breakpoints: {
                1399: {
                    slidesPerView: 7,
                },
                1199: {
                    slidesPerView: 5.5,
                },
                991: {
                    slidesPerView: 4.5,
                },
                767: {
                    slidesPerView: 3.3,
                },
                575: {
                    slidesPerView: 2,
                },
                0: {
                    slidesPerView: 1,
                },
            },
        });
    }

        //>> Certificate Slider Start <<//
        const certificateSlider = new Swiper(".certificate-slider", {
            spaceBetween: 30,
            speed: 1300,
            loop: true,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },

            breakpoints: {
                991: {
                    slidesPerView: 3,
                },
                767: {
                    slidesPerView: 2,
                },
                575: {
                    slidesPerView: 1,
                },
                0: {
                    slidesPerView: 1,
                },
            },
        });

        //>> Clases Slider Start <<//
        const clasesSlider = new Swiper(".clases-slider", {
            spaceBetween: 30,
            speed: 1300,
            loop: true,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".array-prev",
                prevEl: ".array-next",
            },
            pagination: {
                el: ".dot",
                clickable: true,
            },

            breakpoints: {
                1199: {
                    slidesPerView: 3,
                },
                991: {
                    slidesPerView: 2,
                },
                767: {
                    slidesPerView: 2,
                },
                575: {
                    slidesPerView: 1,
                },
                0: {
                    slidesPerView: 1,
                },
            },
        });

        //>> Event Slider Start <<//
        const eventSlider = new Swiper(".event-slider", {
            spaceBetween: 30,
            speed: 1300,
            loop: true,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".dot",
                clickable: true,
            },

            breakpoints: {
                1199: {
                    slidesPerView: 3,
                },
                991: {
                    slidesPerView: 2,
                },
                767: {
                    slidesPerView: 2,
                },
                575: {
                    slidesPerView: 1,
                },
                0: {
                    slidesPerView: 1,
                },
            },
        });

        //>> News Slider Start <<//
        const newsSlider = new Swiper(".news-slider", {
            spaceBetween: 30,
            speed: 1300,
            loop: true,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".dot",
                clickable: true,
            },

            breakpoints: {
                1199: {
                    slidesPerView: 3,
                },
                991: {
                    slidesPerView: 2,
                },
                767: {
                    slidesPerView: 2,
                },
                575: {
                    slidesPerView: 1,
                },
                0: {
                    slidesPerView: 1,
                },
            },
        });

        //>> Search Popup Start <<//
        const $searchWrap = $(".search-wrap");
        const $navSearch = $(".nav-search");
        const $searchClose = $("#search-close");

        $(".search-trigger").on("click", function (e) {
            e.preventDefault();
            $searchWrap.animate({ opacity: "toggle" }, 500);
            $navSearch.add($searchClose).addClass("open");
        });

        $(".search-close").on("click", function (e) {
            e.preventDefault();
            $searchWrap.animate({ opacity: "toggle" }, 500);
            $navSearch.add($searchClose).removeClass("open");
        });

        function closeSearch() {
            $searchWrap.fadeOut(200);
            $navSearch.add($searchClose).removeClass("open");
        }

        $(document.body).on("click", function (e) {
            closeSearch();
        });

        $(".search-trigger, .main-search-input").on("click", function (e) {
            e.stopPropagation();
        });


    } // End Site Initialization Function

    $(document).ready(function() {
        loadSharedComponents().finally(function() {
            initializeSite();
        });
    });

    function loader() {
        $(window).on('load', function() {
            // Animate loader off screen
            $(".preloader").addClass('loaded');                    
            $(".preloader").delay(600).fadeOut();                       
        });
    }

    loader();
   

})(jQuery); // End jQuery



    // Home gallery carousel
    if ($('.home-gallery-slider').length) {
        const homeGallery = new Swiper('.home-gallery-slider', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            speed: 900,
            autoplay: {
                delay: 2800,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.home-gallery-dots',
                clickable: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                    spaceBetween: 24,
                },
                1200: {
                    slidesPerView: 3,
                    spaceBetween: 26,
                }
            }
        });
    }
