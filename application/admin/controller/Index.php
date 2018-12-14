<?php

namespace app\admin\controller;

class Index extends Base
{
    // 后台首页
    public function index()
    {
        return view();
    }

    // 退出
    public function logout()
    {
        if ($this->request->isAjax()) {
            session(null);
            if (! session('?admin.id')) {
                $this->success('退出成功', 'admin/admin/login');
            } else {
                $this->error('退出失败');
            }
        }
    }
}
