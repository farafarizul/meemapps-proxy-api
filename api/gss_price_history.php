<?php
//call API to get Gold Price History. The API is GET https://meem.com.my/api/v1/price/gwa-history.
$goldPriceHistoryApi = "https://meem.com.my/api/v1/price/gwa-history";
$forwardHeaders[] = "Accept: application/json";
$ch = curl_init($goldPriceHistoryApi);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $forwardHeaders);
$history_return_curl = curl_exec($ch);
// Convert response to array (assuming JSON)
$history_data = json_decode($history_return_curl, true);

$output_history = [];

// 🔧 Modify response here if needed

if (isset($history_data['data']) && is_array($history_data['data'])) {
    foreach ($history_data['data'] as $key => $value) {
        $output_history = $value;
    }
}

//foreach $output_history['buy_price'], convert it to double and keep 2 decimal places.
foreach ($output_history as $key => $value) {
    if (isset($value['buy_price'])) {
        $output_history[$key]['buy_price'] = (double)number_format($value['buy_price'], 2, '.', '');
    }
    //same goes for sell_price
    if (isset($value['sell_price'])) {
        $output_history[$key]['sell_price'] = (double)number_format($value['sell_price'], 2, '.', '');
    }
}





$output = [
    'status' => 'success',
    'data' => $output_history
];

// Return modified JSON
header('Content-Type: application/json');
echo json_encode($output);




?>