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
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host'     => 'localhost',
                    'port'     => '3306',
                    'user'     => 'root',
                    'password' => 'root',
                    'dbname'   => 'dealerapp',
                    'driverOptions' => array(
                        1002 => 'SET NAMES utf8'
                    ),
                )
            )
        ),

        'configuration' => array(
            'orm_default' => array(
                'metadata_cache'    => 'array',
                'query_cache'       => 'array',
                'result_cache'      => 'array',
                'hydration_cache'   => 'array',
                'driver'            => 'orm_default',
                'generate_proxies'  => true,
                'proxy_dir'         => 'data/DoctrineORMModule/Proxy',
                'proxy_namespace'   => 'DoctrineORMModule\Proxy',
                'filters'           => array()
            )
        ),

        'driver' => array(
            'Crawler_Driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../../module/Application/src/Entity'
                )
            ),
            'orm_default' => array(
                'class'   => 'Doctrine\ORM\Mapping\Driver\DriverChain',
                'drivers' => array(
                    'Crawler\Entity' =>  'Crawler_Driver'
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

    ),
];
