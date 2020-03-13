$(document).ready(function () {
    $('.floatDiv2X').click(function(){
        $('.floatDiv2M').hide();
    });
});
;
;
$(document).ready(function () {
    $('#menuLeft').BootSideMenu({
        side: "left",
        pushBody: false,
        theme: "dracula",
        closeOnClick: false,
        width: '250px',
        autoClose: true,
    });
    $('#btnOpen').click(function () {
        $('#menuLeft').BootSideMenu.open();
    });

    $('#btnClose').click(function () {
        $('#menuLeft').BootSideMenu.close();
    });
    $('#btnToggle').click(function () {
        $('#menuLeft').BootSideMenu.toggle();
    });
    $('#menuLeft').BootSideMenu.close();
});
;
$(document).ready(function() {
   $("#myCarousel").swiperight(function() {
      $(this).carousel('prev');
    });
   $("#myCarousel").swipeleft(function() {
      $(this).carousel('next');
   });
});;
var call_count = 0;
$(window).bind('scroll', function () {
    if ($(window).scrollTop() >= $('.front_counters_in').offset().top + $('.front_counters_in').outerHeight() - window.innerHeight) {

        if (call_count == 0) {
            call_count = 1;
            jQuery({Counter: 0}).animate({Counter: $('.front_counters_1_c1').text()}, {
                duration: 5000,
                easing: 'swing',
                step: function () {
                    $('.front_counters_1_c1').text(Math.ceil(this.Counter));
                }
            });
            jQuery({Counter: 0}).animate({Counter: $('.front_counters_1_c2').text()}, {
                duration: 5000,
                easing: 'swing',
                step: function () {
                    $('.front_counters_1_c2').text(Math.ceil(this.Counter));
                }
            });
            jQuery({Counter: 0}).animate({Counter: $('.front_counters_1_c3').text()}, {
                duration: 5000,
                easing: 'swing',
                step: function () {
                    $('.front_counters_1_c3').text(Math.ceil(this.Counter));
                }
            });
            jQuery({Counter: 0}).animate({Counter: $('.front_counters_1_c4').text()}, {
                duration: 5000,
                easing: 'swing',
                step: function () {
                    $('.front_counters_1_c4').text(Math.ceil(this.Counter));
                }
            });
            jQuery({Counter: 0}).animate({Counter: $('.front_counters_1_c5').text()}, {
                duration: 5000,
                easing: 'swing',
                step: function () {
                    $('.front_counters_1_c5').text(Math.ceil(this.Counter));
                }
            });
            jQuery({Counter: 0}).animate({Counter: $('.front_counters_1_c6').text()}, {
                duration: 5000,
                easing: 'swing',
                step: function () {
                    $('.front_counters_1_c6').text(Math.ceil(this.Counter));
                }
            });
        }
    }
});;
$(document).ready(function () {
//    $(".newsItemS").cycle({
//        fx: 'fade', //'zoom,scrollUp,shuffle,scrollUp,curtainX,turnDown',
//        timeout: 50000,
//        pager: '.newsItemSPager',
//        pagerEvent: 'mouseover',
//        pauseOnPagerHover: true
//    });
    
    
    
    $('.front_2F .owl-carousel').owlCarousel({
        loop: true,
        rtl: true,
        margin: 10,
        responsiveClass: true,
        freeDrag: true,
        autoplay: true,
        nav: true,
        smartSpeed : 250,
        navSpeed : 500,
        dotsSpeed : 500,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            960: {
                items: 1
            },
            1200: {
                items: 1
            }
        }
    });
});;
var current = 0;
function updateTabs() {
    $(".front_3_tab").each(function (index) {
        if ($(this).attr('tid') == current)
            $(this).addClass('front_3_tabH');
        else
            $(this).removeClass('front_3_tabH');
    });

    $(".front_3_1").each(function (index) {
        if ($(this).hasClass('front_3_1_' + current)) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });

}

$(document).ready(function () {



    $('.owl-carousel-projects').owlCarousel({
        loop: true,
        rtl: true,
        margin: 50,
        responsiveClass: true,
        autoplay: true,
        nav: true,
        smartSpeed: 250,
        navSpeed: 500,
        dotsSpeed: 500,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            960: {
                items: 3
            },
            1200: {
                items: 3
            }
        }
    });





    $(".front_3_tab").click(function () {
        current = $(this).attr('tid');
        updateTabs();
    });
    updateTabs();





});;
$(document).ready(function () {
    $('.owl-carousel-emoploy').owlCarousel({
        loop: true,
        rtl: true,
        margin: 50,
        responsiveClass: true,
        autoplay: true,
        nav: true,
        smartSpeed: 250,
        navSpeed: 500,
        dotsSpeed: 500,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            960: {
                items: 1
            },
            1200: {
                items: 1
            }
        }
    });

});;
$(document).ready(function () {
    $('.owl-carousel-partners').owlCarousel({
        loop: true,
        rtl: true,
        margin: 50,
        responsiveClass: true,
        autoplay: true,
        nav: true,
        smartSpeed: 250,
        navSpeed: 500,
        dotsSpeed: 500,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            960: {
                items: 4
            },
            1200: {
                items: 5
            }
        }
    });

});;
function validateEmail(id)
{
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,4}$/;
    return emailPattern.test(id);
}
function add_email() {
    var keyword = '';
    keyword = $(".mailInput").val();
    if (keyword != '' && validateEmail(keyword)) {
        $(".mailInput").val('');

        $.ajax({
            url: js_path + 'maillist',
            type: "POST",
            data: "contact=" + keyword,
            success: function (msg) {
                if (msg == 2) {
                    alert('البريد مسجل لدينا مسبقا.');
                    $(".mailInput").val('');
                } else {
                    alert('تم الإشتراك شكرا لك .');
                    $(".mailInput").val('');
                }
            }
        });
    } else {
        alert('يرجى كتابة البريد بصيغة صحيحة');
    }
}



function IsNumeric(sText)
{
    var ValidChars = "0123456789.";
    var IsNumber = true;
    var Char;


    for (i = 0; i < sText.length && IsNumber == true; i++)
    {
        Char = sText.charAt(i);
        if (ValidChars.indexOf(Char) == -1)
        {
            IsNumber = false;
        }
    }
    return IsNumber;

}
function add_sms() {
    var keyword = '';
    keyword = $(".smsInput").val();
    if (keyword != '' && IsNumeric(keyword)) {
        $(".smsInput").val('');

        $.ajax({
            url: js_path + 'sms',
            type: "POST",
            data: "num=" + keyword,
            success: function (msg) {
                if (msg == 2) {
                    alert('رقم الجوال مسجل لدينا مسبقا.');
                    $(".smsInput").val('');
                } else {
                    alert('تم الإشتراك شكرا لك .');
                    $(".smsInput").val('');
                }
            }
        });
    } else {
        alert('يرجى كتابة رقم الجوال بصيغة صحيحة');
    }
}
$(document).ready(function () {
    $(".smsBn").click(function () {
        add_sms();
    });
    $('.smsInput').keypress(function (event) {
        if (event.which == 13) {
            add_sms();
        }
    });
    
    
     $(".mailBnNew").click(function () {
        add_email();
    });
    $('.mailInput').keypress(function (event) {
        if (event.which == 13) {
            add_email();
        }
    });
});;
