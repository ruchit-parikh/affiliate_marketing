<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Commissions Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during commissions manipulation for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */
    'store' => [
        'success' => 'New commission type stored successfully.', 
        'failed' => 'Failed to store a new commission type.',
        'log' => 'New Commission :commission_name is created by :user.'
    ],

    'update' => [
        'success' => 'Commission type updated successfully.', 
        'failed' => 'Failed to update a commission type.',
        'log' => 'Commission :commission_name is modified by :user.'
    ],

    'destroy' => [
        'success' => 'Commission type deleted successfully.', 
        'failed' => 'Failed to delete a commission type.',
        'log' => 'Commission :commission_name is deleted by :user.'
    ],

    'restored' => [
        'success' => 'Commission restored successfully.', 
        'failed' => 'Failed to restore a commission.',
        'log' => 'Commission :commission_name is restored by :user.'
    ],

    'force_delete' => [
        'success' => 'Commission type is removed from system successfully.', 
        'failed' => 'Failed to remove a commission type from system.',
        'log' => 'Commission :commission_name is removed from system by :user.'
    ]
];