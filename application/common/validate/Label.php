<?php
/**
 * Created by PhpStorm.
 * User: mint
 * Date: 2018/12/14
 * Time: 18:44
 */

namespace app\common\validate;


use think\Validate;

class Label extends Validate
{
    protected $rule = [
        'labelname|标签名称' => 'require|max:15|unique:label',
        'id' => 'require|number'
    ];

    // 添加时的验证规则
    public function sceneAdd()
    {
        return $this->only(['labelname']);
    }


    // 修改时的验证规则
    public function sceneEdit()
    {
        return $this->only(['labelname', 'id']);
    }
}