# spf

simple php framework

## 使用方法

1. 在项目根目录下创建composer.json文件，复制以下内容到composer.json文件中。

```
{
    "require": {
        "hbynlsl/spfframework": "^0.1.0"
    },
    "autoload": {
        "psr-4": {
            "app\\": "app/"
        }
    },
    "scripts": {
        "post-install-cmd": [
            "hbynlsl\\spf\\ComposerScript::postInstallCmd"
        ]
    }
}
```

2. 执行命令

```
composer install 
composer run-script post-install-cmd
```

## spf命令行

```
php spf serve     启动开发服务器（8090端口）
php spf list      显示命令列表
php spf make:controller 控制器类名称   创建控制器类文件
php spf make:resource 控制器类名称     创建资源控制器类文件
php spf make:provider 服务提供者类名称  创建服务提供者类
php spf make:middleware 中间件类名称    创建中间件类
```

## 使用方法
1. 在 routes.php 文件中定义路由
2. 在 configs/app.php 文件中设置配置信息
3. 使用命令行启动应用程序、创建类文件

## 辅助函数
```
dump()                      查看调试信息
dd()                        查看调试信息并结束程序执行
app()                       获取应用程序（容器）对象
app(id)                     获取服务提供者对象
app(id, ::class)            向容器中添加服务提供者
request()                   获取请求对象
response()                  获取响应对象
input(name, default)        获取请求参数
redirect(url)               页面重定向
url(name)                   获取路由url
```