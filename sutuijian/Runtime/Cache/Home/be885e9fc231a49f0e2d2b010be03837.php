<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div id='findpwd_getcode'>TODO write content</div>
    </body>
</html>


<script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
    $("#findpwd_getcode").click(function() {
                
                var rrl_hash = "<?php $_SESSION['cookie']=time();echo md5($_SESSION['cookie']);?>";
                $("#findpwd_getcode").attr("disabled", "disabled");
                $.post("/Home/Tests/get_test", {rrl_hash:rrl_hash}, function(data) {
                    
                    if (data.code != "500") {
                        time($("#findpwd_getcode"), $("#findpwd_codetimes"));
                    } else {
                        $(".findpwderror2 i").html(data.msg);
                        $(".findpwderror2 i").show();
                    }
                }, "json")
            })
            
            
    
</script>