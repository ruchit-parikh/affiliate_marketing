<?php

/**
 * Return your response in json format
 * 
 * @param string $response_type
 * @param string $response_messsage
 * @param array $response = []
 * @param mix $status_code = 200
 * @param array $headers = []
 * @param mix $options = 0
 * @return JSON
 */
function jsonResponse(
    string $response_type, 
    string $response_messsage, 
    array $response = [], 
    $status_code = 200, 
    array $headers = [], 
    $options = 0
) {
    $response['status'] = $response_type;
    $response['message'] = $response_messsage;
    return response()->json($response, $status_code, $headers, $options);
}