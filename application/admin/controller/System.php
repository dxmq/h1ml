<?php

namespace app\admin\controller;

class System extends Base
{
    // 系统设置列表
    public function sys()
    {
        if ($this->request->isAjax()) {
            $data = [
                'webname' => input('post.webname'),
                'copyright' => input('post.copyright'),
                'friendship_link' => input('post.friendship_link'),
                'contact' => input('post.contact'),
                'web_introduce' => input('post.web_introduce')
            ];
            $result = model('System')->sys($data);
            if ($result == 1) {
                $this->success('设置成功', 'admin/system/sys');
            } else {
                $this->error($result);
            }
        }
        // 取出设置信息
        $systems = model('System')->find();
        $this->assign('systems', $systems);
        return view();
    }
}
