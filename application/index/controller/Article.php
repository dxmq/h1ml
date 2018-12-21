<?php

namespace app\index\controller;

class Article extends Base
{
    // 文章详情页
    public function detail($id)
    {
        // 取出当前文章
        $articleInfo = model('Article')
            ->with('label')
            ->field('view_content,update_time,delete_time', TRUE)
            ->find($id);
        $viewData = [
            'cate_id' => 'index',
            'articleInfo' => $articleInfo
        ];
        $read=cookie('read');
        $read = (array)$read;
        //dump ($read);die;
        // 判断是否已经记录过article_id
        if (array_key_exists($id, $read)) {
            // 判断点击本篇文章的时间是否已经超过一天
            if ($read[$id]-time()>=86400) {
                $read[$id]=time();
                // 文章点击量+1
                model('Article')->where(array('id'=>$id))->setInc('browse_num',1);
            }
        }else{
            $read[$id]=time();
            // 文章点击量+1
            model('Article')->where(array('id'=>$id))->setInc('browse_num',1);
        }
        cookie('read',$read,86400);
        $this->assign($viewData);
        return view();
    }
}
