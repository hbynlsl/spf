<?php
namespace spf;

use Pecee\SimpleRouter\SimpleRouter;
use Psr\Container\ContainerInterface;

define('ROOT_PATH', realpath('./'));
define('APP_PATH', realpath('./app'));
define('PUBLIC_PATH', realpath('./public'));

class Application implements ContainerInterface {
    // 启动应用程序
    static public function runApplication() {
        // 启动应用
        static::getInstance()->run();
    }

    // 启动应用程序
    public function run() {
        // 创建实例对象
        static::$instance = static::getInstance();
        // 加载配置文件
        $configs = \Noodlehaus\Config::load(ROOT_PATH . '/configs/app.php');
        // whoops
        if ($configs['display_errors'] && $configs['show_whoops']) {
            $whoops = new \Whoops\Run;
            $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
            $whoops->register();
        }
        // 自动注册服务容器
        foreach ($configs['providers'] as $id => $serviceClass) {
            static::$instance->register($id, $serviceClass);
        }
        // 绑定全局中间件
        SimpleRouter::group([
            'namespace' =>  $configs['controller_namespace'],
            'middleware' =>  $configs['global_middleware'],
        ], function () {
            require_once ROOT_PATH . '/routes.php';
        });
        // 启动应用程序
        SimpleRouter::start();
    }

    /**
     * 绑定服务类
     * @param string $id 服务标签名称
     * @param string $serviceClass 服务类名称（含命名空间）
     * @param array $params 服务类构造参数
     */
    public function register(string $id, string $serviceClass, array $params = []) {
        static::$instance = static::getInstance();
        // 若当前服务类已存在
        if (!static::$instance->has($id)) {
            static::$instance->services[$id] = new $serviceClass($params);
        }   
        // 返回当前对象（链式操作）
        return static::$instance;
    }

    // 获取服务类
    public function get(string $id) {
        static::$instance = static::getInstance();
        // 若当前服务类已存在
        if (!static::$instance->has($id)) {
            return null;
        }   
        return static::$instance->services[$id];
    }

    // 判断服务类是否存在
    public function has(string $id): bool {
        static::$instance = static::getInstance();
        // 若当前服务类已存在
        return key_exists($id, static::$instance->services);
    }

    // 获取实例对象（单例）
    static public function getInstance() {
        if (!static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    // 构造方法
    protected function __construct() {
        // 加载配置文件
        if (env('application_mode') == 'development') {
            loadenv(ROOT_PATH . '/.env.development');
        }
    }

    // 服务对象数组
    protected $services = [];

    // 实例对象
    static protected $instance = null;
}