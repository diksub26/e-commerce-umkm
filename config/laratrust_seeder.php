<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'admin' => [
            'users' => 'c,r,u,d',
            'payments' => 'c,r,u,d',
            'profile' => 'r,u',
        ],
        'umkm' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u',
            'payments' => 'c,r,u,d',
            'master-data' => 'm',
            'product' => 'c,u,d,m',
            'category-product' => 'c,u,d,m',
            'master-pengiriman' => 'c,u,d,m',
        ],
        'reseller' => [
            'profile' => 'r,u',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        'm' => 'manage'
    ]
];
