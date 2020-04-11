<?php 
  require_once "../Public/sms/SmsSender.php";
  
  use Qcloud\Sms\SmsSingleSender;
  use Qcloud\Sms\SmsMultiSender;
  use Qcloud\Sms\SmsVoicePromtSender;
  use Qcloud\Sms\SmsVoiceVeriryCodeSender;

  date_default_timezone_set('PRC'); //设置中国时区
  include '../Public/conn/conn.php';
  if(isset($_POST['send'])){
      $rName=$_SESSION['realName'];
      $msgtype=$_POST['select'];
      $ToPhone=$_POST['ToPhone'];
      $time=$_POST['time'];
      $place=$_POST['place'];
      $something=$_POST['something'];
      $FromPhone=$_POST['FromPhone'];
      $password=md5($_POST['password']);
      $datetime=date('Y-m-d H:i:s');
      $Strphones=$_POST['ToPhone'];
      $phone=explode(",",$Strphones);
      $note="";
      if(($password==$_SESSION['passWord'])&&($FromPhone==$_SESSION['fromPhone'])){
        mysql_set_charset('utf-8');
        
        try {
          // 请根据实际 appid 和 appkey 进行开发，以下只作为演示 sdk 使用
          // appid,appkey,templId申请方式可参考接入指南 https://www.qcloud.com/document/product/382/3785#5-.E7.9F.AD.E4.BF.A1.E5.86.85.E5.AE.B9.E9.85.8D.E7.BD.AE
          $appid = 1400053688;
          $appkey = "19131947a10b91430c6a5f82dab6bea3";
          $templIdA = 63984;  //会议模板
          $templIdB = 63988;  //活动模板	  
          
        
        // 普通群发
            $multiSender = new SmsMultiSender($appid, $appkey);
            if($msgtype=='会议通知'){
              // 指定模板群发，模板参数沿用上文的模板 id 和 $params            
              $params = array($time, $place, $something);
              $result = $multiSender->sendWithParam("86", $phone, $templIdA, $params, "", "", "");

              $note="【培正快信系统】各位同学大家好，我们将于".$time."在".$place."进行".$something."会议，请同学们准时出席会议，谢谢";

              $rsp = json_decode($result);
              echo $result;
              echo "<br>";      
            }else{
              
              $params = array($time,$place, $something);
              $result = $multiSender->sendWithParam("86", $phone, $templIdB, $params, "", "", "");

              $note="【培正快信系统】通知：将于".$time."在".$place."举行".$something."，欢迎同学们前来观看，谢谢";

              $rsp = json_decode($result);
              //echo $result;
              echo "<br>";           
            }
      
        } catch (Exception $e) {
            echo var_dump($e);
          }
        $sql="insert into note (realname,msgtype,tophone,note,formphone,datetime) values('$rName','$msgtype','$ToPhone','$note','$FromPhone','$datetime')";
        $result=mysql_query($sql);
        if($result==true){
          echo "<script>alert('发送成功！');';
          </script>";
        } else{
          echo "<script>alert('未知错误！');window.location.href='home.php';
          </script>";        
        }     
      }else if($FromPhone!=$_SESSION['fromPhone']){
        echo "<script>alert('注册的手机号不正确，请输入注册的手机号！');
          </script>";     
      }else if($password!=$_SESSION['passWord']){
          echo "<script>alert('注册密码输入错误，请输入正确的密码！');
          </script>";         
      } 

  }

  ?>