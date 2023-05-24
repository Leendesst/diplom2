<?php
declare(strict_types=1);

use App\Domain\Service\ServiceRepository;
use App\Domain\Work\WorkRepository;
use App\Domain\Subscribe\SubscribeRepository;
use App\Infrastructure\Persistence\Service\PDOServiceRepository;
use App\Infrastructure\Persistence\Work\PDOWorkRepository;
use App\Infrastructure\Persistence\Subscribe\PDOSubscribeRepository;
use DI\ContainerBuilder;
use function DI\autowire;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        ServiceRepository::class => autowire(PDOServiceRepository::class),
        WorkRepository::class => autowire(PDOWorkRepository::class),
        SubscribeRepository::class => autowire(PDOSubscribeRepository::class),
    ]);
};
