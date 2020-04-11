<?PHP
//引入PHPMailer的核心文件 使用require_once包含避免出现PHPMailer类重复定义的警告
require_once "PHPMailer/class.phpmailer.php";
session_start();  
header("Content-type:text/html;charset=utf8");
//示例化PHPMailer核心类

if(isset($_POST['send'])){
    $receiver=$_POST['receiver'];
    $title=$_POST['title'];
    $content=$_POST['content'];  
    $fromMail=$_POST['fromMail']; 
    $fromName=$_SESSION['realName'];
    $mail = new PHPMailer();
    
    //取文件信息
$arr = $_FILES["attach"];
//var_dump($arr);
//加限制条件
//1.文件类型
//2.文件大小
//3.保存的文件名不重复
if(($arr["type"]=="image/jpeg" || $arr["type"]=="image/png" ) && $arr["size"]<10241000 )
{
date_default_timezone_set('PRC');
//临时文件的路径
$arr["tmp_name"];
//上传的文件存放的位置
//避免文件重复:
//1.加时间戳.time()加用户名.$uid或者加.date('YmdHis')
//2.类似网盘，使用文件夹来防止重复
$filename = "./uploads/".date('YmdHis').$arr["name"];
//保存之前判断该文件是否存在
  if(file_exists($filename))
  {
    echo "该文件已存在";
  }
  else
  {
  //中文名的文件出现问题，所以需要转换编码格式
  $filename = iconv("UTF-8","gb2312",$filename);
  //移动临时文件到上传的文件存放的位置（核心代码）
  //括号里：1.临时文件的路径, 2.存放的路径
  $fileurl=move_uploaded_file($arr["tmp_name"],$filename);
  }
}
else
{
  echo "上传的文件大小或类型不符";
}

    //是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
    $mail->SMTPDebug = 1;
    
    //使用smtp鉴权方式发送邮件，当然你可以选择pop方式 sendmail方式等 本文不做详解
    //可以参考http://phpmailer.github.io/PHPMailer/当中的详细介绍
    $mail->isSMTP();
    //smtp需要鉴权 这个必须是true
    $mail->SMTPAuth=true;
    //链接qq域名邮箱的服务器地址                  
    $mail->Host = 'smtp.qq.com';
    //设置使用ssl加密方式登录鉴权
    $mail->SMTPSecure = 'ssl';
    //设置ssl连接smtp服务器的远程服务器端口号 可选465或587
    $mail->Port = 465;
    //设置smtp的helo消息头 这个可有可无 内容任意
    $mail->Helo = 'Hello smtp.qq.com Server';
    //设置发件人的主机域 可有可无 默认为localhost 内容任意，建议使用你的域名
    $mail->Hostname = 'localhost';
    //设置发送的邮件的编码 可选GB2312 我喜欢utf-8 据说utf8在某些客户端收信下会乱码
    $mail->CharSet = 'UTF-8';
    //设置发件人姓名（昵称） 任意内容，显示在收件人邮件的发件人邮箱地址前的发件人姓名
    $mail->FromName = $fromName;
    //smtp登录的账号 这里填入字符串格式的qq号即可
    $mail->Username ='1070136042';
    //smtp登录的密码 这里填入“独立密码” 若为设置“独立密码”则填入登录qq的密码 建议设置“独立密码”
    $mail->Password = 'cyhltynqnsvhbcfd';
    //设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”
    $mail->From = $fromMail;
    //邮件正文是否为html编码 注意此处是一个方法 不再是属性 true或false
    $mail->isHTML(true); 
    //设置收件人邮箱地址 该方法有两个参数 第一个参数为收件人邮箱地址 第二参数为给该地址设置的昵称 不同的邮箱系统会自动进行处理变动 这里第二个参数的意义不大
    $mail->addAddress($receiver,'培正快信系统');
    //添加多个收件人 则多次调用方法即可
    //$mail->addAddress('xxx@163.com','晶晶在线用户');
    //添加该邮件的主题
    $mail->Subject = $title;
    //添加邮件正文 上方将isHTML设置成了true，则可以是完整的html字符串 如：使用file_get_contents函数读取本地的html文件
    $mail->Body =$content;
    //为该邮件添加附件 该方法也有两个参数 第一个参数为附件存放的目录（相对目录、或绝对目录均可） 第二参数为在邮件附件中该附件的名称
    $mail->addAttachment($fileurl,$filename);
    //同样该方法可以多次调用 上传多个附件
    //$mail->addAttachment('./Jlib-1.1.0.js','Jlib.js');
    
    
    //发送命令 返回布尔值 
    //PS：经过测试，要是收件人不存在，若不出现错误依然返回true 也就是说在发送之前 自己需要些方法实现检测该邮箱是否真实有效
    $status = $mail->send();
    
    //简单的判断与提示信息
    if($status) {
    echo '发送邮件成功';
    }else{
    echo '发送邮件失败，错误信息未：'.$mail->ErrorInfo;
    }

}
?>