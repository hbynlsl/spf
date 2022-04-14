<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

// 默认路由
// Router::get('/', 'Index@index');
Router::get('/', function() {
    return 'index page.';
});
