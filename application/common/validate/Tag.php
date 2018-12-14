<?php
/**
 * Created by PhpStorm.
 * User: mint
 * Date: 2018/12/14
 * Time: 20:03
 */

namespace app\common\validate;


use think\Validate;

class Tag extends Validate
{
    protected $rule = [
        'tags|标签名称' => 'require|max:15|unique:tags',
        'id' => 'require'
    ];

    public function sceneAdd()
    {
        return $this->only(['tags']);
    }

    public function sceneEdit()
    {
        return $this->only(['tags', 'id']);
    }
}