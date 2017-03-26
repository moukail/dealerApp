<?php
/**
 * Created by PhpStorm.
 * User: Imoukafih
 * Date: 9-2-2017
 * Time: 16:18.
 */

namespace Application\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class RedisFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $params = $container->get('config')['redis']['params'];

        $redis = new \Redis();
        $redis->connect($params['host'], $params['port']);

        return $redis;
    }
}
