<?php

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params'      => [
                    'host'     => 'mysql2',
                    'port'     => '3306',
                    'user'     => 'root',
                    'password' => 'root',
                ],
            ],
        ],
    ],
    'redis' => [
        'params' => [
            'host'     => 'redis_prd',
            'port'     => '6379',
        ],
    ],
];
