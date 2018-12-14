<?php

namespace app\common\model;

use think\Db;
use think\Model;
use think\model\concern\SoftDelete;

class Admin extends Model
{
    // 软删除
    use SoftDelete;
    // 后台登录
    public function login($data)
    {
        $validate = new \app\common\validate\Admin();
        if (! $validate->scene('login')->check($data))
            return $validate->getError();
        unset($data['captcha']);
        $adminInfo = Db::table('zc_admin')->where('username', $data['username'])->findOrEmpty();
        if ($adminInfo && $adminInfo['password'] == $data['password']) {
            $sessionData = [
                'id' => $adminInfo['id'],
                'username' => $adminInfo['username']
            ];
            session('admin', $sessionData);
            return 1;
        } else {
            return '用户名或密码错误！';
        }
    }
}
