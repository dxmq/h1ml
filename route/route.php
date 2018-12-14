<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::group('admin', function() {
   Route::rule('/', 'admin/admin/login', 'get|post');
   Route::rule('index', 'admin/index/index', 'get');
   Route::rule('logout', 'admin/index/logout', 'post');
   Route::rule('catelst', 'admin/cate/lst', 'get');
   Route::rule('cateadd', 'admin/cate/add', 'get|post');
   Route::rule('cateedit/[:id]', 'admin/cate/edit', 'get|post');
   Route::rule('catedel', 'admin/cate/del', 'post');
   Route::rule('catesort', 'admin/cate/sort', 'post');
   Route::rule('tagslst', 'admin/tags/lst', 'get');
   Route::rule('tagsadd', 'admin/tags/add', 'get|post');
   Route::rule('tagsedit/[:id]', 'admin/tags/edit', 'get|post');
   Route::rule('tagsdel', 'admin/tags/del', 'post');
});