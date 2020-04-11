<?php
session_start();
header('content-type:text/html;charset=utf-8;'); 
include '../Public/conn/conn.php';
//if(isset($_POST['submit'])){
    $fdname  = trim( $_POST['fdname']);
    $fdphone = trim($_POST['fdphone']);
    $user_id = $_SESSION['id'];
    //查询朋友表中是否存在这个人
    $result  = mysql_query("select * from friend where fdname='$fdname' and fdphone='$fdphone'");
    if($row=mysql_fetch_array($result)){
        //echo "已存在好友";
        $friendID = $row['fdid'];//查询到的好友ID
        //查询登录用户的好友列表
        $result1 = mysql_query("select friends from users where id='$user_id'");
        if($row1=mysql_fetch_array($result1)){
            $friends = $row1['friends']; 
            $fd_arr = explode(',',$friends); 
            if(in_array($friendID,$fd_arr)){//查询用户好友列表是否有这个人
                // echo "别调皮";
                echo json_encode(array('status'=>'0','msg'=>'别调皮'));
                exit;
            }else{//查询到没有此人则添加
                $friends=ltrim($friends.",".$friendID,",");                                 
                $result2 = mysql_query("update users set friends='$friends' where id='$user_id'");
                // echo "<br>好友来来啦";
                echo json_encode(array('status'=>'1','msg'=>'添加联系人成功'));
            }
        }
    }
    //如果朋友列表没有此人则添加
    else{
        $result3 = mysql_query("INSERT INTO friend (fdname,fdphone) VALUES('$fdname','$fdphone')"); 
        if($result3){
           // echo "添加成功";
            $info = mysql_query("select *from friend where fdname='$fdname' and fdphone='$fdphone'");
            $friendID = " ";
            if($rs=mysql_fetch_array($info)){
                $friendID=$rs['fdid'];
            }
            $result4 = mysql_query("select friends from users where id='$user_id'");
            if($info1=mysql_fetch_array($result4)){
                $friends = $info1['friends'];
                $fd_arr  = explode(',',$friends);
                if(in_array($friendID,$fd_arr)){//查询用户表里是否添加了该人
                    //echo "别调皮了好不不";
                    echo json_encode(array('status'=>'2','msg'=>'别调皮，已经添加该联系人了'));
                }else{
                    $friends=ltrim($friends.",".$friendID,",");                                 
                    $result5 = mysql_query("update users set friends='$friends' where id='$user_id'");
                    echo json_encode(array('status'=>'3','msg'=>'成功添加联系人'));                    
                }
            }
        }else{
            echo "语法错误";
        }
    }
//}