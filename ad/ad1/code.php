<?php
exit();
session_start();
error_reporting(0);
header("Content-type:text/html; charset=UTF-8");
/*
  $dbserver   = "localhost";
  $dbusername = "root";
  $dbpassword = "";
  $database   = "lierenren";
  /*  * */
$dbserver   = "localhost";
$dbusername = "myrenrenlie";
$dbpassword = "W8ydG7TxHRaYZVcT";
$database   = "lierenren";


$mysql_conn = @mysql_connect("$dbserver", "$dbusername", "$dbpassword") or die(json_encode(array("code" => "500", "msg" => "系统繁忙")));
mysql_select_db($database, $mysql_conn);
mysql_query('SET NAMES utf8', $mysql_conn);
$act        = isset($_REQUEST['act']) ? $_REQUEST['act'] : exit();
if ($act == "getcode")
{
    $code = getCode();
    if (!$_SESSION['leveltime'])
    {
        $send_code    = $code;
        $mobile       = $_POST['mobile'];
        $table_result = mysql_query('select * from stj_member where mobile="' . $mobile . '"', $mysql_conn);

        //取得所有的表名  
        $tables = array();

        while ($row = mysql_fetch_array($table_result))
        {
            $tables[]['TABLE_NAME'] = $row;
        }

        if ($tables)
        {
            echo json_encode(array("code" => "500", "msg" => "此手机已经注册！"));
            exit();
        }

        $content = "【人人猎】您申请成为renrenlie.com推荐人用户的验证码为" . $send_code . "，10分钟内有效，如非本人操作请忽略此条信息或咨询010-57188076。";
        $res     = sendMessage($mobile, $content);
        if ($res['code'] == "200")
        {
            $_SESSION['leveltime'] = time();
            $_SESSION['code']      = $code;
            $status                = 2;
            $result                = array("code" => 200, "smg" => $send_code);
        }
        else
        {
            $status = 3;
            $result = array("code" => 500, "smg" => "系统繁忙");
        }

        $sql = "insert into stj_sms_log (link_id,tag,comment,mobile,status,content,msg,created_at,updated_at) values "
                . "('$send_code','weixinregact','注册送好礼','$mobile','$status','$content','$res[msg]'," . time() . "," . time() . ")";
        mysql_query($sql);
        echo json_encode($result);
        exit();
    }
    elseif ((time() - $_SESSION['leveltime']) < 10 * 60)
    {

        echo json_encode(array("code" => 200, "smg" => $_SESSION['code']));
    }
    else
    {

        $table_result = mysql_query('select * from stj_member where mobile="' . $mobile . '"', $mysql_conn);

        //取得所有的表名  
        $tables = array();

        while ($row = mysql_fetch_array($table_result))
        {
            $tables[]['TABLE_NAME'] = $row;
        }
        /*
          if ($tables)
          {
          echo json_encode(array("code" => "500", "msg" => "此手机已经注册！"));
          exit();
          }
         * 
         */
        $content = "【人人猎】您申请成为renrenlie.com推荐人用户的验证码为" . $code . "，10分钟内有效，如非本人操作请忽略此条信息或咨询010-57188076。";
        $res     = sendMessage($mobile, $content);
        if ($res['code'] == "200")
        {
            $_SESSION['leveltime'] = time();
            $_SESSION['code']      = $code;
            $status                = 2;
            $result                = array("code" => 200, "smg" => $send_code);
        }
        else
        {
            $status = 3;
            $result = array("code" => 500, "smg" => "系统繁忙");
        }

        $sql = "insert into stj_sms_log (link_id,tag,comment,mobile,status,content,msg,created_at,updated_at) values "
                . "('$send_code','weixinregact','注册送好礼','$mobile','$status','$content','$res[msg]'," . time() . "," . time() . ")";
        mysql_query($sql);
        echo json_encode($result);
        exit();
    }
    echo $gets['SubmitResult']['msg'];
}
elseif ($act == "reg")
{

    $table_result = mysql_query('select * from stj_member where username="' . $_POST["username"] . '"', $mysql_conn);

    //取得所有的表名  
    $tables = array();

    while ($row = mysql_fetch_array($table_result))
    {
        $tables[]['TABLE_NAME'] = $row;
    }
    if ($tables)
    {
        echo json_encode(array("code" => "500", "msg" => "此用户名已经注册！"));
        exit();
    }
    $code = getCode(4);
    $res1 = mysql_query("insert into stj_member (username,password,cnname,email,mobile,address,activation,fromwhere,expiry,token_exptime,regtime,logintime)
        values ('$_POST[username]','" . md5(md5($_POST[password])) . "','$_POST[cnname]','$_POST[email]','$_POST[mobile]','$_POST[address]',1,'注册送好礼','$code'," . time() . "," . time() . "," . time() . ") ", $mysql_conn);
    //echo "insert into stj_member (username,password,cnname,email,mobile,address,activation,fromwhere,expiry,token_exptime)
    //    values ('$_POST[username]','" . md5($_POST[password]) . "','$_POST[cnname]','$_POST[email]','$_POST[mobile]','$_POST[address]',1,'新人注册送大礼','$code'," . time() . ") ";
    //$res2 = mysql_query("insert into stj_expirys (giftid,expiry,status,notissued,issued,accept)
    //     values (1,'$code',1,'" . date("Y-m-d H:s:s") . "','" . date("Y-m-d H:s:s") . "','1') ", $mysql_conn);
    // echo "insert into stj_member (username,password,cnname,email,mobile,address,activation,fromwhere,expiry,token_exptime,regtime,logintime)
    //    values ('$_POST[username]','" . md5(md5($_POST[password])) . "','$_POST[cnname]','$_POST[email]','$_POST[mobile]','$_POST[address]',1,'注册送好礼','$code'," . time() . "," . time() . "," . time() . ")";
    mysql_query("insert into stj_userinfo (username,password,status,flag) values ('$_POST[username]','" . md5(md5($_POST[password])) . "',1,0) ", $mysql_conn);

    if (!$res1)
    {
        echo json_encode(array("code" => "500", "msg" => "系统繁忙1！"));
        exit();
    }
    echo json_encode(array("code" => 200, "smg" => "成功"));
    exit();
    $content = "您成功参与了本次活动，凭验证码" . $code . "领取51社保大礼包奖品。";
    //邮箱发送成功之后把用户信息添加进数据库,默认为零不激活
    sendMail($_POST['email'], "领取码", $content);

    $target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit";

    $mobile    = $_POST['mobile'];
    $content   = "您成功参与了本次活动，凭验证码" . $code . "领取51社保大礼包奖品。";
    $post_data = "account=cf_zpkj&password=840a6d63c511f5b0a61afc7352c207f3&mobile=" . $mobile . "&content=" . rawurlencode($content);
    echo json_encode(array("code" => 200, "smg" => "成功"));
    exit();
}

function getCode($num = 6)
{
    $randStr = str_shuffle('1234567890');
    $rand    = substr($randStr, 0, 6);
    return $rand;
}

function Post($curlPost, $url)
{
    $curl       = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_NOBODY, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
    $return_str = curl_exec($curl);
    curl_close($curl);
    return $return_str;
}

function xml_to_array($xml)
{
    $reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
    if (preg_match_all($reg, $xml, $matches))
    {
        $count = count($matches[0]);
        for ($i = 0; $i < $count; $i++)
        {
            $subxml = $matches[2][$i];
            $key    = $matches[1][$i];
            if (preg_match($reg, $subxml))
            {
                $arr[$key] = xml_to_array($subxml);
            }
            else
            {
                $arr[$key] = $subxml;
            }
        }
    }
    return $arr;
}

function random($length = 6, $numeric = 0)
{
    PHP_VERSION < '4.2.0' && mt_srand((double) microtime() * 1000000);
    if ($numeric)
    {
        $hash = sprintf('%0' . $length . 'd', mt_rand(0, pow(10, $length) - 1));
    }
    else
    {
        $hash  = '';
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
        $max   = strlen($chars) - 1;
        for ($i = 0; $i < $length; $i++)
        {
            $hash .= $chars[mt_rand(0, $max)];
        }
    }
    return $hash;
}

function sendMail($to, $title, $content)
{
    require 'SMTP.php';
    require 'PHPMailer.php';
    $mail           = new PHPMailer(); //实例化
    $mail->IsSMTP(); // 启用SMTP
    $mail->Host     = "smtp.exmail.qq.com"; //smtp服务器的名称（这里以QQ邮箱为例）
    $mail->SMTPAuth = TRUE; //启用smtp认证
    $mail->Username = '709981907@qq.com'; //你的邮箱名
    $mail->Password = 'duolejibuzhu1'; //邮箱密码
    $mail->From     = '709981907@qq.com'; //发件人地址（也就是你的邮箱地址）
    $mail->FromName = '人人猎'; //发件人姓名
    $mail->AddAddress($to, "尊敬的客户");
    $mail->WordWrap = 50; //设置每行字符长度
    $mail->IsHTML(TRUE); // 是否HTML格式邮件
    $mail->CharSet  = 'utf-8'; //设置邮件编码
    $mail->Subject  = $title; //邮件主题
    $mail->Body     = $content; //邮件内容
    $mail->AltBody  = "这是一个纯文本的身体在非营利的HTML电子邮件客户端"; //邮件正文不支持HTML的备用显示
    return($mail->Send());
}

function sendMessage($mobile, $content)
{

    $codeMsg = array("100" => "全部成功", "101" => "参数错误", "102" => "号码错误", "103" => "当日余量不足",
        "104" => "请求超时", "105" => "用户余量不足", "106" => "非法用户", "107" => "提交号码超限", "111" => "签名不合法", "120" => "内容长度超长，请不要超过500个字", "121" => "内容中有屏蔽词");
    if (is_array($mobile))
    {
        foreach ($mobile as $key => $val)
        {
            $rule = "/^((13[0-9])|147|(15[0-35-9])|180|182|(18[5-9]))[0-9]{8}$/A";
            preg_match($rule, $mobile, $result);
            if (!$result)
            {
                unset($mobile[$key]);
            }
        }
        $mobile = explode(",", $mobile);
    }

    $data['username']    = "zpkj";
    $data['pwd']         = md5("S2pKDu7q");
    $data['extnum']      = "";
    $data['p']           = $mobile;
    $data['isUrlEncode'] = "no";
    $data['charSetStr']  = "utf8";
    $data['msg']         = $content;
    $jasonCallback       = Post($data, "http://api.app2e.com/smsBigSend.api.php");

    $arCallback = json_decode($jasonCallback, true);

    $logInfo = array();
    if ($arCallback['status'] == 100)
    {
        $logInfo['status'] = 2;
        $code              = 200;
    }
    else
    {
        $code              = 500;
        $logInfo['status'] = 3;
    }
    return array("code" => $code, "msg" => $codeMsg[$arCallback['status']]);
}

?>