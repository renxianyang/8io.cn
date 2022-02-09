<?php
$server_url = 'https://8io.cn/proxy.php';
$response = '';

$url = $_SERVER['QUERY_STRING'];
if ($url[0] == '/') {
    $url = 'https:' . $url;
}
$urlInfo = parse_url($url);
$base_url = $urlInfo['scheme'] . '://' . $urlInfo['host'];

$opts = array();

try {
    $opts['http'] = array(
        'method' => "GET",
        'header' => 'Cookie: ' . (array_key_exists('HTTP_COOKIE', $_SERVER) ? $_SERVER['HTTP_COOKIE'] : '')
    );
} catch (Exception $e) {

}

$context = stream_context_create($opts);
$fh = fopen($url, 'b', false, $context);

/* 设置响应头 */
$meta = stream_get_meta_data($fh);
foreach ($meta['wrapper_data'] as $wrapper_datum) {
    if (strpos($wrapper_datum, 'content-type') !== false) {
        header($wrapper_datum);
    }
}

if ($fh) {
    while (!feof($fh)) {
        $response = $response . fgets($fh);
    }
}

fclose($fh);

//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//curl_exec($ch);
//curl_close($ch);

//$response = preg_replace_callback('/(http|https):\/\/([^\'|"|\\\])/', function ($m) {
//    global $server_url, $url, $base_url;
//
//    return $server_url . '?' . $m[1] . '://' . $m[2];
//}, $response);
$response = preg_replace_callback('/(src|href|action)=(\'|")(..)/', function ($m) {
    global $server_url, $url, $base_url;

    if ($m[3] == 'ht' || $m[3] == '//') {
        if ($m[3] == '//') {
            $m[3] = 'https:' . $m[3];
        }

        return $m[1] . '=' . $m[2] . $server_url . '?' . $m[3];
    } else if ($m[3] == './') {
        return $m[1] . '=' . $m[2] . $server_url . '?' . $url . '/' . substr(0, 1);
    } else if ($m[3][0] == '/') {
        return $m[1] . '=' . $m[2] . $server_url . '?' . $base_url . $m[3] . substr(0, 1);
    }

    return $m[0];
}, $response);

print($response);

//$fp = fopen('test.txt', 'w');
//fwrite($fp, $response);
//fclose($fp);
exit;
