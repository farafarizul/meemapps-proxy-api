<?php
$list_services = [];

$list_services[] = [
    'name' => 'About Us',
    'icon_url' => 'https://crm.zada.my/meem/api/assets/icons/about_us.png',
    'url' => 'https://crm.zada.my/meem/api/webview/about_us.html',
];

$list_services[] = [
    'name' => 'Contact Us',
    'icon_url' => 'https://crm.zada.my/meem/api/assets/icons/contact_us.png',
    'url' => 'https://crm.zada.my/meem/api/webview/contact_us.html',
];

$list_services[] = [
    'name' => 'News',
    'icon_url' => 'https://crm.zada.my/meem/api/assets/icons/news_gray.png',
    'url' => 'https://crm.zada.my/meem/api/webview/coming_soon.html',
];

$list_services[] = [
    'name' => 'Resellers',
    'icon_url' => 'https://crm.zada.my/meem/api/assets/icons/resellers_gray.png',
    'url' => 'https://crm.zada.my/meem/api/webview/coming_soon.html',
];

$list_services[] = [
    'name' => 'Shariah Advisor',
    'icon_url' => 'https://crm.zada.my/meem/api/assets/icons/shariah_advisor.png',
    'url' => 'https://crm.zada.my/meem/api/webview/shariah_advisor.html',
];

$list_services[] = [
    'name' => 'Closure',
    'icon_url' => 'https://crm.zada.my/meem/api/assets/icons/closure.png',
    'url' => 'https://crm.zada.my/meem/api/webview/account_closure.html',
];

//return json
$output = [];
$output['status'] = 'success';
$output['data'] = $list_services;
header('Content-Type: application/json');
echo json_encode($output);

?>