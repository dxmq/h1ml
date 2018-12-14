<?php

namespace app\admin\controller;

use think\Controller;

class Base extends Controller
{
    // 后台基础控制器
    public function initialize()
    {
        if (! session('?admin.id')) {
            $this->redirect('admin/admin/login');
        }
    }
}
