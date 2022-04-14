<?php
namespace hbynlsl\spf;

class ComposerScript {
    // 复制文件及目录
    static public function postInstallCmd() {
        copy('vendor/hbynlsl/spf/src/spf', 'spf');
        copy('vendor/hbynlsl/spf/src/routes.php', 'routes.php');
        copy('vendor/hbynlsl/spf/src/.env', '.env');
        copy('vendor/hbynlsl/spf/src/.env.development', '.env.development');
        mkdir('configs');
        copy('vendor/hbynlsl/spf/src/configs/app.php', 'configs/app.php');
        mkdir('public');
        copy('vendor/hbynlsl/spf/src/public/index.php', 'public/index.php');
        mkdir('app');
        mkdir('app/controllers');
        mkdir('app/providers');
        mkdir('app/middlewares');
    }
}