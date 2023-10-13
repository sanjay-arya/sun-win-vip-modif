$(document).ready(function () {
    // var nav = function () {
    //     $('.gw-nav > li > a').click(function () {
    //         var gw_nav = $('.gw-nav');
    //         gw_nav.find('li').removeClass('active');
    //         $('.gw-nav > li > ul > li').removeClass('active');
    //
    //         var checkElement = $(this).parent();
    //        console.log(checkElement);
    //         var ulDom = checkElement.find('.gw-submenu')[0];
    //
    //         if (ulDom == undefined) {
    //             checkElement.addClass('active');
    //             $('.gw-nav').find('li').find('ul:visible').slideUp();
    //             return;
    //         }
    //         if (ulDom.style.display != 'block') {
    //             gw_nav.find('li').find('ul:visible').slideUp();
    //             gw_nav.find('li.init-arrow-up').removeClass('init-arrow-up').addClass('arrow-down');
    //             gw_nav.find('li.arrow-up').removeClass('arrow-up').addClass('arrow-down');
    //             checkElement.removeClass('init-arrow-down');
    //             checkElement.removeClass('arrow-down');
    //             checkElement.addClass('arrow-up');
    //            checkElement.addClass('active');
    //             checkElement.find('ul').slideDown(300);
    //         } else {
    //             checkElement.removeClass('init-arrow-up');
    //             checkElement.removeClass('arrow-up');
    //             checkElement.removeClass('active');
    //             checkElement.addClass('arrow-down');
    //             checkElement.find('ul').slideUp(300);
    //
    //         }
    //     });
    //     $('.gw-nav > li > ul > li > a').click(function () {
    //         //var localtion = window.location.pathname;
    //         //var urlli= $(this).attr("href");
    //         //var gw_nav = $('.gw-nav');
    //         //if(localtion==urlli)
    //         //{
    //         //    gw_nav.find('li').find('ul:visible').slideUp();
    //         //    $('.gw-nav > li > ul > li').addClass('active');
    //         //    $(this).parent().removeClass('active')
    //         //}
    //
    //     });
    // };
    // nav();

    $(".sidebar-dropdown > a").click(function() {
        var checkElement=$(this).parent();
        $(".sidebar-dropdown > a").removeClass("active");
        console.log("sidebar-dropdown",checkElement);
        var submenu=checkElement.find(".sidebar-submenu")[0];
        $(".sidebar-dropdown").removeClass("active");
        if (submenu===undefined){
            checkElement.addClass("active");
            $(".sidebar-submenu").slideUp(200);
            return;
        }
        if (submenu.style.display!=='block'){
            checkElement.addClass("active");
            checkElement.find(".sidebar-submenu").slideDown(200);
        }else {
            checkElement.removeClass("active");
            checkElement.find(".sidebar-submenu").slideUp(200);
        }
        // if ($(this).parent().hasClass("active")) {
        //     $(this).parent().removeClass("active");
        // } else {
        //     $(".sidebar-dropdown").removeClass("active");
        //     $(this)
        //         .next(".sidebar-submenu")
        //         .slideDown(200);
        //     $(this).parent().addClass("active");
        //     console.log("sidebar-submenu2",$(this).parent());
        // }
    });

    $("#close-sidebar").click(function() {
        $(".page-wrapper").removeClass("toggled");
    });
    $("#show-sidebar").click(function() {
        $(".page-wrapper").addClass("toggled");
    });
});

