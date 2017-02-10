<?php
/**
 * Created by PhpStorm.
<<<<<<< HEAD
 * User: Imoukafih
 * Date: 9-2-2017
 * Time: 16:18
=======
 * User: ismail
 * Date: 9-2-17
 * Time: 20:16
>>>>>>> 3b783e4b2f558b0717d7e3f0d2d1076974733b1c
 */

namespace Application\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class RedisFactory implements FactoryInterface
{
<<<<<<< HEAD
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $redis = new Redis();
        $redis->connect('redis2', 6379);
=======

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $redis = new \Redis();
        $redis->connect('redis2', 6379);

>>>>>>> 3b783e4b2f558b0717d7e3f0d2d1076974733b1c
        return $redis;
    }
}