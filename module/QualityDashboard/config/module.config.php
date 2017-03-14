<?php
/**
 * Created by PhpStorm.
 * User: ismail
 * Date: 14-3-17
 * Time: 15:11
 */

namespace QualityDashboard;

//use Zend\Router\Http\Literal;
//use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'qd_home' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route'    => '/quality-dashboard',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            //Controller\IndexController::class => InvokableFactory::class,
            //Controller\DealerController::class => 'Application\Factory\DealerControllerFactory',
        ],
    ],

    'service_manager' => [
        'factories' => [
            //__NAMESPACE__ . '\Cache\Redis' => __NAMESPACE__ . '\Factory\RedisFactory',
            //'Application\Service\Dealer' => 'Application\Factory\DealerServiceFactory',
        ]
    ],

    'view_manager' => [
        'template_map' => [
            //'nieuws/layout'           => __DIR__ . '/../view/layout/layout.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],

];