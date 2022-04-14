<?php
// 全局配置文件
return [
    // 应用程序模式
    'application_mode'  =>  env('application_mode') ?? 'production',
    // 错误信息
    'display_errors'    =>  env('display_errors') ?? true,
    'show_whoops'   =>  env('show_whoops') ?? true,
    // cache信息
    'cache_dir' =>  env('cache_dir') ?? '/runtime/caches',
    'cache_time'    =>  env('cache_time') ?? 3600 * 24,
    // 全局中间件
    'global_middleware'    =>  env('global_middleware') ?? '',
    // 控制器全局命名空间
    'controller_namespace'  =>  env('controller_namespace') ?? 'app\controllers',
    // 服务容器
    'providers' =>  [
        
    ],
];