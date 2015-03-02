<?php

return [
    "dn-acl" => [
        //Access control list (ACL) Roles
        "roles" => [
            "guest" => null,
            "member" => "guest",
            "admin" => "member",
        ],
        //Resources list for ACL
        'resources' => [
            'allow' => [
            ],
            "deny" => [
            ]
        ],
    ],
];
