<?php

function  test(){
        echo "test";
        //ini_set("session.cookie_domain",'renrenlie.com');
        session_start();
        setcookie("session_id",session_id(),time()+3600*24*365*10,"/",".renrenlie.com");
        $_SESSION['test'] = "test2";
        echo "<pre>";var_dump($_SESSION);echo "</pre>";
        echo "<pre>";var_dump($_COOKIE);echo "</pre>";
}

test();