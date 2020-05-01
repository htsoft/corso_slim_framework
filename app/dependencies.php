<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get('settings');

            $loggerSettings = $settings['logger'];
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },
        PDO::class => function (ContainerInterface $c) {
            $settings = $c->get('settings');

            $dbSettings = $settings['db'];
            $host = $dbSettings['host'];
            $driver = $dbSettings['driver'];
            $dbname = $dbSettings['database'];
            $charset = $dbSettings['charset'];
            $dsn = "$driver:host=$host;dbname=$dbname;charset=$charset";

            return new PDO($dsn, $dbSettings['username'], $dbSettings['password'], $dbSettings['flags']);
        },
    ]);
};
