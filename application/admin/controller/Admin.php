<?php

namespace app\admin\controller;

class Admin extends Base
{
    public function initialize()
    {
        if (session('?admin.id')) {
            $this->redirect('admin/index/index');
        }
    }

    // 管理员登录
    public function login()
    {
        if ($this->request->isAjax())
        {
            $data = [
                'username' => input('post.username'),
                'password' => input('post.password'),
                'captcha' => input('post.captcha'),
                '__token__' => input('post.__token__')
            ];
            $result = model('Admin')->login($data);
            if ($result == 1)
            {
                $this->success('登录成功', 'admin/index/index');
            } else {
                $this->error($result);
            }
        }
        return view();
    }
}
