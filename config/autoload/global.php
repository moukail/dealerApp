<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => [
                    'host'     => 'mysql2',
                    'port'     => '3306',
                    'user'     => 'root',
                    'password' => 'root',
                    'dbname'   => 'dealerapp',
                    'driverOptions' => [
                        1002 => 'SET NAMES utf8'
                    ],
                ]
            ]
        ],

        'configuration' => array(
            'orm_default' => array(
                'metadata_cache'    => 'array',
                'query_cache'       => 'array',
                'result_cache'      => 'array',
                'hydration_cache'   => 'array',
                'driver'            => 'orm_default',
                'generate_proxies'  => true,
                'proxy_dir'         => '/../../data/proxy',
                'proxy_namespace'   => 'DoctrineORMModule\Proxy',
                'filters'           => array()
            )
        ),

        'migrations_configuration' => array(
            'orm_default' => array(
                'directory' => __DIR__ . '/../../module/Application/config/migrations',
                'name'      => 'Doctrine Database Migrations',
                'namespace' => 'Application\Migrations',
                'table'     => 'migrations',
                'column'    => 'version',
            ),
        ),

        'driver' => array(
            'Dealer_Driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../../module/Application/src/Entity'
                )
            ),
            'orm_default' => array(
                'class'   => 'Doctrine\ORM\Mapping\Driver\DriverChain',
                'drivers' => array(
                    'Application\Entity' =>  'Dealer_Driver'
                )
            ),
        ),

        'entitymanager' => array(
            'orm_default' => array(
                'connection'    => 'orm_default',
                'configuration' => 'orm_default'
            )
        ),

        'eventmanager' => array(
            'orm_default' => array()
        ),

        'sql_logger_collector' => array(
            'orm_default' => array(),
        ),

        'entity_resolver' => array(
            'orm_default' => array()
        ),

    ],
];
