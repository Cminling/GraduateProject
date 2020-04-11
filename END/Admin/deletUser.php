<?php
   include '../Public/conn/conn.php';        
   $id=$_POST['id'];
   $sql="delete from users where id={$id}";

   $rs=mysql_query($sql);
    echo json_encode(array('state'=>1,'msg'=>'删除成功！重新刷新页面:)'));

	
?>
