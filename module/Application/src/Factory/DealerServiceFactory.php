<?php
/**
 * Created by PhpStorm.
 * User: ismail
 * Date: 2-2-17
 * Time: 13:45.
 */

namespace Application\Factory;

use Application\Service\DealerService;
use Interop\Container\ContainerInterface;
use Zend\Cache\StorageFactory;
use Zend\ServiceManager\Factory\FactoryInterface;

class DealerServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entitymanager = $container->get('doctrine.entitymanager.orm_default');

        $cache = StorageFactory::factory([
            'adapter' => [
                'name'    => 'redis',
                'options' => [
                    'namespace' => 'appCache',
                    'database'  => 'dealer',
                    'server'    => ['host' => 'redis2', 'port' => '6379', 'timeout' => 300],
                ],
            ],
            'plugins' => [
                // Don't throw exceptions on cache errors
                'exception_handler' => [
                    'throw_exceptions' => false,
                ],
            ],
        ]);

        return new DealerService($entitymanager, $cache);
    }
}
