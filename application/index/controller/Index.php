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

    public function label($id)
    {
        // 标签下的所有文章显示
        // 查询出所有的文章Id
        $articleLabel = model('ArticleLabel')->field('article_id')->distinct('article_id')->where('label_id', $id)->select();
        $article_id = [];
        foreach ($articleLabel as $k => $v) {
            $article_id[] = $v['article_id'];
        }
        // 查询出所有的文章
        $articles = model('Article')->where('id', 'in', $article_id)->paginate(10);
        $label = model('Label')->find($id);
        $viewData = [
            'cate_id' => 'index',
            'label' => $label,
            'articles' => $articles
        ];
        $this->assign($viewData);
        return view();
    }
}
