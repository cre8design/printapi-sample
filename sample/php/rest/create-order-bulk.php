<?php

/**
 * @param string $token
 * @param $orderRequest array [
	'shipping_address' => array$shippingAddress,
	'items' => array $items,
    'order_reference' => string|null $reference,
    'order_message' => string|null $message,
]
 */
function createOrderBulk(string $token, array $orderRequests) {
	$method = 'POST';
	$request = [
		'order_requests' => $orderRequests
	];
    $url = 'https://shop.printingambitions.com/rest/V1/print/order/create';
    $header = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $token
	];
	
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
	
	$response = curl_exec($ch);

	if (!$response || curl_error($ch)) {
		// Your Error handling
	}

	$response = json_decode($response, true);

	if (isset($response['message'])) {
		// Error
    }

	foreach($response as $responseItem) {
		if ($responseItem['has_error']) {
			// Your Error handling
		}
	}

	return $response;
}

$exampleReturnObject = [
	[
		'hasError' => false,
		'order_id' => 'Order Id',
		'order_request' => [
			// Order Request
		]
	],
	[
		'hasError' => true,
		'message' => 'Some error message.',
		'order_request' => [
			// Order Request
		]
	]
	// ...
];