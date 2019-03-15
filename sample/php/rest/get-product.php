<?php

/**
 * @param string $token
 * @param string $product
 * @return array
 * @throws Exception
 */
function getProduct(string $token, string $product)
{
    $method = 'GET';
    $url = 'http://shop.printingambitions.com/rest/V1/print/product/get/' . $product;
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
    $info = curl_getinfo($ch);

    if (curl_error($ch)) {
        throw new Exception(curl_error($ch));
    }

    $response = json_decode($response, true);

    if (isset($response['message'])) {
        throw new Exception($response['message']);
    }

    return $response;
}

// $exampleRequest = getProduct('{{TOKEN}}', 'pl4-20-30-map');