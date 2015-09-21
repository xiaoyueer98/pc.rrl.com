<?php
header("content-type:text/html;charset=utf-8");
//session_start();
require_once("../../API/qqConnectAPI.php"); 
$qc = new QC();
$acs = $qc->qq_callback();
$oid = $qc->get_openid();
$qc = new QC($acs,$oid);
$uinfo = $qc->get_user_info();
print_r($uinfo);die;
$_SESSION["username"] = $uinfo['nickname'];
$_SESSION["img"] = $uinfo['figureurl_qq_2'];
?>

授权成功，欢迎<font color="red"><?php echo $uinfo['nickname']?></font><a href="../../../default/index.php">返回首页</a>
