<?php

namespace app\index\controller;

class Column extends Base
{
    // 栏目主页
    public function index($id)
    {
        // 取出当前栏目下的所有文章信息
        $articles = model('Article')
            ->field('content,delete_time,update_time,is_show,is_top', TRUE)
            ->where(['cate_id'=>$id, 'is_show'=>1])
            ->where('id', '>', 1)
            ->order(['is_top'=>'asc', 'update_time'=>'desc'])
            ->paginate(6);
        $viewData = [
            'cate_id' => $id,
            'articles' => $articles
        ];
        $this->assign($viewData);
        return view();
    }
}
