<?php
namespace Qcloud\Sms\Demo;
require_once "..\sms\SmsSender.php";
use Qcloud\Sms\SmsSingleSender;

session_start();
try {
    $appid = 1400053688;
    $appkey = "19131947a10b91430c6a5f82dab6bea3";
    
    $phoneNumber = '18814101356';

    $templId = 87784;//修改密码模板
    $code = rand(1000,9999);
    $_SESSION['usercode'] = $code;

    $singleSender = new SmsSingleSender($appid, $appkey);

    // 指定模板单发
    // 假设模板内容为：测试短信，{1}，{2}，{3}，上学。
    $params = array($code, "10");
    $result = $singleSender->sendWithParam("86", $phoneNumber, $templId, $params, "", "", $code);
    $rsp = json_decode($result);
    echo $result;

} catch (Exception $e) {
    echo var_dump($e);
}
