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

//foreach $output_history['sell_price'], convert it to double and keep 2 decimal places.
foreach ($output_history as $key => $value) {
    if (isset($value['sell_price'])) {
        $output_history[$key]['sell_price'] = (double)number_format($value['sell_price'], 2, '.', '');
    }
    //same goes for sell_price
    if (isset($value['sell_price'])) {
        $output_history[$key]['sell_price'] = (double)number_format($value['sell_price'], 2, '.', '');
    }
}

$price_array = array_column($output_history, 'sell_price');
$date_array = array_column($output_history, 'date');

//make a filter. remove unnecessary data. using GET parameter '1day', '7day', '30day'. If the parameter is not set, return all data. If the parameter is set, filter the data accordingly based on the date. For example, if the parameter is '7day', return only the data from the last 7 days. use timestamp to compare the dates. The date format is assumed to be 'Y-m-d'.
$filter = isset($_GET['filter']) ? $_GET['filter'] : '7day';
$filtered_output_history = [];
if ($filter) {
    $current_date = time();
    foreach ($output_history as $key => $value) {
        //$date_timestamp the given date format is dd/mm/yyyy, so we need to convert it to timestamp. We can use strtotime function to convert it to timestamp.
        $date_timestamp = strtotime(str_replace('/', '-', $value['date']));
        if ($filter == '1day' && $date_timestamp >= $current_date - 86400) {
            $filtered_output_history[] = $value;
        } elseif ($filter == '7day' && $date_timestamp >= $current_date - 604800) {
            $filtered_output_history[] = $value;
        } elseif ($filter == '30day' && $date_timestamp >= $current_date - 2592000) {
            $filtered_output_history[] = $value;
        }
    }
} else {
    $filtered_output_history = $output_history;
}

//i saw the return data has some date duplication. Check for the date and remove any duplicate date.
$unique_dates = [];
foreach ($filtered_output_history as $key => $value) {
    if (in_array($value['date'], $unique_dates)) {
        unset($filtered_output_history[$key]);
    } else {
        $unique_dates[] = $value['date'];
    }
}

//if the filter is set to 30day, make the return date limit to 7 days. this to prevent too much data from being displaying. Choose the output date every 3~4 days based on the date. For example, if the date is 1/1/2022, 4/1/2022, 7/1/2022, 10/1/2022, 13/1/2022, 16/1/2022, 19/1/2022, 22/1/2022, 25/1/2022, 28/1/2022, 31/1/2022. dont use array_filter function. instead, use a foreach loop to filter the data. This is because we need to keep the keys of the array intact. If we use array_filter, the keys will be reindexed and we will lose the original keys.
if ($filter == '30day') {
    $current_date = time();
    $filtered_output_history_30day = [];
    foreach ($filtered_output_history as $key => $value) {
        $filtered_output_history_30day[] = $value;
    }
    //now we have the filtered data for 30day, we need to filter it again to get the data every 3~4 days. We can use a counter to count the number of days and reset it every 3~4 days.
    $final_filtered_output_history_30day = [];
    $counter = 0;
    foreach ($filtered_output_history_30day as $key => $value) {
        if ($counter == 0) {
            $final_filtered_output_history_30day[] = $value;
        }
        $counter++;
        if ($counter == 4) {
            $counter = 0;
        }
    }
    $filtered_output_history = $final_filtered_output_history_30day;
}

//reverse the data to make the latest date at the end of the array.
$filtered_output_history = array_reverse($filtered_output_history);

//filter the data to limi to only 7 data.
if (count($filtered_output_history) > 7) {
    $filtered_output_history = array_slice($filtered_output_history, 0, 7);
}

//get the open value. The open value is the first sell_price in the filtered data. If there is no sell_price, set sell_price to 0.
$open_value = null;
foreach ($filtered_output_history as $key => $value) {
    if (isset($value['sell_price'])) {
        $open_value = $value['sell_price'];
        break;
    }else{
        $open_value = 0;
    }
}

//get high value. The high value is the highest sell_price in the filtered data. If there is no sell_price, use the highest sell_price as the high value.
$high_value = null;
foreach ($filtered_output_history as $key => $value) {
    if (isset($value['sell_price'])) {
        if ($high_value === null || $value['sell_price'] > $high_value) {
            $high_value = $value['sell_price'];
        }
    } else{
        $high_value = 0;
    }
}

//get low value. The low value is the lowest sell_price in the filtered data. If there is no sell_price, set sell_price to 0.
$low_value = null;
foreach ($filtered_output_history as $key => $value) {
    if (isset($value['sell_price'])) {
        if ($low_value === null || $value['sell_price'] < $low_value) {
            $low_value = $value['sell_price'];
        }
    } else{
        $low_value = 0;
    }
}

//get close value. The close value is the last sell_price in the filtered data. If there is no sell_price, set sell_price to 0.
$close_value = null;
foreach (array_reverse($filtered_output_history) as $key => $value) {
    if (isset($value['sell_price'])) {
        $close_value = $value['sell_price'];
        break;
    } else{
        $close_value = 0;
    }
}


$goldPriceApi = "https://meem.com.my/api/v1/price/gwa";
$ch = curl_init($goldPriceApi);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $forwardHeaders);
$goldPriceResponse = curl_exec($ch);
curl_close($ch);
$goldPriceData = json_decode($goldPriceResponse, true);

$current_gold_price = (double)$goldPriceData['data']['sell_price'] ?? 0;

//get second top data from $filtered_output_history, and compare with $current_gold_price. get percentage change between two values. And return indicator positive or negative. the percentage will always positive number. The indicator will be 'positive' if the current gold price is higher than the second top data, and 'negative' if the current gold price is lower than the second top data. If there is no second top data, set percentage change to 0 and indicator to 'neutral'.
$second_top_data = null;
if (count($filtered_output_history) > 1) {
    $second_top_data = $filtered_output_history[1];
}
$percentage_change = 0;
$indicator = 'neutral';
if ($second_top_data && isset($second_top_data['sell_price'])) {
    $second_top_price = $second_top_data['sell_price'];
    if ($current_gold_price > $second_top_price) {
        $indicator = 'positive';
        $percentage_change = (($current_gold_price - $second_top_price) / $second_top_price) * 100;
    } elseif ($current_gold_price < $second_top_price) {
        $indicator = 'negative';
        $percentage_change = (($second_top_price - $current_gold_price) / $second_top_price) * 100;
    }
}
//make the percentage change to 2 decimal places.
$percentage_change = number_format($percentage_change, 2, '.', '');
//if indicator is positive, set indicator_color to green. if indicator is negative, set indicator_color to red. if indicator is neutral, set indicator_color to gray.
$indicator_color = 'gray';
if ($indicator == 'positive') {
    $indicator_color = 'green';
} elseif ($indicator == 'negative') {
    $indicator_color = 'red';
}

//indicator_symbol will be '▲' if indicator is positive, '▼' if indicator is negative, and '-' if indicator is neutral.
$indicator_symbol = '-';
if ($indicator == 'positive') {
    $indicator_symbol = '▲';
} elseif ($indicator == 'negative') {
    $indicator_symbol = '▼';
}

//percentage_change_symbol, will be '+' if indicator is positive, '-' if indicator is negative, and '' if indicator is neutral.
$percentage_change_symbol = '';
$percentage_change_color = '#808080';
if ($indicator == 'positive') {
    $percentage_change_symbol = '+';
    $percentage_change_color = '#008000';
} elseif ($indicator == 'negative') {
    $percentage_change_symbol = '-';
    $percentage_change_color = '#FF0000';
}

//loop for each date, convert it to date format d/F/Y and call Gemini API to get explaination what is the main event that happened on that date that affecting gold pricing. The Gemini API key is AIzaSyA_hPDr7giMivrCnyY8uAawnRgDGu_bo_I
// The date format for the Gemini API is Y-m-d.
//This is example of the gemini api call.
/*
curl "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent" \
     -H "x-goog-api-key: $GEMINI_API_KEY" \
     -H 'Content-Type: application/json' \
     -X POST \
     -d '{
           "contents": [
             {
               "parts": [
                 {
                   "text": "What is the main event that happened on $date that affecting gold pricing?"
                 }
               ]
             }
           ]
         }'

 */
//save the response from Gemini API to a folder gemini_events with the filename as the date in Y-m-d format. For example, if the date is 2024-01-01, the filename should be 2024-01-01.json. The response from Gemini API should be saved in JSON format.
//check if the folder gemini_events exists, if not create it.
//return each explaination to each date array. name it as 'event_explaination'. The explaination will be the response from Gemini API. The explaination will be in JSON format. The explaination will be saved in the same array as the date and sell_price. For example, if the date is 2024-01-01 and the sell_price is 100, the array will be like this:
//check if the json file with corresponding date already exists in the gemini_events folder. If it exists, read the explaination from the file instead of calling the Gemini API again. This is to reduce the number of API calls and improve performance.
if (!file_exists('gemini_events')) {
    mkdir('gemini_events', 0777, true);
}

foreach ($filtered_output_history as $key => $value) {
    $date = date('Y-m-d', strtotime(str_replace('/', '-', $value['date'])));
    $gemini_event_file = 'gemini_events/' . $date . '.json';
    if (file_exists($gemini_event_file)) {
        $event_explaination = json_decode(file_get_contents($gemini_event_file), true);
    } else {
        $gemini_api_url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent";
        $gemini_api_key = "AIzaSyA_hPDr7giMivrCnyY8uAawnRgDGu_bo_I";
        $post_data = [
            "contents" => [
                [
                    "parts" => [
                        [
                            "text" => "What is the main event happened on $date that affecting  up and down gold pricing? give the explaination in less than 100 characters."
                        ]
                    ]
                ]
            ]
        ];
        $ch = curl_init($gemini_api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "x-goog-api-key: $gemini_api_key",
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
        $gemini_response = curl_exec($ch);
        curl_close($ch);
        file_put_contents($gemini_event_file, $gemini_response);
        $event_explaination = json_decode($gemini_response, true);
    }
    $filtered_output_history[$key]['event_explaination'] = $event_explaination;
}

$output = [
    'status' => 'success',
    'data' => $filtered_output_history,
    'open_value' => $open_value,
    'high_value' => $high_value,
    'low_value' => $low_value,
    'close_value' => $close_value,
    'current_gold_price' => $current_gold_price,
    'percentage_change' => (double)$percentage_change,
    'indicator' => $indicator,
    'indicator_color' => $indicator_color,
    'indicator_symbol' => $indicator_symbol,
    'percentage_change_symbol' => $percentage_change_symbol,
    'percentage_change_color' => $percentage_change_color
];

// Return modified JSON
header('Content-Type: application/json');
echo json_encode($output);