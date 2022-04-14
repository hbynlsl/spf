<?php
namespace hbynlsl\spf;

class Session {
    // session开启状态
    static protected $sessionStatus = false;

    // 获取当前session_id
    static public function id() {
        static::_init();
        return session_id();
    }

    // 获取Session数据
    static public function get(string $key) {
        static::_init();
        // 获取session
        return json_decode($_SESSION[$key]);
    }

    // 设置Session数据
    static public function set(string $key, $val) {
        static::_init();
        // 处理类型
        $_SESSION[$key] = json_encode($val);
    }

    // session数据是否存在
    static public function has(string $key) {
        static::_init();
        return key_exists($key, $_SESSION);
    }

    // 清空session
    static public function clear() {
        static::_init();
        session_destroy();
        $_SESSION = [];
    }

    // 开启session
    static protected function _init() {
        if (!static::$sessionStatus) {
            session_start();
            static::$sessionStatus = true;
        }
    }
}