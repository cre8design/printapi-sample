<?php

/**
 * @param string $token
 * @param array $shippingAddress
 * @param array $items
 * @param string|null $reference
 * @param string|null $message
 * @return array
 * @throws Exception
 */
function createOrder(
    string $token, 
    array $shippingAddress,
    array $items,
    string $reference = null, 
    string $message = null
){
    $method = 'POST';
    $request = [
        'order_request' => [
            'shipping_address' => $shippingAddress,
            'items' => $items,
            'order_reference' => $reference,
            'order_message' => $message,
        ]
    ];
    $url = 'https://shop.printingambitions.com/rest/V1/print/order/create';
    $header = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $token
    ];


    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));

    $response =  curl_exec($ch);

    if (curl_error($ch)) {
        throw new Exception(curl_error($ch));
    }

    $response = json_decode($response, true);

    if (isset($response['message'])) {
        throw new Exception($response['message']);
    }

    return $response;
}

// $exampleRequest = createOrder(
//         '{{TOKEN}}',
//         [
//             'order_request' => [
//                 'shipping_address' => [
//                     'firstname' => 'Yannik',
//                     'lastname' => 'Schienke',
//                     'countryId' => 'NL',
//                     'postcode' => '4859DE',
//                     'city' => 'Gronau',
//                     'street' => 'Maybach Str. 4',
//                     'telephone' => '015758798708',
//                     'email' => 'yannik@printingambitions.com'
//                 ],
//                 items => [
//                     [
//                         'product' => 'pl4',
//                         'qty' => 1,
//                         'layout' => [
//                             'print_file_url' => 'http://some.url.com/file.pdf',
//                         ]
//                     ]
//                 ]
//             ]
//         ]
// );

// echo print_r($exampleRequest);