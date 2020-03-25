<?php

/**
 * Format of response array:
 * $role => [
 *  ... // User Info // ....
 * ]
 */
return [
    'admin' => [
        'username' => 'admin', 
        'name' => 'Admin',
        'email' => 'admin@affiliate-marketing.com', 
        'password' => '123456789',
        'status' => 'active'
    ], 
    'customer' => [
        'username' => 'root', 
        'name' => 'Root', 
        'email' => 'root@affiliate-marketing.com', 
        'password' => '123456789', 
        'status' => 'active'
    ]
];