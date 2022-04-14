<?php

use Pecee\SimpleRouter\SimpleRouter;

// 默认路由
SimpleRouter::get('/', 'Index@index');

// 企业微信认证
SimpleRouter::all('/beforeoauth', 'Wework@beforeoauth');
SimpleRouter::all('/afteroauth', 'Wework@afteroauth');


SimpleRouter::get('/my', 'Index@my');