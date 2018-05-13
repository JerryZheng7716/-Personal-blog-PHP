
jQuery(document).ready(function() {
    function isEmail(str){
        // language=JSRegexp
        var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
        return reg.test(str);
    }
    function isMobilePhone(str){
        var reg = /(^[0-9]{3,4}\-[0-9]{7,8}$)|(^[0-9]{7,8}$)|(^\([0-9]{3,4}\)[0-9]{3,8}$)|(^0{0,1}13[0-9]{9}$)/;
        return reg.test(str);
    }


    $('.page-container form').submit(function(){
        var username = $(this).find('.username').val();
        var password = $(this).find('.password').val();
        var verificationCode = $(this).find('.verificationCode').val();
        var rePassword = $(this).find('.rePassword').val();
        var email = $(this).find('.email').val();
        var tel = $(this).find('.tel').val();
        var verificationCode2 = $(this).find('.verificationCode2').val();
        if(username == '') {
            $(this).find('.error').fadeOut('fast', function(){
                $(this).css('top', '27px');
            });
            $(this).find('.error').fadeIn('fast', function(){
                $(this).parent().find('.username').focus();
            });
            return false;
        }
        if(password == '') {
            $(this).find('.error').fadeOut('fast', function(){
                $(this).css('top', '96px');
            });
            $(this).find('.error').fadeIn('fast', function(){
                $(this).parent().find('.password').focus();
            });
            return false;
        }

        if(rePassword == '') {
            $(this).find('.error').fadeOut('fast', function(){
                $(this).css('top', '165px');
            });
            $(this).find('.error').fadeIn('fast', function(){
                $(this).parent().find('.rePassword').focus();
            });
            return false;
        }
        if(rePassword != password) {
            document.getElementById('error2').innerHTML = 'X 密码不一致';
            $(this).find('.error2').fadeOut('fast', function(){
                $(this).css('top', '165px');
            });
            $(this).find('.error2').fadeIn('fast', function(){
                $(this).parent().find('.rePassword').focus();
            });
            return false;
        }
        if(verificationCode == '') {
            $(this).find('.error').fadeOut('fast', function(){
                $(this).css('top', '165px');
            });
            $(this).find('.error').fadeIn('fast', function(){
                $(this).parent().find('.verificationCode').focus();
            });
            return false;
        }

        if(email == '') {

            $(this).find('.error').fadeOut('fast', function(){
                $(this).css('top', '234px');
            });
            $(this).find('.error').fadeIn('fast', function(){
                $(this).parent().find('.email').focus();
            });
            return false;
        }
        if(!isEmail(email)) {
            document.getElementById('error2').innerHTML = 'X 邮箱格式有误';
            $(this).find('.error2').fadeOut('fast', function(){
                $(this).css('top', '234px');
            });
            $(this).find('.error2').fadeIn('fast', function(){
                $(this).parent().find('.email').focus();
            });
            return false;
        }
        if(tel == '') {
            $(this).find('.error').fadeOut('fast', function(){
                $(this).css('top', '303px');
            });
            $(this).find('.error').fadeIn('fast', function(){
                $(this).parent().find('.tel').focus();
            });
            return false;
        }
        if(!isMobilePhone(tel)) {
            document.getElementById('error2').innerHTML = 'X 电话号格式有误';
            $(this).find('.error2').fadeOut('fast', function(){
                $(this).css('top', '303px');
            });
            $(this).find('.error2').fadeIn('fast', function(){
                $(this).parent().find('.tel').focus();
            });
            return false;
        }
        if(verificationCode2 == '') {
            $(this).find('.error').fadeOut('fast', function(){
                $(this).css('top', '372px');
            });
            $(this).find('.error').fadeIn('fast', function(){
                $(this).parent().find('.verificationCode2').focus();
            });
            return false;
        }
    });

    $('.page-container form .username, .page-container form .password, .page-container form .verificationCode, .page-container form .verificationCode2, .page-container form .email, .page-container form .tel').keyup(function(){
        $(this).parent().find('.error').fadeOut('fast');
        $(this).parent().find('.error2').fadeOut('fast');
    });

});
