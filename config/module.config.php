<?php
return [
    'router' => [
        'routes' => [
            'api-rpc' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/rpc'
                ],
                'child_routes' => [
                    'identity' => [
                        'type' => 'Segment',
                        'may_terminate' => true,
                        'options' => [
                            'route' => '/identity',
                            'defaults' => [
                                'controller' => 'Strapieno\Identity\Api\V1\RpcController',
                                'action' => 'getIdentity'
                            ],
                        ]
                    ]
                ]
            ]
        ]
    ],
    'controllers' => [
        'invokables' => [
            'Strapieno\Identity\Api\V1\RpcController' => 'Strapieno\Identity\Api\V1\RpcController'
        ]
    ],
    'zf-rpc' => [
        'Strapieno\Identity\Api\V1\RpcController' => [
            'service_name' => 'identity',
            'http_methods' => ['GET'],
            'route_name' => 'api-rpc/identity',
        ]
    ],
     'zf-content-negotiation' => [
         'controllers' => [
             'Strapieno\Identity\Api\V1\RpcController' => 'HalJson',
         ],
        'accept_whitelist' => [
            'Strapieno\Identity\Api\V1\RpcController' => [
                'application/hal+json',
                'application/json',
            ]

        ],
        'content_type_whitelist' => [
            'Strapieno\Identity\Api\V1\RpcController' => [
                'application/json',
            ]
        ]
    ],
    'zf-hal' => [
        'metadata_map' => [
            'Strapieno\User\Model\Entity\UserEntity' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api-rest/user',
                'route_identifier_name' => 'user_id',
                'hydrator' => 'UserApiHydrator',
            ],
        ],
    ],
];

