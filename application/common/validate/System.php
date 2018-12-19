<?php
/**
 * Created by PhpStorm.
 * User: mint
 * Date: 2018/12/16
 * Time: 10:50
 */

namespace app\common\validate;


use think\Validate;

class System extends Validate
{
    protected $rule = [
        'webname|网站名称' => 'require|max:30',
        'copyright|版权信息' => 'require|max:30',
        'friendship_link|友情链接' => 'max:150',
        'web_introduce|网站介绍' => 'max:150',
        'contact|联系方式' => 'max:150',
    ];
}