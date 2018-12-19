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


    // 管理员列表
    public function lst()
    {
        $adminInfo = Db('Admin')->where('delete_time', '')->paginate(10);
        $viewData = [
            'adminInfo' => $adminInfo
        ];
        $this->assign($viewData);
        return view();
    }
    // 管理员添加
    public function add()
    {
        if ($this->request->isAjax()) {
            $data = [
                'username' => input('post.username'),
                'password' => input('post.password')
            ];
            $ret = model('Admin')->add($data);
            if ($ret == 1) {
                $this->success('管理添加成功', 'admin/index/lst');
            } else {
                $this->error($ret);
            }
        }
        return view();
    }

    // 管理员编辑
    public function edit($id)
    {
        if ($this->request->isAjax()) {
            $data = [
                'id' => input('post.id'),
                'username' => input('post.username'),
                'password' => input('post.password')
            ];
            $ret = model('Admin')->edit($data);
            if ($ret == 1) {
                $this->success('管理编辑成功', 'admin/index/lst');
            } else {
                $this->error($ret);
            }
        }
        $adminInfo = Db('Admin')->find($id);
        $viewData = [
            'adminInfo' => $adminInfo
        ];
        $this->assign($viewData);
        return view();
    }

    // 管理员删除

    public function del()
    {
        if ($this->request->isAjax()) {
            $adminInfo = model('Admin')->find(input('post.id'));
            $ret = $adminInfo->delete();
            if ($ret) {
                $this->success('管理删除成功');
            } else {
                $this->success('管理删除成功');
            }
        }
    }
}
