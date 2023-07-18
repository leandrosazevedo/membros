<?php

declare(strict_types=1);

use App\Repository\UsuarioRepository;
use Psr\Container\ContainerInterface;

$container['usuario_repository'] = static fn (
    ContainerInterface $container
): UsuarioRepository => new UsuarioRepository($container->get('db'));