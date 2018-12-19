<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Chat extends Model
{
    use SoftDelete;
    // 碎语添加
    public function add($data)
    {
        $validate = new \app\common\validate\Chat();
        if (! $validate->scene('add')->check($data)) {
            return $validate->getError();
        }
        $this->content = $data['content'];
        $this->is_show = $data['is_show'];
        $result = $this->save();
        if ($result) {
            return 1;
        } else {
            return '碎语添加失败';
        }
    }

    // 碎语编辑
    public function edit($data)
    {
        $validate = new \app\common\validate\Chat();
        if (! $validate->scene('edit')->check($data)) {
            return $validate->getError();
        }
        $chats = $this->find($data['id']);
        $chats->content = $data['content'];
        $chats->is_show = $data['is_show'];
        $result = $chats->save();
        if ($result || $result == null) {
            return 1;
        } else {
            return '碎语编辑失败';
        }
    }
}
