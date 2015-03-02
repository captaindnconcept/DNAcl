# DNAcl
Zf2 Module for Access Control List

This module provides an easy way to create access control list for zf2 from a config array

```php
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
```

