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
