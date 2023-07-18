<?php

declare(strict_types=1);

use Pimple\Container;
use Pimple\Psr11\Container as Psr11Container;
use Slim\Factory\AppFactory;

$settings = require __DIR__ . '/Settings.php';
$container = new Container($settings);

return AppFactory::create(new ResponseFactory(), new Psr11Container($container));
