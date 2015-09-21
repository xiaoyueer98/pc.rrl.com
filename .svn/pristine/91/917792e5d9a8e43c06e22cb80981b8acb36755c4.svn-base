<?php

namespace Home\Model;

use Think\Model;

class UserModel extends Model {

    protected $_validate = array(
        array('username', '', '帐号名称已经存在！', 0, 'unique', 1), // 在新增的时候验证name字段是否唯一
        array('repassword', 'password', '确认密码不正确', 0, 'confirm'), // 验证确认密码是否和密码一致
        array('password', 'checkPwd', '密码格式不正确', 0, 'function'), // 自定义函数验证密码格式
    );

}

?>