<?php
/**
 * Created by PhpStorm.
 * User: mint
 * Date: 2018/12/15
 * Time: 9:42
 */

namespace app\common\validate;


use think\Validate;

class Article extends Validate
{
    protected $rule = [
        'id' => 'require|number',
        'title|标题' => 'require|max:50|unique:article',
        'author|作者' => 'require|max:15',
        'cate_id|栏目' => 'number',
        'is_show|是否展示' => 'require|in:0,1',
        'is_top|是否置顶' => 'require|in:0,1',
        'content|内容' => 'require'
    ];

    public function sceneAdd()
    {
        return $this->only(['title', 'author', 'is_show', 'is_top', 'content', 'cate_id']);
    }

    public function sceneEdit()
    {
        return $this->only(['title', 'author', 'is_show', 'is_top', 'content', 'cate_id'])->remove('title', 'unique');
    }
}