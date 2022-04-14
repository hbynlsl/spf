<?php
namespace hbynlsl\spf;

class Cache {
    // 静态调用cache方法
    public static function __callStatic($name, $arguments) {
        $arguments[0] = Session::id() . '_' . $arguments[0];
        return call_user_func_array([app('cache'), $name], $arguments);
    }

    // store方法
    static public function store($key, $value = null) {
        return app('cache')->store(Session::id() . '_' . $key, $value, config('app.php', 'cache_time'));
    }
};