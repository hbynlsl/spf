<?php
namespace hbynlsl\spf;

define('ROOT_PATH', realpath(__DIR__ . '/../../../../'));

class Command {
    // 命令行数组
    static protected $commands = [
        ['serve', '开发服务器'],
        ['list', '显示命令列表'],
        ['make:controller', '创建控制器类'],
        ['make:resource', '创建资源控制器类'],
        ['make:api', '创建api资源控制器类'],
        ['make:model', '创建模型类'],
        ['make:crud', '同时创建资源控制器类、模型类、视图文件'],
        ['make:provider', '创建服务提供者类'],
        ['make:middleware', '创建中间件类'],
    ];
    // 执行命令
    static public function run($argv) {
        // 获取命令类型
        $commandType = strtolower(trim($argv[1]));
        if ($commandType == 'list') {   // 列出所有命令
            foreach (static::$commands as $command) {
                echo "{$command[0]}\t{$command[1]}\n";
            }
            exit;
        } else if ($commandType == 'serve') {   // 开启开发服务器
            exec('php -S 127.0.0.1:8090 -t public/');
            exit;
        }
        // 判断有无后续参数
        if (count($argv) <= 2) {    // 无后续参数
            echo '缺少参数.';
            exit;
        }
        $className = trim($argv[2]);
        // 处理命令
        switch ($commandType) {
            case 'make:controller': // 创建控制器
                echo "正在创建控制器{$className}...\n";
                static::putStubToFile($className, 'controller');
                echo "控制器 app\\controllers\\{$className} 创建成功!";
                break;
            case 'make:resource':   // 创建资源控制器
                echo "正在创建资源控制器{$className}...\n";
                static::putStubToFile($className, 'resource');
                echo "资源控制器 app\\controllers\\{$className} 创建成功!";
                break;
            case 'make:api':        // 创建api资源控制器
                echo "正在创建api资源控制器{$className}...\n";
                static::putStubToFile($className, 'api');
                echo "api资源控制器 app\\controllers\\{$className} 创建成功!";
                break;
            case 'make:model':      // 创建模型类
                break;
            case 'make:crud':       // 创建资源控制器、模型类、视图文件
                break;
            case 'make:provider':   // 创建服务提供者
                echo "正在创建服务提供者类{$className}Service...\n";
                static::putStubToFile($className, 'provider');
                echo "服务提供者类 app\\providers\\{$className}Service 创建成功!";
                break;
            case 'make:middleware': // 创建中间件
                echo "正在创建中间件类{$className}Middleware...\n";
                static::putStubToFile($className, 'middleware');
                echo "中间件类 app\\middlewares\\{$className}Middleware 创建成功!";
                break;
            default:                // 未指定命令
                echo '命令未定义.';
                break;
        }
    }

    // 辅助函数：获取模板内容
    static protected function getStubContent($category) {
        return file_get_contents(__DIR__ . '/stubs/' . $category . '.stub');
    }
    // 辅助函数：生成类文件
    static function putStubToFile($className, $category) {
        // 先判断'app'目录是否存在
        if (!file_exists(ROOT_PATH . '/app')) {
            mkdir('app');
        }
        // 获取目标文件地址
        switch ($category) {
            case 'controller':
            case 'resource':
            case 'api':
                $dir = ROOT_PATH . '/app/controllers/';
                $file = $dir . $className . '.php';
                break;
            case 'provider':
                $dir = ROOT_PATH . '/app/providers/';
                $file = $dir . $className . 'Service.php';
                break;
            case 'middleware':
                $dir = ROOT_PATH . '/app/middlewares/';
                $file = $dir . $className . 'Middleware.php';
                break;
        }
        // 生成目标文件目录
        if (!file_exists($dir)) {
            mkdir($dir);
        }
        // 写入目标文件
        file_put_contents($file, str_replace(['{%className%}'], [$className], static::getStubContent($category)));
    }
}