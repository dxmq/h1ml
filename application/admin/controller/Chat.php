<?php

namespace app\admin\controller;

use think\Controller;

class Chat extends Controller
{
    // 碎语列表
    public function lst()
    {
        $chats = model('Chat')->where('is_show', 1)->paginate(10);
        $this->assign('chats', $chats);
        return view();
    }

    // 碎语添加
    public function add()
    {
        if ($this->request->isAjax()) {
            $data = [
                'content' => input('post.content'),
                'is_show' => input('post.is_show')
            ];
            $result = model('Chat')->add($data);
            if ($result == 1)
                $this->success('碎语添加成功', 'admin/chat/lst');
            else
                $this->error($result);
        }
        return view();
    }

    // 碎语编辑
    public function edit($id)
    {
        if ($this->request->isAjax()) {
            $data = [
                'id' => input('post.id'),
                'content' => input('post.content'),
                'is_show' => input('post.is_show')
            ];
            $result = model('Chat')->edit($data);
            if ($result == 1) {
                $this->success('碎语编辑成功', 'admin/chat/lst');
            } else {
                $this->error($result);
            }
        }
        $chats = model('Chat')->find($id);
        $this->assign('chats', $chats);
        return view();
    }


    // 碎语删除
    public function del()
    {
        if ($this->request->isAjax()) {
            $chats = model('Chat')->find(input('post.id'));
            $result = $chats->delete(TRUE);
            if ($result) {
                $this->success('碎语删除成功');
            } else {
                $this->error('碎语删除失败');
            }
        }
    }
}
