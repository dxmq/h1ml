<?php

namespace app\common\model;

use think\Model;

class System extends Model
{
    // 设置
    public function sys($data)
    {
        $validate = new \app\common\validate\System();
        if (! $validate->check($data)) {
            return $validate->getError();
        }
        $systems = $this->find(1);
        $systems->webname = $data['webname'];
        $systems->copyright = $data['copyright'];
        $systems->friendship_link = str_replace('，', ',', $data['friendship_link']);
        $systems->web_introduce = $data['web_introduce'];
        $systems->contact = $data['contact'];
        $result = $systems->save();
        if ($result || $result == null) {
            return 1;
        } else {
            return '设置失败';
        }
    }
}
