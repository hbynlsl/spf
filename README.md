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
