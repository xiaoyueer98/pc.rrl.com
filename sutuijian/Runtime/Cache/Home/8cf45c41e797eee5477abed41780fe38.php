<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript" src="/Public/js/webchatnew/jquery-1.11.0.min.js"></script>
<html>
    <form action="/Home/Index/test_action" method="post">
        <input type="text" value="" name="zhi1"><br/>
        <input type="text" value="" name="zhi2"><br/>
        <input type="text" value="" name="zhi3"><br/>
        <input type="text" value="" name="zhi4"><br/>
        <input type="submit" value="提交">
    </form>
    <table id="table">
        <tr><td>aa</td><td>bb</td></tr>
        <tr><td>cc</td><td>dd</td></tr>
    </table>
    <script>
        
        var trs = $("#table tr");
       
        for ( var i = 0; i < trs.length; i++) {
            alert();
            alert(trs[i].find("td").html());
        }
    </script>
</html>