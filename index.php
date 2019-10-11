<?php
$domain_route = array(
        'kylincat.com' => 'tech/',
        // 'byu2910320001.my3w.com' => 'qingsong/',
        'baochihuxi.com' => 'tech/',
        'www.baochihuxi.com' => 'tech/',
);
$domain = $_SERVER['HTTP_HOST'];
$target_url = $domain_route[$domain];
// echo $target_url;
// echo $domain;
if ($target_url) {
        header("location:{$target_url}");
}
else {
        header("location: tech/");
}
?>