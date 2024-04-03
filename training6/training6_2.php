<?php

function build_url(string $scheme, string $domain, array $url_path_arr, array $query_param_arr = [])
{
    $url = $scheme . '://' . $domain;

    $url .= '/' . implode('/', $url_path_arr);

    if ($query_param_arr) {
        $url .= '?' . http_build_query($query_param_arr);
    }

    return $url;
}

echo build_url('https', 'my_site.net', ['path', 'to', 'page.php'], ['param1' => 'value1']);