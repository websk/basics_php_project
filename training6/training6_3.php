<?php
header('Content-type: text/plain; charset=UTF-8');


echo 'REQUEST_METHOD:' . getenv('REQUEST_METHOD') . '<br>';
echo 'QUERY_STRING: ' . getenv('QUERY_STRING') . '<br>';
echo 'REQUEST_URI: ' . getenv('REQUEST_URI') . '<br>';
echo 'CONTENT_TYPE: ' . getenv('CONTENT_TYPE') . '<br>';
echo 'HTTP_HOST: ' . getenv('HTTP_HOST') . '<br>';
echo 'HTTP_USER_AGENT: ' . getenv('HTTP_USER_AGENT') . '<br>';
echo 'HTTP_REFERER: ' . getenv('HTTP_REFERER') . '<br>';
echo 'CONTENT_LENGTH: ' . getenv('CONTENT_LENGTH') . '<br>';
echo 'HTTP_COOKIE: ' . getenv('HTTP_COOKIE') . '<br>';
echo 'HTTP_ACCEPT: ' . getenv('HTTP_ACCEPT') . '<br>';


echo '<br>';

$head_arr = getallheaders();

foreach ($head_arr as $key => $value) {
    echo '<p>' . $key . ': ' . $value . '</p>';
}