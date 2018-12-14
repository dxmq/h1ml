<?php
/**
 * Created by PhpStorm.
 * User: mint
 * Date: 2018/12/14
 * Time: 18:44
 */

namespace app\common\validate;


use think\Validate;

class Cate extends Validate
{
    protected $rule = [
        'catename|栏目名称' => 'require|max:20|unique:cate',
        'sort|排序' => 'require|number|between:0,255|unique:cate',
        'id' => 'require|number'
    ];

    // 添加时的验证规则
    public function sceneAdd()
    {
        return $this->only(['catename', 'sort']);
    }

    // 排序时的验证规则
    public function sceneSort()
    {
        return $this->only(['sort', 'id'])->remove('sort', 'unique');
    }

    // 修改时的验证规则
    public function sceneEdit()
    {
        return $this->only(['catename', 'id']);
    }
}