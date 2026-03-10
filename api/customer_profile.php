<?php

// Target API
$targetApi = "https://meem.com.my/api/v1/customer/profile";

// Detect request method
$method = $_SERVER['REQUEST_METHOD'];

// Get headers
$headers = getallheaders();
$forwardHeaders = [];



// Forward Authorization Bearer token and other headers
foreach ($headers as $key => $value) {
    if (strtolower($key) == 'authorization') {
        $forwardHeaders[] = "Authorization: " . $value;
    }
    if (strtolower($key) == 'content-type') {
        $forwardHeaders[] = "Content-Type: " . $value;
    }
}
$forwardHeaders[] = "Accept: application/json";



// Build query string for GET
if ($method == 'GET' && !empty($_GET)) {
    $targetApi .= '?' . http_build_query($_GET);
}
$ch = curl_init($targetApi);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $forwardHeaders);
// Handle POST
if ($method == 'POST') {
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
}
// Execute request
$response = curl_exec($ch);
curl_close($ch);

// Convert response to array (assuming JSON)
$data = json_decode($response, true);
// 🔧 Modify response here
if (isset($data['price'])) {
    $data['price'] = $data['price'] * 1.02; // example modification
}
//if isset $data['data']['gss_balance'], convert it from string to double
if (isset($data['data']['gss_balance'])) {
    $data['data']['gss_balance'] = (double) $data['data']['gss_balance'];
}

/*
create a percentage. there are multiple thresholds for the percentage. if gss_balance is below 1, the threshold  is 1.
gss_balance is a gold in a gram for example 0.0094

threshold must have the following values: 0.1,0.5, 1, 10, 100, 1000, 2000, 3000, 5000, 10000
$threshold_array = [0.1,0.5, 1, 10, 100, 1000, 2000, 3000, 5000, 10000];
*/
//$data['data']['gss_balance'] = 0.4; // example balance for testing
$gss_threshold_array = [0.01, 0.1,0.5, 1, 10, 100, 1000, 2000, 3000, 5000, 10000];
$gss_balance = $data['data']['gss_balance'];
$gss_user_progress_threshold = 1; // default threshold
foreach ($gss_threshold_array as $t) {
    if ($gss_balance < $t) {
        $gss_user_progress_threshold = $t;
        break;
    }
}
//progress_value must use 4 decimal places
$gss_user_progress_value = number_format($gss_user_progress_threshold - $gss_balance, 4);
$gss_user_progress_percentage = ($gss_balance / $gss_user_progress_threshold) * 100;

$gss_progress = [
    'balance' => $gss_balance,
    'threshold' => $gss_user_progress_threshold,
    'progress_value' => (double)$gss_user_progress_value,
    'progress_percentage' => $gss_user_progress_percentage,
    'progress_bar_percentage' => $gss_user_progress_percentage / 100
];
$data['data']['gss_progress'] = $gss_progress;

//call another API to get Gold Price. The API is GET https://meem.com.my/api/v1/price/gwa and use same Authorization Bearer token. Then add the gold price to the response as data.gold_price
$goldPriceApi = "https://meem.com.my/api/v1/price/gwa";
$ch = curl_init($goldPriceApi);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $forwardHeaders);
$goldPriceResponse = curl_exec($ch);
curl_close($ch);
$goldPriceData = json_decode($goldPriceResponse, true);

if (isset($goldPriceData['data']['buy_price'])) {
    $data['data']['gold_price'] = (double)number_format($goldPriceData['data']['buy_price'], 2, '.', '');
    //calculate the gold value of the user's gss balance and add it to the response as data.gss_gold_value
    $data['data']['gss_gold_value'] = (double)number_format($data['data']['gss_balance'] * $data['data']['gold_price'], 2, '.', '');
}

$gss_detail = [
    'balance' => $gss_balance,
    'gold_price' => $data['data']['gold_price'],
    'gold_value' => $data['data']['gss_gold_value']
];
$data['data']['gss_detail'] = $gss_detail;





// Return modified JSON
header('Content-Type: application/json');
echo json_encode($data);

?>