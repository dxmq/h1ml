<?php
namespace app\index\controller;

class Index extends Base
{
    public function index()
    {
        // 取出最新的文章
        $articles = model('Article')
            ->with(['label'=>function($require){
                $require->field('id,labelname');
            }])
            ->field('content,delete_time,update_time,is_show,is_top', TRUE)
            ->where(['is_show'=>1])
            ->where('id', '>', 1)
            ->order([ 'is_top'=>'asc', 'create_time'=>'desc'])
            ->paginate('6');

        // 取出置顶文章
        $topArticle = model('Article')
            ->field('thumbnail,delete_time,content,is_show,is_top', TRUE)
            ->where('id',1)
            ->find();
        $viewData = [
            'topArticle' => $topArticle,
            'cate_id' => 'index',
            'articles' => $articles,
        ];
        $this->assign($viewData);
        return view();
    }
}
