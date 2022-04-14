<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

// 默认路由
// SimpleRouter::get('/', 'Index@index');
Router::get('/', function() {
    return 'index page.';
});
