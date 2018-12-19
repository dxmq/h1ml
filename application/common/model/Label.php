<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Label extends Model
{
    // 软删除
    use SoftDelete;

    // 关联文章
    public function article()
    {
        return $this->belongsToMany('Article', 'article_label', 'article_id', 'label_id');
    }
    // 标签添加
    public function add($data)
    {
        $validate = new \app\common\validate\Label();
        if (! $validate->scene('add')->check($data)) {
            return $validate->getError();
        }
        $result = $this->allowField(TRUE)->save($data);
        if ($result)
            return 1;
        else
            return '标签添加失败';
    }
    
    // 标签修改
    public function edit($data)
    {
        $validate = new \app\common\validate\Label();
        if (! $validate->scene('edit')->check($data)) {
            return $validate->getError();
        }
        $labels = $this->findOrEmpty($data['id']);
        $labels->labelname = $data['labelname'];
        $result = $labels->allowField(TRUE)->save();
        if ($result) {
            return 1;
        } else {
            return '标签修改失败';
        }
    }
}
