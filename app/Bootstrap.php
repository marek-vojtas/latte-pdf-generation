<?php
declare(strict_types=1);

namespace App;

use Nette\Bootstrap\Configurator;

class Bootstrap
{
    public static function boot(): Configurator
    {
        $configurator = new Configurator;
        $rootDir = dirname(__DIR__);

        $logDir = $rootDir . '/log';
        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true);
        }

        $tempDir = $rootDir . '/temp';
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        $configurator->setDebugMode(true);
        $configurator->enableTracy($logDir);
        $configurator->setTempDirectory($tempDir);

        $configurator->createRobotLoader()
            ->addDirectory(__DIR__)
            ->register();

        $configurator->addConfig(__DIR__ . '/config/common.neon');

        return $configurator;
    }
}
