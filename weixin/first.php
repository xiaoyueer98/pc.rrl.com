<?php
/*
 * 基类，起到同意配置的作用
 */
class First {
        protected  $arActive = array("1"=>"8");
        protected  $appid = "wx5aee7c9e7c2eb969"; //人人猎公众号appid
        protected  $secert = "44062163dcb3b4627a53bf0ac164c87d"; //人人猎公众号secert
        
        //线上
        static  $host = "localhost";
        static  $port = 3306;
        static  $db = "lierenren";
        static  $user = "myrenrenlie";
        static  $pwd = "W8ydG7TxHRaYZVcT";
        
        //本地
//        static  $host = "127.0.0.1";
//        static  $port = 3306;
//        static  $db = "renrenlie";
//        static  $user = "root";
//        static  $pwd = "";
        
        public function __construct() {
                
        }
        

}
