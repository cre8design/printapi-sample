<?php

/**
 * @param string $token
 * @param int $page
 * @return array
 * @throws Exception
 */
function getOrderList(string $token, int $page = 1)
{
    $url = 'https://shop.printingambitions.com/rest/V1/print/order/list/' . $page;
    $method = 'GET';
    $header = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $token
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

    $response = curl_exec($ch);

    if (curl_error($ch)) {
        throw new Exception(curl_error($ch));
    }

    $response = json_decode($response, true);

    if (isset($response['message'])) {
        throw new Exception($response['message']);
    }

    return $response;
}

// $exampleRequest = getOrderList('{{TOKEN}}', 1);