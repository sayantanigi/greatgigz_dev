"use strict";

/* -------------------------------------
 CUSTOM FUNCTION WRITE HERE
 -------------------------------------- */
$(document).ready(function () {
    // ---------- Banner Slider ---------- //
    $('#sleekslider').sleekslider({
        thumbs: ['thumnail-1.jpg', 'thumnail-2.jpg', 'thumnail-3.jpg'],
        labels: ['Slide 1', 'Slide 2', 'Slide 3'],
        speed: 4000
    });
    // ---------- Banner Slider ---------- //


    // ---------- DropDown On Hover ---------- //
    $('#nav-list-inner li.dropdown').on('hover', function () {
        $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(200);
    }, function () {
        $(this).find('.dropdown-menu').stop(true, true).delay(300).fadeOut(200);
    });
    // ---------- DropDown On Hover ---------- //


    // ---------- Navigation Toggle Function ---------- //
    $(".side-bar-btn").on('click',function () {
        $(".navigation").animate({
            width: "toggle"
        });
    });
    // ---------- Navigation Toggle Function ---------- //

   
    // ------- Menu ------- //
    Menu.init();
    // ------- Menu ------- //

    // ------- Select Dropdow ------- //
    (function () {
        [].slice.call(document.querySelectorAll('select.tg-select')).forEach(function (el) {
            new SelectFx(el);
        });
    })();
    // ------- Select Dropdow ------- //

    // ------- Team Slider ------- //
    $('#team-slider').owlCarousel({
        loop: true,
        margin: 30,
        nav: true,
        dots: false,
        smartSpeed: 200,
        responsiveClass: true,
        responsive: {
            0: {items: 1},
            320: {items: 1},
            480: {items: 2},
            640: {items: 2},
            768: {items: 2},
            800: {items: 2},
            960: {items: 3},
            1200: {items: 4}
        }
    });
    // ------- Team Slider ------- //

    // ------- Testimonial Slider ------- //
    $('#testimonial-slider').owlCarousel({
        loop: true,
        margin: 100,
        nav: false,
        center: true,
        dots: true,
        smartSpeed: 1000,
        responsiveClass: true,
        responsive: {
            0: {items: 1},
            320: {items: 1},
            480: {items: 1},
            640: {items: 3, margin: 30},
            768: {items: 3, margin: 30},
            800: {items: 3, margin: 30},
            991: {items: 3, margin: 30},
            1199: {items: 3, margin: 15},
            1200: {items: 3}
        }
    });
    // ------- Team Slider ------- //

    // ------- Team Slider ------- //
    $('#testimonial-slider-v2').owlCarousel({
        loop: true,
        margin: 100,
        nav: false,
        items: 1,
        center: true,
        dots: true,
        smartSpeed: 1000,
    });
    // ------- Team Slider ------- //

    // ------- Product Slider ------- //
    $('#product-slider-v3').owlCarousel({
        loop: true,
        margin: 30,
        nav: false,
        dots: true,
        responsive: {
            0: {items: 1},
            320: {items: 1},
            480: {items: 2},
            640: {items: 2},
            768: {items: 2},
            800: {items: 2},
            960: {items: 3},
            1000: {items: 4}
        }
    });
    // ------- Product Slider ------- //

    // ------- Blog Slider ------- //
    $('#blog-slider').owlCarousel({
        loop: true,
        margin: 30,
        dots: false,
        responsive: {
            0: {items: 1},
            320: {items: 1},
            480: {items: 1},
            640: {items: 2},
            768: {items: 2},
            800: {items: 2},
            991: {items: 2},
            1200: {items: 3}
        }
    });
    // ------- Blog Slider------- //

    // ------- Team Slider ------- //
    $('#work-Hours-list').owlCarousel({
        loop: false,
        margin: 10,
        nav: false,
        dots: false,
        responsiveClass: true,
        responsive: {
            0: {items: 1},
            320: {items: 2},
            480: {items: 3},
            768: {items: 4},
            800: {items: 5},
            960: {items: 6},
            1200: {items: 7}
        }
    });
    // ------- Team Slider ------- //

    // ------- Date Picker ------- //
    $('#booking-date input').datepicker({
        autoclose: true
    });

    $('#booking-date input').on('show', function (e) {
        console.debug('show', e.date, $(this).data('stickyDate'));

        if (e.date) {
            $(this).data('stickyDate', e.date);
        }
        else {
            $(this).data('stickyDate', null);
        }
    });

    $('#booking-date input').on('hide', function (e) {
        console.debug('hide', e.date, $(this).data('stickyDate'));
        var stickyDate = $(this).data('stickyDate');

        if (!e.date && stickyDate) {
            console.debug('restore stickyDate', stickyDate);
            $(this).datepicker('setDate', stickyDate);
            $(this).data('stickyDate', null);
        }
    });
    // ------- Date Picker ------- //

    // ------- Clock Picker ------- //
    $('#clockpicker').clockpicker({
        placement: 'top',
        align: 'left',
        donetext: 'Done'
    });
    // ------- Clock Picker ------- //

    // ------- Tg Acounter appear on reload ------- //
    try {
        $('#tg-counters').appear(function () {
            $('.tg-timer').countTo();
        });
    } catch (err) {
    }
    // ------- Tg Acounter appear on reload ------- //

    // ------- Prety Photo ------- //
    $("a[data-rel]").each(function () {
        $(this).attr("rel", $(this).data("rel"));
    });
    $("a[data-rel^='prettyPhoto']").prettyPhoto({
        animation_speed: 'normal',
        theme: 'dark_square',
        slideshow: 3000,
        autoplay_slideshow: false,
        social_tools: false
    });
    // ------- Prety Photo ------- //

    // ------- Mesonary ------- //
    var $container = $('#filter-masonry');
    var $optionSets = $('.option-set');
    var $optionLinks = $optionSets.find('a');
    function doIsotopeFilter() {
        if ($().isotope) {
            var isotopeFilter = '';
            $optionLinks.each(function () {
                var selector = $(this).attr('data-filter');
                var link = window.location.href;
                var firstIndex = link.indexOf('filter=');
                if (firstIndex > 0) {
                    var id = link.substring(firstIndex + 7, link.length);
                    if ('.' + id == selector) {
                        isotopeFilter = '.' + id;
                    }
                }
            });
            $container.isotope({
                itemSelector: '.masonry-grid',
                filter: isotopeFilter
            });
            $optionLinks.each(function () {
                var $this = $(this);
                var selector = $this.attr('data-filter');
                if (selector == isotopeFilter) {
                    if (!$this.hasClass('selected')) {
                        var $optionSet = $this.parents('.option-set');
                        $optionSet.find('.selected').removeClass('selected');
                        $this.addClass('selected');
                    }
                }
            });
            $optionLinks.on('click', function () {
                var $this = $(this);
                var selector = $this.attr('data-filter');
                $container.isotope({itemSelector: '.masonry-grid', filter: selector});
                if (!$this.hasClass('selected')) {
                    var $optionSet = $this.parents('.option-set');
                    $optionSet.find('.selected').removeClass('selected');
                    $this.addClass('selected');
                }
                return false;
            });
        }
    }
    var isotopeTimer = window.setTimeout(function () {
        window.clearTimeout(isotopeTimer);
        doIsotopeFilter();
    }, 1000);


    // ------- Mesonary ------- // 

    // ------- Contact Map ------- // 
    $("#map1").gmap3({
        marker: {
            values: [
                {address: "66000 Perpignan, pakistan", data: "Perpignan ! GO USAP !", options: {icon: "images/thum-marker.png"}}
            ],
        },
        map: {options: {zoom: 16}},
        scrollwheel: true,
        navigationControl: false,
        mapTypeControl: false,
        scaleControl: false,
        draggable: false

    });
   
});