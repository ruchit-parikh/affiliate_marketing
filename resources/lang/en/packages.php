<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Packages Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during packages manipulation for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */
    'store' => [
        'success' => 'New package stored successfully.', 
        'failed' => 'Failed to store a new package.', 
        'log' => 'New Package :package_name is created by :user.'
    ],

    'update' => [
        'success' => 'Package updated successfully.', 
        'failed' => 'Failed to update a package.',
        'log' => 'Package :package_name is modified by :user.'
    ],

    'destroy' => [
        'success' => 'Package deleted successfully.', 
        'failed' => 'Failed to delete a package.',
        'log' => 'Package :package_name is deleted by :user.'
    ],

    'restored' => [
        'success' => 'Package restored successfully.', 
        'failed' => 'Failed to restore a package.',
        'log' => 'Package :package_name is restored by :user.'
    ],

    'force_delete' => [
        'success' => 'Package is removed from system successfully.', 
        'failed' => 'Failed to remove a package from system.',
        'log' => 'Package :package_name is removed from system by :user.'
    ]
];