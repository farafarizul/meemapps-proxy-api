<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'about_us';

if($page == 'about_us') {
    header('Location: https://crm.zada.my/meem/api/webview/about_us.php');
} else if($page == 'contact_us') {
    header('Location: https://crm.zada.my/meem/api/webview/contact_us.php');
} else if($page == 'news') {
    header('Location: https://crm.zada.my/meem/api/webview/news.php');
} else if($page == 'resellers') {
    header('Location: https://crm.zada.my/meem/api/webview/resellers.php');
} else if($page == 'shariah_advisor') {
    header('Location: https://crm.zada.my/meem/api/webview/shariah_advisor.php');
} else if($page == 'closure') {
    header('Location: https://crm.zada.my/meem/api/webview/closure.php');
} else {
    header('Location: https://crm.zada.my/meem/api/webview/default.php');
}
?>