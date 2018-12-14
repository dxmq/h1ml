<?php

namespace app\admin\controller;

use think\Controller;
use think\db;
class Tags extends Controller
{
    // 标签列表
    public function lst()
    {
        $tags = Db('Tags')->paginate(10);
        $viewData = [
            'tags' => $tags,
        ];
        $this->assign($viewData);
        return view();
    }

    // 标签添加
    public function add()
    {
        if ($this->request->isAjax()) {
            $data = [
                'tags' => input('post.tags')
            ];
            $result = model('Tags')->add($data);
            if ($result == 1) {
                $this->success('标签添加成功', 'admin/tags/lst');
            } else {
                $this->error($result);
            }
        }
        return view();
    }

    public function edit($id)
    {
        if ($this->request->isAjax()) {
            $data = [
                'id' => input('post.id'),
                'tags' => input('post.tags')
            ];
            $result = model('Tags')->edit($data);
            if ($result == 1) {
                $this->success('标签修改成功', 'admin/tags/lst');
            } else {
                $this->error($result);
            }
        }
        $tags = model('Tags')->find($id);
        $this->assign('tags', $tags);
        return view();
    }
}
