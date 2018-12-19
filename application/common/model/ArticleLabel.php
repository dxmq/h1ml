<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;
use think\model\Pivot;

class ArticleLabel extends Model
{
    // 软删除
    use SoftDelete;
    protected $autoWriteTimestamp = true;

    protected $pk = 'article_id';
    public function add($articleFields)
    {
        foreach ($articleFields['label_id'] as $k => $v) {
            $this->insert([
                'article_id' => $articleFields['article_id'],
                'label_id' => $v,
                'create_time' => time(),
                'update_time' => time()
            ]);
        }
    }

    public function edit($articleFields)
    {
        if ($articleFields['label_id']) {
            // 先删除
            $this->where('article_id', $articleFields['article_id'])->delete();
            foreach ($articleFields['label_id'] as $k => $v) {
                $this->save([
                    'article_id' => $articleFields['article_id'],
                    'label_id' => $v,
                ]);
            }
        } else {
            // 没有标签直接删除
            $this->where('article_id', $articleFields['article_id'])->delete();
        }
    }
}
