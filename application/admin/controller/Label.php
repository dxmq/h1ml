<?php

namespace app\admin\controller;

class Label extends Base
{
    // 标签列表
    public function lst()
    {
        $labels = model('label')->paginate(10);
        $viewData = [
            'labels' => $labels
        ];
        $this->assign($viewData);
        return view();
    }

    // 标签添加
    public function add()
    {
        if ($this->request->isAjax()) {
            $data = [
                'labelname' => input('post.labelname'),
            ];
            $result = model('label')->add($data);
            if ($result == 1)
                $this->success('标签添加成功', 'admin/label/lst');
            else
                $this->error($result);
        }
        return view();
    }

    // 标签编辑
    public function edit($id)
    {
        if ($this->request->isAjax()) {
            $data = [
                'id' => input('post.id'),
                'labelname' => input('post.labelname')
            ];
            $result = model('label')->edit($data);
            if ($result == 1) {
                $this->success('标签修改成功', 'admin/label/lst');
            } else {
                $this->error($result);
            }
        }
        $labels = model('label')->find($id);
        $this->assign('labels', $labels);
        return view();
    }

    public function del()
    {
        if ($this->request->isAjax()) {
            $labels = model('label')->find(input('post.id'));
            $result = $labels->delete(TRUE);
            if ($result) {
                $this->success('标签删除成功');
            } else {
                $this->error('标签删除失败');
            }
        }
    }
}
