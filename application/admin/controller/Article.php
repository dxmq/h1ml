<?php

namespace app\admin\controller;

class Article extends Base
{
    // 文章列表
    public function lst()
    {
        // 取出所有的文章信息
        $articles = model('Article')->order(['is_show'=>'asc', 'is_top'=>'asc', 'create_time'=>'desc'])->with('cate,label')->paginate(10);
        $this->assign('articles', $articles);
        return view();
    }

    // 文章添加
    public function add()
    {
        if ($this->request->isAjax()) {
            /*$error = $_FILES['pic']['error'];
            if ($error > 0) {
                $this->error('图片不能为空');
            }*/
            if (! $_FILES['pic']['name']) { // 图片为空
                $data = [
                    'title' => input('post.title'),
                    'author' => input('post.author'),
                    'cate_id' => input('post.cate_id'),
                    'is_show' => input('post.is_show'),
                    'is_top' => input('post.is_top'),
                    'label_id' => input('post.label_id'),
                    'content' => input('post.content'),
                    'pic' => '',
                ];
                $ret = model('Article')->add($data);
                if ($ret == 1) {
                    $this->success('文章添加成功', 'admin/article/lst');
                } else {
                    $this->error($ret);
                }
            } else {
                $pic = $this->request->file('pic');
                $data = [
                    'id' => input('post.id'),
                    'title' => input('post.title'),
                    'author' => input('post.author'),
                    'cate_id' => input('post.cate_id'),
                    'is_show' => input('post.is_show'),
                    'is_top' => input('post.is_top'),
                    'label_id' => input('post.label_id'),
                    'content' => input('post.content'),
                    'pic' => $pic,
                ];
                $ret = model('Article')->add($data);
                if ($ret == 1) {
                    $this->success('文章添加成功', 'admin/article/lst');
                } else {
                    $this->error($ret);
                }
            }
        }
        // 取出所有的栏目
        $cates = model('Cate')->select();
        // 取出所有的标签
        $labels = model('Label')->select();
        $viewData = [
            'cates' => $cates,
            'labels' => $labels
        ];
        $this->assign($viewData);
        return view();
    }

    // 文章编辑
    public function edit($id)
    {
        if ($this->request->isAjax()) {
            /*$error = $_FILES['pic']['error'];
            if ($error > 0) {
                $this->error('图片不能为空');
            }*/
            if (! $_FILES['pic']['name']) {
                // $pic = $this->request->file('pic');
                $data = [
                    'id' => input('post.id'),
                    'title' => input('post.title'),
                    'author' => input('post.author'),
                    'cate_id' => input('post.cate_id'),
                    'is_show' => input('post.is_show'),
                    'is_top' => input('post.is_top'),
                    'label_id' => input('post.label_id'),
                    'content' => input('post.content'),
                    'pic' => '',
                ];
                $ret = model('Article')->edit($data);
                if ($ret == 1) {
                    $this->success('文章编辑成功', 'admin/article/lst');
                } else {
                    $this->error($ret);
                }
            } else {
                $pic = $this->request->file('pic');
                $data = [
                    'id' => input('post.id'),
                    'title' => input('post.title'),
                    'author' => input('post.author'),
                    'cate_id' => input('post.cate_id'),
                    'is_show' => input('post.is_show'),
                    'is_top' => input('post.is_top'),
                    'label_id' => input('post.label_id'),
                    'content' => input('post.content'),
                    'pic' => $pic,
                ];
                $ret = model('Article')->edit($data);
                if ($ret == 1) {
                    $this->success('文章编辑成功', 'admin/article/lst');
                } else {
                    $this->error($ret);
                }
            }
        }
        // 取出所有栏目
        $cates = model('Cate')->select();
        // 取出所有的标签
        $labels = model('Label')->select();
        // 取出当前的文章和标签
        $articles = model('Article')->with('label')->find($id);
        $article_labels = $articles->label;
        $label_id = [];
        foreach ($article_labels as $k => $v) {
            $label_id[] = $v['id'];
        }
        $label_id = implode(',', $label_id);
        $viewData = [
            'cates' => $cates,
            'labels' => $labels,
            'articles' => $articles,
            'label_id' => $label_id,
        ];
        $this->assign($viewData);
        return view();
    }

    // 文章删除
    public function del()
    {
        if ($this->request->isAjax()) {
            // 接收id
            $id = input('post.id');
            // 先查询当前文章
            $articles = model('Article')->find($id);
            /*// 删除文章对应的图片
            $thumb = $articles['thumbnail'];
            if ($thumb) {
                unlink(config('upload_path') . '/' . $thumb);
            }*/
            // 删除文章
            $result1 = $articles->delete();
            // 删除文章标签
            $article_label = model('ArticleLabel')->find($id);
            if ($article_label) { //如果有标签才删除
                $result2 = $article_label->delete();
                if ($result1 && $result2) {
                    $this->success('删除文章成功');
                } else {
                    $this->error('删除文章失败');
                }
            } else {
                $this->success('删除文章成功');
            }
        }
    }
}
