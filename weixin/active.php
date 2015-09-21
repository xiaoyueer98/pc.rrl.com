<?php
include_once("first.php");
include_once("DB.php");
/*
 * 活动相关操作类
 */
class Active extends First{
        
        public  function  doQrcode1($openid,$type) {
                
                $activeId = $this -> arActive['1'];
                //写入session
                session_start();
                $_SESSION['qrcodefrom'] = 1; //将二维码参数写进session，供注册是使用
                //写入浏览日志
                $arActive = DB::select("select * from stj_active where id=$activeId");
                $sActivename = $arActive['activename'];
                
                $sql = "insert into stj_qrcodefrom(activeid,activename,username,type,created_at,updated_at) value(".$activeId.",'".$sActivename."','".$openid."',".$type.",".time().",".time().")";
                DB::insert($sql);
                
        }
        
}

