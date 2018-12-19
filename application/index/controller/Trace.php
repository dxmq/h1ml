<?php

namespace app\index\controller;

class Trace extends Base
{
    // 归档页
    public function trace()
    {
        // 取出文章中除置顶文章的id,create_time,title,author
        $trace = model('Article')
            ->field('id,create_time,title,author')
            ->where('is_show',1)
            ->where('id', '>', 1)
            ->paginate(10);
        $viewData = [
            'cate_id' => 'archives',
            'trace' => $trace
        ];
        $this->assign($viewData);
        return view();
    }
}
