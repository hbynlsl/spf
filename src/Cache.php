<?php
namespace hbynlsl\spf;

class Cache {
    // 静态调用cache方法
    public static function __callStatic($name, $arguments) {
        return call_user_func_array([app('cache'), $name], $arguments);
    }

    // store方法
    static public function store($key, $value = null) {
        return app('cache')->store($key, $value, config('app.php', 'cache_time'));
    }
};