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
function json_response(
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

/**
 * Convert to key value pair
 * 
 * @param array $array
 * @param string $key
 * @param string $value_key
 * 
 * @return array
 */
function associative(array $array, string $key, string $value_key) {
    $result = [];
    foreach ($array as $ele_key => $ele_value) {
        $result_key = associative_helper(explode('.', $key), $ele_value);
        $result_value = associative_helper(explode('.', $value_key), $ele_value);
        if (empty($result_key) && $result_key !== 0) {
            $result_key = $ele_key;
        }
        if (empty($result_value) && $result_value !== 0) {
            $result_value = $ele_value;
        }
        $result[$result_key] = $result_value;
    }
    return $result;
}

/**
 * Helper to fetch nested value based on key
 * 
 * @param array $array
 * @param array $keys
 * @param array $values
 * 
 * @return array
 */
function associative_helper(array $keys, array $values) {
    $value = $values[array_shift($keys)] ?? '';
    if (is_array($value)) {
        $value = associative_helper($keys, $value);
    }
    return $value;
}