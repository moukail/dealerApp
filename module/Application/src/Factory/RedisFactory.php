<?php
/**
 * Created by PhpStorm.
 * User: ismail
 * Date: 9-2-17
 * Time: 20:16
 */

namespace Application\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class RedisFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $redis = new \Redis();
        $redis->connect('redis2', 6379);

        return $redis;
    }
}