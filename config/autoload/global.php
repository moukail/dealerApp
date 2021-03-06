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

        'configuration' => [
            'orm_default' => [
                'query_cache'       => 'array',
                'result_cache'      => 'array',
                'metadata_cache'    => 'array',
                'hydration_cache'   => 'array',
                'driver'            => 'orm_default',
                'generate_proxies'  => true,
                'proxy_dir'         => '/../../data/proxy',
                'proxy_namespace'   => 'DoctrineORMModule\Proxy',
                'filters'           => []
            ]
        ],

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
            'orm_default' => array(
                // name of the sql logger collector (used by ZendDeveloperTools)
                'name' => 'other_orm',

                // name of the configuration service at which to attach the logger
                'configuration' => 'doctrine.configuration.orm_default',

                // uncomment following if you want to use a particular SQL logger instead of relying on
                // the attached one
                //'sql_logger' => 'service_name_of_my_dbal_sql_logger',
            ),
        ),

        'entity_resolver' => array(
            'orm_default' => array()
        ),

    ],
];
