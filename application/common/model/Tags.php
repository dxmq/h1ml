<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Tags extends Model
{
    use SoftDelete;
    // 标签添加
    public function add($data)
    {
        $validate = new \app\common\validate\Tag();
        if (! $validate->scene('add')->check($data)) {
            return $validate->getError();
        }
        $result = $this->allowField(TRUE)->save($data);
        if ($result) {
            return 1;
        } else {
            return '标签添加失败';
        }
    }

    // 标签修改
    public function edit($data)
    {
        $validate = new \app\common\validate\Tag();
        if (! $validate->scene('edit')->check($data)) {
            return $validate->getError();
        }
        $tags = $this->find($data['id']);
        $tags->tag = $data['tags'];
        $result = $tags->allowField(TRUE)->save();
        if ($result) {
            return 1;
        } else {
            return '标签添加失败';
        }
    }
}
