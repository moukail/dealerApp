<?php
/**
 * Created by PhpStorm.
 * User: Imoukafih
 * Date: 9-2-2017
 * Time: 16:18
 */

namespace Application\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class RedisFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $redis = new Redis();
        $redis->connect('redis2', 6379);
        return $redis;
    }
}