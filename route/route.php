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
Route::rule('articlethumb', '/public/uploads/' . date('Ymd') . '/thumb_$', 'post');
Route::group('admin', function() {
   Route::rule('/', 'admin/admin/login', 'get|post');
   Route::rule('index', 'admin/index/index', 'get');
   Route::rule('logout', 'admin/index/logout', 'post');
    // 管理员相关
    Route::rule('adminadd', 'admin/index/add', 'get|post');
    Route::rule('adminlst', 'admin/index/lst', 'get');
    Route::rule('adminedit/[:id]', 'admin/index/edit', 'get|post');
    Route::rule('admindel', 'admin/index/del', 'post');

    // 栏目相关
   Route::rule('catelst', 'admin/cate/lst', 'get');
   Route::rule('cateadd', 'admin/cate/add', 'get|post');
   Route::rule('cateedit/[:id]', 'admin/cate/edit', 'get|post');
   Route::rule('catedel', 'admin/cate/del', 'post');
   Route::rule('catesort', 'admin/cate/sort', 'post');
   // 标签相关
   Route::rule('labellst', 'admin/label/lst', 'get');
   Route::rule('labeladd', 'admin/label/add', 'get|post');
   Route::rule('labeledit/[:id]', 'admin/label/edit', 'get|post');
   Route::rule('labeldel', 'admin/label/del', 'post');
   // 文章相关
   Route::rule('articlelst', 'admin/article/lst', 'get');
   Route::rule('articleadd', 'admin/article/add', 'get|post');
   Route::rule('articleedit/[:id]', 'admin/article/edit', 'get|post');
   Route::rule('articledel', 'admin/article/del', 'post');
   // 随言碎语
    Route::rule('chatlst', 'admin/chat/lst', 'get');
    Route::rule('chatadd', 'admin/chat/add', 'get|post');
    Route::rule('chatedit/[:id]', 'admin/chat/edit', 'get|post');
    Route::rule('chatdel', 'admin/chat/del', 'post');

   // 系统设置相关
   Route::rule('systemsys', 'admin/system/sys', 'get|post');
   // 回收站
    Route::rule('recyclelst', 'admin/recycle/lst', 'get');
    Route::rule('recover', 'admin/recycle/recover', 'post');
    Route::rule('delete', 'admin/recycle/delete', 'post');

});

// 前台
Route::rule('index', 'index/index/index', 'get');
Route::rule('/', 'index/index/index', 'get');
Route::rule("column/[:id]", 'index/column/index', 'get');
Route::rule("article/detail/[:id]", 'index/article/detail', 'get');
Route::rule("archives", 'index/trace/trace', 'get');
Route::rule("broken_words", 'index/chat/chat', 'get');
Route::rule("label/[:id]", 'index/index/label', 'get');
