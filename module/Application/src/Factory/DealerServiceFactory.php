<?php
/**
 * Created by PhpStorm.
 * User: ismail
 * Date: 2-2-17
 * Time: 13:45
 */

namespace Application\Factory;

use Application\Service\DealerService;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class DealerServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entitymanager = $container->get('doctrine.entitymanager.orm_default');
        return new DealerService($entitymanager);
    }
}
