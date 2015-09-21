<?php if (!defined('THINK_PATH')) exit(); echo "<pre>";echo var_dump($hash);echo "</pre>";die;?>
<div class="pc-zhuce" style="display: none" id='conZhuce'>
    <a href="javascript:;" class="close"></a>
    <h3></h3>
    <dl>
        <dt>
        <ul class="pc-nav">
            <li class="nav1 mover3" id='tjrzc'>推荐人<input type="hidden" name="usertype" value="0"/></li>
            <li class="nav2" id='qyzc'>招聘企业</li>
        </ul>
        <ul class="list" id="list1">
            <li><input type="text" name="username" value="请输入用户名" default="请输入用户名" onkeydown="ZC_KeyDown();" ></li>
            <li><input type="text" name="mobile" value="请输入手机号" default="请输入手机号" onkeydown="ZC_KeyDown();"></li>
            <li><input type="text" class="vfition" name="vfition" value="请输入验证码" default="请输入验证码" onkeydown="ZC_KeyDown();">
                <label class="vfit_btn1" style="display: block" id="get_reg_code">获取验证码</label>
                <label class="vfit_btn2"  style="display: none"><i>60</i>秒后重新获取</label>
            </li>
            <li><input type="text" class="possword"  name="possword" value="请输入密码" default="请输入密码" onkeydown="ZC_KeyDown();"></li>
            <p id="zhuceerror" style="display: none"></p>
        </ul>
        <ul class="list" id="list2" style="display:none;">
            <li><input type="text" name="cpname" value="请输入公司名称" default="请输入公司名称" onkeydown="ZC_KeyDown();"></li>
            <li><input type="text" name="address" value="请输入公司地址" default="请输入公司地址" onkeydown="ZC_KeyDown();"></li>
            <li><input type="text" name="mobile" value="请输入手机号" default="请输入手机号" onkeydown="ZC_KeyDown();"></li>
            <li><input type="text" class="vfition" name="vfition" value="请输入验证码" default="请输入验证码" onkeydown="ZC_KeyDown();"><label class="vfit_btn1" style="display: block" id="get_reg_code">获取验证码</label><label class="vfit_btn2"  style="display: none"><i>60</i>秒后重新获取</label></li>
            <li><input type="text" name="username" value="请输入用户名" default="请输入用户名" onkeydown="ZC_KeyDown();"></li>
            <li><input type="text" class="possword"  name="possword" value="请输入密码" default="请输入密码"  onkeydown="ZC_KeyDown();"></li>
            <p id="zhuceerror" style="display: none"></p>
        </ul>
        <div class="yanzheng">
            <input class="radio1" type="radio" name="xieyi" id="xieyaya" onkeydown="ZC_KeyDown();">
            <span>已阅读并接受人人猎网<a href="javascript:;" id="xieyisss">《用户协议和隐私条款》</a></span>
        </div>
        <button id="register">确认</button>
        </dt>
        <dd>
            <div class="yd">
                <span>已有账号</span>
                <em id="denglu3">点此登录</em>
            </div>
            <p>使用联合账号登录</p>
            <ul class="Sign" >
                <li><a href="/Home/Index/login?type=qq"><img src="/Public/img/qq_icon.png"></a></li>
                <li><a href="/Home/Index/login?type=sina"><img src="/Public/img/weibo.png"></a></li>
                <li><a href="/Home/Index/login?type=weixin"><img src="/Public/img/weixin.png"></a></li>
                <li><a href="/Home/Index/login?type=renren"><img src="/Public/img/renren.png"></a></li>
            </ul>
            <ul class="Grey" style="display:none">
                <li><img src="/Public/img/qq2.png"></li>
                <li><img src="/Public/img/Sina2.png"></li>
                <li><img src="/Public/img/weixin2.png"></li>
                <li><img src="/Public/img/renren2.png"></li>
            </ul>
        </dd>
    </dl>
</div>
 <script type="text/javascript" src="/Public/js/zhuce.js"></script>