<?php

namespace app\index\controller;

/**
 * 随言碎语
 * Class Chat
 * @package app\index\controller
 */
class Chat extends Base
{
    public function chat()
    {
        $chats = model('Chat')->select();
        $viewData = [
            'chats' => $chats,
            'cate_id' => 'chat'
        ];
        $this->assign($viewData);
        return view();
    }
}
