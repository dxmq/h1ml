<?php

namespace app\admin\controller;


class Recycle extends Base
{
    //回收站列表
    public function lst()
    {
        // 取出所有的被放软删除的文章
        $articles = \app\common\model\Article::onlyTrashed()->order('delete_time', 'desc')->select();
        $viewData = [
            'articles' => $articles
        ];
        $this->assign($viewData);
        return view();
    }

    // 恢复
    public function recover()
    {
        if ($this->request->isAjax()) {
            $id = input('post.id');
            $article = \app\common\model\Article::onlyTrashed()->find($id);
            $res = $article->restore();
            if ($res) {
                $this->success('恢复成功');
            } else {
                $this->error('恢复失败');
            }
        }
    }

    // 彻底删除
    public function delete()
    {
        if ($this->request->isAjax())
        {
            // 维护article_label表
            model('ArticleLabel')->where('article_id', input('post.id'))->delete(true);
            $articles = model('Article')->find(input('post.id'));
            // 彻底删除缩略图
            $thumb = $articles['thumbnail'];
            if ($thumb) {
                unlink(config('upload_path') . '/' . $thumb);
            }
            $res = \app\common\model\Article::destroy(input('post.id', true));
            if ($res) {
                $this->success('彻底删除成功');
            } else {
                $this->success('彻底删除失败');
            }
        }
    }
}
