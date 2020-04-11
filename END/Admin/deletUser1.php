<?php
   include '../Public/conn/conn.php';
        
   if(isset($_GET['del'])){       //批量删除
   $ids=$_GET['del'];
   $ids=implode(",", $ids);   //implode函数 把数组元素组合为一个字符串。
   $sql="delete from users where id in ($ids)";

   $rs=mysql_query($sql);
        echo "<script>alert('删除成功');window.location='showuser.php';</script>";//header("location:search.php");
//      echo json_encode(array('msg'=>'删除成功！重新刷新页面:)'));
    }
	
?>
