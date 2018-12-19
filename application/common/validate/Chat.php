<?php
/**
 * Created by PhpStorm.
 * User: mint
 * Date: 2018/12/18
 * Time: 22:15
 */

namespace app\common\validate;


use think\Validate;

class Chat extends Validate
{
    protected $rule = [
        'id' => 'require|number',
        'content|碎语内容' => 'require|max:50',
        'is_show|是否显示' => 'require|number'
    ];

    public function sceneAdd()
    {
        return $this->only(['content', 'is_show']);
    }

    public function sceneEdit()
    {
        return $this->only(['content', 'is_show', 'id']);
    }
}