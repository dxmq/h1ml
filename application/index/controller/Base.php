<?php

namespace app\index\controller;

use think\Controller;

class Base extends Controller
{
    public function initialize()
    {
        // 取出栏目信息
        $cates = model('Cate')
            ->order('sort')
            ->limit('6')
            ->select();
        // 取出热门文章
        $hot_articles = model('Article')
            ->field(['id', 'title', 'view_content'])
            ->where('is_show', 1)
            ->where('id', '>', 1)
            ->order(['browse_num'=>'asc', 'create_time'=>'desc'])
            ->limit(10)->select();
        // 取出友情链接
        $friendship_links = model('System')->value('friendship_link');
        $friendship_links = explode(',', $friendship_links); // 字符串转数组
        $flinks = [];
        if (! empty($friendship_links)) {
            foreach ($friendship_links as $k => $v) {
                $flinks[$k]['link_name'] = substr($v, 0, strpos($v, '|'));
                $flinks[$k]['link'] = substr($v, strpos($v, '|')+1);
            }
        }
        // 取出所有的标签及标签下的当前标签下的文章数目
        $label_info = model('Label')->withCount(['article'=>function($query){
            $query->where('is_show',1);
        }])->select();
        // 取出网站介绍
        $webIntroduce = model('System')->value('web_introduce');
        // 取出版权信息
        $webCopyRight = model('System')->value('copyright');
        $viewData = [
            'webCopyRight' => $webCopyRight,
            'webIntroduce' => $webIntroduce,
            'cates' => $cates,
            'hot_articles' => $hot_articles,
            'flinks' => $flinks,
            'label_info' => $label_info
        ];
        $this->view->share($viewData);
    }
}
