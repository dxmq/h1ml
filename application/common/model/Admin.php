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

    // 添加
    public function add($data) {
        $validate = new \app\common\validate\Admin();
        if (! $validate->scene('add')->check($data)) {
            return $validate->getError();
        }
        $this->username = $data['username'];
        $this->password = $data['password'];
        $result = $this->save();
        if ($result) {
            return 1;
        } else {
            return '管理添加失败';
        }
    }

    // 编辑
    public function edit($data)
    {
        $validate = new \app\common\validate\Admin();
        if (! $validate->scene('edit')->check($data)) {
            return $validate->getError();
        }
        $adminInfo = $this->find($data['id']);
        $adminInfo->username = $data['username'];
        $adminInfo->password = $data['password'];
        $result = $adminInfo->save();
        if ($result) {
            return 1;
        } else {
            return '管理员编辑失败';
        }
    }
}
