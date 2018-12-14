<?php

namespace app\admin\controller;

use think\Controller;

class Cate extends Controller
{
    // 栏目列表
    public function lst()
    {
        $cates = model('cate')->order('sort')->paginate(10);
        $viewData = [
            'cates' => $cates
        ];
        $this->assign($viewData);
        return view();
    }

    // 栏目添加
    public function add()
    {
        if ($this->request->isAjax()) {
            $data = [
                'catename' => input('post.catename'),
                'sort' => input('post.sort')
            ];
            $result = model('Cate')->add($data);
            if ($result == 1)
                $this->success('栏目添加成功', 'admin/cate/lst');
            else
                $this->error($result);
        }
        return view();
    }

    // 栏目排序
    public function sort()
    {
        if ($this->request->isAjax()) {
            $data = [
                'id' => input('post.id'),
                'sort' => input('post.sort')
            ];
            $result = model('Cate')->sort($data);
            if ($result == 1) {
                $this->success('栏目排序成功', 'admin/cate/lst');
            } else {
                $this->error($result);
            }
        }
    }

    // 栏目编辑
    public function edit($id)
    {
        if ($this->request->isAjax()) {
            $data = [
                'id' => input('post.id'),
                'catename' => input('post.catename')
            ];
            $result = model('Cate')->edit($data);
            if ($result == 1) {
                $this->success('栏目修改成功', 'admin/cate/lst');
            } else {
                $this->error($result);
            }
        }
        $cates = Db('cate')->find($id);
        $this->assign('cates', $cates);
        return view();
    }

    public function del()
    {
        if ($this->request->isAjax()) {
            $cates = model('Cate')->find(input('post.id'));
            $result = $cates->delete();
            if ($result) {
                $this->success('栏目删除成功');
            } else {
                $this->error('栏目删除失败');
            }
        }
    }
}
