<?php
// 服务容器方法
if (!function_exists('app')) {
    function app(string $id = '', string $serviceClass = '', array $params = [])
    {
        // 获取服务容器对象
        $app = \spf\Application::getInstance();
        // 获取参数个数
        $numArgs = func_num_args();
        // 根据参数个数执行不同操作
        switch ($numArgs) {
            case 0:
                return $app;
            case 1:
                return $app->get($id);
            default:
                $app->register($id, $serviceClass, $params);
        }
    }
}