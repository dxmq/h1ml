<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Article extends Model
{
    // 软删除
    use SoftDelete;

    // 关联栏目模型
    public function cate()
    {
        return $this->belongsTo('Cate', 'cate_id', 'id');
    }

    // 关联标签
    public function label()
    {
        return $this->belongsToMany('Label', 'article_label', 'label_id', 'article_id');
    }

    /**
     * @param $file
     * @param $type
     * @param null $article_id
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    private function uploadPic($file, $type, $article_id=null)
    {
        if ($file) {
            $dir = config('app.upload_path');
            if (!is_dir($dir)) {
                mkdir($dir,0777,true);
            }
            $info = $file->validate(['size'=>2097152, 'ext'=>'jpg,png,gif'])->move($dir);
            if ($info) {
                $path = $info->getSaveName();
                $path = str_replace('\\', '/', $path);
                $filePath  = config('app.upload_path') . '/' . $path;
                $pics_path = $this->makeThumb($filePath);
                if ($pics_path) {
                    if(file_exists($filePath)){
                        unset($info);
                        unlink($filePath);
                    } else {
                        return '删除原图失败';
                    }
                }
                if ($type == 'add') {
                    $this->thumbnail = $pics_path;
                    $result = $this->save();
                    if ($result) {
                        return 1;
                    } else {
                        return '图片上传失败';
                    }
                } else {
                    $articles = $this->find($article_id);
                    $articles->thumbnail = $pics_path;
                    $result = $articles->save();
                    if ($result) {
                        return 1;
                    } else {
                        return '图片上传失败';
                    }
                }
            } else {
                return $file->getError();
            }
        } else {
            return $file->getError();
        }
    }

    // 生成缩略图
    private function makeThumb($filePath) {
        $thumbName = 'thumb_' . trim(strrchr($filePath, '/'),'/');
        $thumbPath = config('app.upload_path') . '/' . date('Ymd') . '/' . $thumbName;
        $image = \think\Image::open($filePath);
        $result = $image->thumb(config('app.thumb_width'),config('app.thumb_height'), 6)->save($thumbPath);
        if ($result) {
            //unlink('../public/uploads/20181215/28fee422412b49a61ae1393a6defe294.png');
            return date('Ymd') . '/' . $thumbName;
        } else {
            return FALSE;
        }
    }

    // 文章添加
    public function add($data)
    {
        $validate = new \app\common\validate\Article();
        if (! $validate->scene('add')->check($data)) {
            return $validate->getError();
        }
        $this->title = $data['title'];
        $this->author = $data['author'];
        $this->is_show = $data['is_show'];
        $this->is_top = $data['is_top'];
        $this->content = $data['content'];
        $this->cate_id = $data['cate_id'];
        $this->view_content = mulsubstr(strip_tags($data['content']), 200);
        $result1 = $this->save();
        if ($result1) {
            $article_id = $this->id;
            $articleFields= [
                'article_id' => $article_id,
                'label_id' => $data['label_id']
            ];
            $result3 = $this->articleLabelAdd($articleFields);
            if ($result3 == 1) {
                if ($data['pic']) {
                    $result2 = $this->uploadPic($data['pic'], 'add');
                    if ($result2 == 1) {
                        return 1;
                    } else {
                        return $result2;
                    }
                } else { // 如果没有图片上传，也返回1
                    return 1;
                }
            } else {
                return $result3;
            }
        } else {
            return '添加文章失败';
        }
    }

    // 添加时维护article_label表
    public function articleLabelAdd($articleFields)
    {
        if ($articleFields['label_id']) {
            model('ArticleLabel')->add($articleFields);
            return 1;
        } else {
            return 1;
        }
    }

    // 文章编辑
    public function edit($data)
    {
        $validate = new \app\common\validate\Article();
        if (! $validate->scene('edit')->check($data)) {
            return $validate->getError();
        }
        $articles = $this->find($data['id']);
        $articles->title = $data['title'];
        $articles->author = $data['author'];
        $articles->is_show = $data['is_show'];
        $articles->is_top = $data['is_top'];
        $articles->content = $data['content'];
        $articles->cate_id = $data['cate_id'];
        $articles->view_content = mulsubstr(strip_tags($data['content']), 200);
        $result1 = $articles->save();
        if ($result1 || $result1 == null) {
            $article_id = $articles->id;
            $articleFields= [
                'article_id' => $article_id,
                'label_id' => $data['label_id']
            ];
            $result3 = $this->articleLabelEdit($articleFields);
            if ($result3 == 1) {
                if ($data['pic']) {
                    $result2 = $this->uploadPic($data['pic'], 'edit', $article_id);
                    if ($result2 == 1) {
                        // 删除原有的缩略图
                        $thumb = config('upload_path') . '/' . $articles->thumbnail;
                        unlink($thumb);
                        return 1;
                    } else {
                        return $result2;
                    }
                } else { // 如果没有图片上传，也返回1
                    return 1;
                }
            } else {
                return $result3;
            }
        } else {
            return '编辑文章失败';
        }
    }

    // 编辑时维护articleLabel表
    public function articleLabelEdit($articleFields)
    {
        model('ArticleLabel')->edit($articleFields);
        return 1;
    }
}
