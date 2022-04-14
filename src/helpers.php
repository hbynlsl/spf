<?php

use hbynlsl\spf\Session;
use Noodlehaus\Config;
use Pecee\Http\Request;
use Pecee\Http\Response;
use Pecee\Http\Url;
use Pecee\SimpleRouter\SimpleRouter as Router;

/**
 * session辅助函数
 * @param string $key session-key
 * @param mixed $val session-value（若为空，表示获取session值）
 */
function session(string $key, $val = '') {
    if (!$val) { // 获取或判断session存在性
        if (substr($key, -1) == '?') {  // 判断是否存在
            return Session::has($key);
        }
        return Session::get($key);
    }
    Session::set($key, $val);
}

/**
 * 获取配置文件信息
 * @param string $file 配置文件路径
 * @param string $key 待获取的配置项（若无，则返回所有配置项）
 */
function config(string $file, $key = '') {
    if (!$key) {
        return Config::load(ROOT_PATH . '/configs/' . $file)->all();
    }
    return Config::load(ROOT_PATH . '/configs/' . $file)->get($key);
}

/**
 * Get url for a route by using either name/alias, class or method name.
 *
 * The name parameter supports the following values:
 * - Route name
 * - Controller/resource name (with or without method)
 * - Controller class name
 *
 * When searching for controller/resource by name, you can use this syntax "route.name@method".
 * You can also use the same syntax when searching for a specific controller-class "MyController@home".
 * If no arguments is specified, it will return the url for the current loaded route.
 *
 * @param string|null $name
 * @param string|array|null $parameters
 * @param array|null $getParams
 * @return \Pecee\Http\Url
 * @throws \InvalidArgumentException
 */
function url(?string $name = null, $parameters = null, ?array $getParams = null): Url
{
    return Router::getUrl($name, $parameters, $getParams);
}

/**
 * @return \Pecee\Http\Response
 */
function response(): Response
{
    return Router::response();
}

/**
 * @return \Pecee\Http\Request
 */
function request(): Request
{
    return Router::request();
}

/**
 * Get input class
 * @param string|null $index Parameter index name
 * @param string|mixed|null $defaultValue Default return value
 * @param array ...$methods Default methods
 * @return \Pecee\Http\Input\InputHandler|array|string|null
 */
function input($index = null, $defaultValue = null, ...$methods)
{
    if ($index !== null) {
        return request()->getInputHandler()->value($index, $defaultValue, ...$methods);
    }

    return request()->getInputHandler();
}

/**
 * @param string $url
 * @param int|null $code
 */
function redirect(string $url, ?int $code = null): void
{
    if ($code !== null) {
        response()->httpCode($code);
    }

    response()->redirect($url);
}

/**
 * Get current csrf-token
 * @return string|null
 */
function csrf_token(): ?string
{
    $baseVerifier = Router::router()->getCsrfVerifier();
    if ($baseVerifier !== null) {
        return $baseVerifier->getTokenProvider()->getToken();
    }

    return null;
}

// 服务容器方法
function app(string $id = '', string $serviceClass = '', array $params = []) {
    // 获取服务容器对象
    $app = \hbynlsl\spf\Application::getInstance();
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
