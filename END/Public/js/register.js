// JavaScript Document

/*通过ID获取HTML对象的通用方法，使用$代替函数名称*/
function $(elementId){
    return document.getElementById(elementId);
    }
    
/*当鼠标放在用户名文本框时，提示文本及样式*/    
function userNameFocus(){
    var userNameId=$("userNameId");
    userNameId.className="import_prompt";
    userNameId.innerHTML="由字母、数字组成，且长度为4-18";
    }
    
/*当鼠标离开用户名文本框时，提示文本及样式*/    
function userNameBlur(){
    var userName=$("userName");
    var userNameId=$("userNameId");
    var reg=/^[0-9a-zA-Z][0-9a-zA-Z]{2,16}[0-9a-zA-Z]$/;
    if(userName.value==""){
        $("userName").style.borderColor="red";  	
        userNameId.className="error_prompt";
        userNameId.innerHTML="用户名不能为空";
        return false;
        }
    if(reg.test(userName.value)==false){
    	$("userName").style.borderColor="red"; 
        userNameId.className="error_prompt";
        userNameId.innerHTML="由字母、数字组成，且长度为4-18";       	
        return false;
        }
        $("userName").style.borderColor="green";  	
        userNameId.className="ok_prompt";
		userNameId.innerHTML="";
        return true;
    }

/*当鼠标放在密码文本框时，提示文本及样式*/    
function pwdFocus(){
    var pwdId=$("pwdId");
    pwdId.className="import_prompt";
    pwdId.innerHTML="密码长度为6-16";
    }
    
/*当鼠标离开密码文本框时，提示文本及样式*/    
function pwdBlur(){
    var pwd=$("pwd");
    var pwdId=$("pwdId");
    if(pwd.value==""){
        $("pwd").style.borderColor="red";  	    	
        pwdId.className="error_prompt";
        pwdId.innerHTML="密码不能为空，请输入密码";
        return false;
        }
    if(pwd.value.length<6 || pwd.value.length>16){
        $("pwd").style.borderColor="red";  	    	
        pwdId.className="error_prompt";
        pwdId.innerHTML="密码长度为6-16";
        return false;
        }
        $("pwd").style.borderColor="green";      	
        pwdId.className="ok_prompt";
		pwdId.innerHTML="";
        return true;
    }

    
/*当鼠标离开确认密码文本框时，提示文本及样式*/    
function repwdBlur(){
    var repwd=$("repwd");
    var pwd=$("pwd");
    var repwdId=$("repwdId");
    if(repwd.value==""){
        $("repwd").style.borderColor="red";  	    	
        repwdId.className="error_prompt";
        repwdId.innerHTML="确认密码不能为空";
        return false;
        }
    if(repwd.value!=pwd.value){
        $("repwd").style.borderColor="red";  	    	
        repwdId.className="error_prompt";
        repwdId.innerHTML="两次输入的密码不一致，请重新输入";
        return false;
        }
        $("repwd").style.borderColor="green";      	
        repwdId.className="ok_prompt";
		repwdId.innerHTML="";
        return true;
    }
    
/*当鼠标放在真实姓名文本框时，提示文本及样式*/    
function realNameFocus(){
    var realNameId=$("realNameId");
    realNameId.className="import_prompt";
    realNameId.innerHTML="只能由汉字组成";
    }

/*当鼠标离开真实姓名文本框时，提示文本及样式*/    
function realNameBlur(){
    var realName=$("realName");
    var realNameId=$("realNameId");
    var reg=/[\u4E00-\u9FA5]/;   // 匹配昵称
    if(realName.value==""){
        $("realName").style.borderColor="red";  	
        realNameId.className="error_prompt";
        realNameId.innerHTML="真实姓名不能为空，请输入真实姓名";
        return false;
        }
    if(reg.test(realName.value)==false){
        $("realName").style.borderColor="red";  	
        realNameId.className="error_prompt";
        realNameId.innerHTML="只能由汉字组成";
        return false;
        } 
        $("realName").style.borderColor="green";      	
        realNameId.className="ok_prompt";
        realNameId.innerHTML="";
        return true;
    }


/*当鼠标放在关联手机号文本框时，提示文本及样式*/    
function telFocus(){
    var telId=$("telId");
    telId.className="import_prompt";
    telId.innerHTML="1.手机号长度11位，以13/14/15/16/17/18/19开头<br/>2、仅支持中国大陆";
    }
    
/*当鼠标离开手机号文本框时，提示文本及样式*/    
function telBlur(){
    var tel=$("tel");
    var telId=$("telId");
    var reg=/^1[3456789]\d{9}$/;
    if(tel.value==""){
        $("tel").style.borderColor="red";  	
        telId.className="error_prompt";
        telId.innerHTML="手机号码不能为空";
        return false;
        }
    if(reg.test(tel.value)==false){
        $("tel").style.borderColor="red";  	
        telId.className="error_prompt";
        telId.innerHTML="手机号码输入不正确，请重新输入";
        return false;
        }
        $("tel").style.borderColor="green";      	
        telId.className="ok_prompt";
		telId.innerHTML="";
        return true;
    }    


/*当鼠标放在邮箱地址文本框时，提示文本及样式*/    
function emailFocus(){
    var emailId=$("emailId");
    emailId.className="import_prompt";
    emailId.innerHTML="请输入您常用的电子邮箱";
    }
    
/*当鼠标离开邮箱地址文本框时，提示文本及样式*/    
function emailBlur(){
    var email=$("email");
    var emailId=$("emailId");
    var reg=/^\w+@\w+(\.[a-zA-Z]{2,3}){1,2}$/;
    if(email.value==""){
        $("email").style.borderColor="red";  	
        emailId.className="error_prompt";
        emailId.innerHTML="邮箱地址不能为空";
        return false;
        }
    if(reg.test(email.value)==false){
        $("email").style.borderColor="red";      	
        emailId.className="error_prompt";	
        emailId.innerHTML="邮箱地址格式不正确，请重新输入";
        return false;
        }
        $("email").style.borderColor="green";      	
        emailId.className="ok_prompt";
		emailId.innerHTML="";
        return true;
    }    

/*表单提交时验证表单内容输入的有效性*/
function checkForm(){
      var flagUserName=userNameBlur();
      var flagPwd=pwdBlur();
      var flagRepwd=repwdBlur();
      var flagRealName=realNameBlur();
      var flagTel=telBlur();
      var flagEmail=emailBlur();
      
      userNameBlur();
      pwdBlur();
      repwdBlur();
      realNameBlur();
      telBlur();
      emailBlur();
      
      if(flagUserName==true &&flagPwd==true &&flagRepwd==true &&flagRealName==true&&flagTel==true&flagEmail==true){
          return true;
          }
        else{
            return false;
            }
    
    }