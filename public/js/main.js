$(document).ready(function() {
    $('a.fancybox').fancybox({
        padding: 3
    });

    $('input[name=phone]').mask("+7(999)999-99-99");

    new WOW().init();

    // $('.select').select2({
    //     minimumResultsForSearch: Infinity
    // });

    // $('#slider-voltage').ionRangeSlider({
    //     grid: true,
    //     min: 5,
    //     max: 12,
    //     from: 9,
    //     step: 1,
    //     prettify_enabled: false
    // });
    //
    // $('#slider-resistance').ionRangeSlider({
    //     grid: true,
    //     min: 1,
    //     max: 6,
    //     from: 3,
    //     step: 1,
    //     prettify_enabled: false
    // });

    // $('.owl-carousel.news').owlCarousel({
    //     margin: 10,
    //     loop: true,
    //     nav: true,
    //     autoplay: true,
    //     autoplayTimeout:5000,
    //     dots: false,
    //     responsive: {
    //         0: {
    //             items: 1
    //         },
    //         768: {
    //             items: 2
    //         },
    //         1000: {
    //             items: 3
    //         },
    //         1200: {
    //             items: 4
    //         },
    //     },
    //     // navText:[navButtonBlack1,navButtonBlack2]
    // });
    //
    // $('.owl-carousel.portfolio').owlCarousel({
    //     margin: 10,
    //     loop: true,
    //     nav: false,
    //     autoplay: true,
    //     autoplayTimeout:10000,
    //     dots: true,
    //     responsive: {
    //         0: {
    //             items: 1
    //         },
    //     },
    //     // navText:[navButtonBlack1,navButtonBlack2]
    // });
    //
    // $('.owl-carousel .owl-nav > button').focus(function () {
    //     $(this).blur();
    // });

    // Scroll menu
    // let uriParams = getQueryParams(window.location.search);
    // if (uriParams.scroll) gotoScroll(uriParams.scroll);

    window.menuScrollFlag = false;
    $('a[data-scroll], div[data-scroll]').click(function (e) {
        e.preventDefault();
        if (!window.menuScrollFlag) {
            gotoScroll($(this).attr('data-scroll'));
        }
    });

    // Scroll controls
    setTimeout(function () {
        windowScroll();
        fixingMainMenu($(window).scrollTop());
    }, 1000);

    if (window.scrollAnchor) {
        window.menuScrollFlag = true;
        gotoScroll(window.scrollAnchor);
    }

    bindMainButton();
    if (window.showMessage) $('#message-modal').modal('show');
});

const windowScroll = () => {
    let onTopButton = $('#on-top-button');

    $(window).scroll(function() {
        let windowScroll = $(window).scrollTop(),
            win = $(this);

        fixingMainMenu(windowScroll);

        window.menuScrollFlag = true;
        $('.section').each(function () {
            let scrollData = $(this).attr('data-scroll-destination');
            if (!win.scrollTop()) {
                resetColorHrefsMenu();
                window.menuScrollFlag = false;
            } else if ($(this).offset().top <= win.scrollTop()+200 && scrollData) {
                window.menuScrollFlag = false;
                resetColorHrefsMenu();
                $('a[data-scroll=' + scrollData + ']').parents('li.nav-item').addClass('active');
            }
        });

        if (windowScroll > $(window).height()) {
            onTopButton.fadeIn();
        } else onTopButton.fadeOut();
    });
}

const resetColorHrefsMenu = () => {
    $('li.nav-item').removeClass('active').blur();
}

const gotoScroll = (scroll) => {
    $('html,body').animate({
        scrollTop: $('div[data-scroll-destination="' + scroll + '"]').offset().top - 51
    }, 1500, 'easeInOutQuint');
}

const fixingMainMenu = (windowScroll) => {
    let mainMenu = $('#main-nav');

    if (windowScroll > 55 && !parseInt(mainMenu.css('top')) && $(window).width() > 992) {
        mainMenu.addClass('top-fix').animate({'top':0}, 'slow');
    } else mainMenu.removeClass('top-fix');
}

const bindMainButton = () => {
    const mainButton = $('#main-button');
    mainButton.unbind();
    if (window.guest) {
        const loginModal = $('#login-modal');

        // Click to register href
        $('#register-href').click(function (e) {
            e.preventDefault();
            loginModal.modal('hide');
            $('#register-modal').modal('show');
        });

        // Click to restore password href
        $('#forgot-password-href').click(function (e) {
            e.preventDefault();
            loginModal.modal('hide');
            $('#reset-password-modal').modal('show');
        });

        mainButton.click(() => {
            loginModal.modal('show');
        });
    } else {
        const accountModal = $('#account-modal');
        if (!accountModal.find('input[name=email]').html()) {
            $.get(
                window.accountUrl
            ).done((data) => {
                $.each(data, function (field, value) {
                    accountModal.find('input[name='+ field +']').val(value);
                });
            });
        }
        mainButton.click(() => {
            accountModal.modal('show');
        });
    }
}

// const getQueryParams = (qs) => {
//     qs = qs.split('+').join(' ');
//     let params = {},
//         tokens,
//         re = /[?&]?([^=]+)=([^&]*)/g;
//     while (tokens = re.exec(qs)) {
//         params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
//     }
//     return params;
// }
