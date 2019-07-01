<?php
/**
 * Created by PhpStorm.
 * User: mint
 * Date: 2018/12/14
 * Time: 16:38
 */

namespace app\common\validate;


use think\Validate;

class Admin extends Validate
{
    protected $rule = [
        'id' => 'require|number',
        '__token__' => 'token',
        'username|用户名' => 'require|length:2,15|unique:admin',
        'password|密码' => 'require|min:6',
        'captcha|验证码' => 'require|captcha',
    ];

    public function sceneLogin()
    {
        return $this->only(['username', 'password', 'captcha'])
            ->remove('username', 'unique')
            ->remove('password', 'min:6');
    }

    public function sceneAdd()
    {
        return $this->only(['username', 'password']);
    }

    public function sceneEdit()
    {
        return $this->only(['id', 'username', 'password']);
    }
}