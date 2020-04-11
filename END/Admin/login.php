
<?php
  session_start();
  header('content-type:text/html;charset=utf-8;'); 
  include '../Public/conn/conn.php';
  
  if(isset($_POST['login'])){
      $admin_name=$_POST['admin_name'];
      $admin_pwd=md5($_POST['admin_pwd']);
      //$chkCode=$_POST['chkCode'];
      $sql="select * from admin where admin_name='$admin_name' and admin_pwd='$admin_pwd'";
      $result=mysql_query($sql);
      if($rows=mysql_fetch_array($result)){
   
        $_SESSION['admin_name'] = $admin_name;
        $_SESSION['admin_rname'] = $rows['rname'];
        echo "<script>location.href='./MGuser.php'</script>";
      }else{
        echo "<script>alert('用户名或密码错误！！');location.href='login.html'</script>"; 
       //echo $admin_pwd;    
      }
    
  }
?>