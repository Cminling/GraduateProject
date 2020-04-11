$(function () {
    /* $('#btnSendCode').click(function(){
            var phone = $('#tel_num').val();
            $.ajax('/END/mdfPWsdk2.php', {data: {phone: phone}}).then(function(json) {
                console.log(json)
            })                
        });*/

    //验证码倒计时 
    var InterValObj; //timer变量，控制时间 
    var count = 30; //间隔函数，1秒执行 
    var curCount;//当前剩余秒数 
    $('.code-btn').click(function () {
        var rname = $('.j-rname').val();
        var phone = $.trim($(".j-telphone").val());//手机号码 
        var isMobile = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
        if ((phone != "" && isMobile.test(phone) && phone.length == 11)&&rname!=""){
            rmFocus('.j-telphone');
            $('.tel-msg').html('');
                //手机号码是否存在
                $.ajax({
                    url: "/END/Modify/checkTel.php",
                    type: "post",
                    dataType: "json",
                    data: {
                        rname: rname,
                        phones: phone,
                    },
                    success: function (data) {
                        if (data.flag == 0) {
                            $('.tel-msg').html(data.errorInfo);
                            Focus('.j-telphone');
                            return false;
                        } else {
                            $('.tel-msg').empty();
                            rmFocus('.j-telphone');
                            //alert(111);
                            curCount = count;
                            //设置button效果，开始计时 
                            $("#btnSendCode").attr("disabled", "true");
                            $("#btnSendCode").val(curCount + "  秒后重新获取");
                            $("#btnSendCode").css("background-color","#716d6c");
                            InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次 
                            debugger;
                            $.ajax({
                                url: '/END/Modify/mdfPWsdk.php',
                                type: 'post',
                                data: {phone:phone},
                                dataType: 'json'
                            }).then(function() {
                                //debugger;
                                alert("验证码已经发送到您的手机上");
                            }, function() {
                                //debugger
                            });
                        }
                    },
                });
        } else {
                $('.tel-msg').text('请输入有效的手机号码和真实姓名');
                Focus('.j-telphone');
            }
    });
    //timer处理函数 
    function SetRemainTime() {
        if (curCount == 0) {
            window.clearInterval(InterValObj);//停止计时器 
            $("#btnSendCode").removeAttr("disabled");//启用按钮 
            $("#btnSendCode").val("重新发送验证码");
        }
        else {
            curCount--;
            $("#btnSendCode").val(curCount + " 秒后重新获取验证码");
        }
    }
    function Focus(msg) {
        $(msg).css({ "border": "2px solid rgb(255,68,34)", "box-shadow": "0 0 6px 3px rgb(255,0,0,0.7)" }).focus();
    }
    function rmFocus(rmmsg){
        $(rmmsg).css({ 'border': '', 'box-shadow': '' });
    }
    $('#modify').click(function () {
        var code = $.trim($("#vrify1").val());
        var password = $('#password').val();
        var repassword = $('#repassword').val();

        if(password==''||repassword==''){
            alert('密码不能为空');
            $('#password').val("").focus();
        }
        else if (password != repassword) {
            alert('两次密码不一样');
            $('#password').val("").focus();
            $('#repassword').val("");
        } else {
            $.ajax({
                url: './Modify/checkCode.php',
                type: 'post',
                data: { 
                    rname: $('.j-rname').val(),
                    code: code,
                    password: password,
                    phone: $.trim($(".j-telphone").val())
                },
                dataType: 'json',
                success: function (xhr) {
                    if (xhr.status == 1) {
                        $(this).parents('form').submit(); //验证码正确提交表单
                        alert('修改成功,重新登录');
                        window.location.href="../login.html";
                    } else if(xhr.status ==0){
                        alert('验证码错误');
                        return false;
                    }else{
                        alert('不存在该用户');
                    }
                }
            });
        
        }
        return false;
    });
});