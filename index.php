<?php

    // Load Predis
    require '.predis/autoload.php';
    Predis\Autoloader::register();

    // Connect to Redis
    $redis_client = new Predis\Client(['host' => 'redis']);;

    // Retrieve an IP address
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    elseif (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    // Find count of unique IPs
    if (isset($ip)) {
        $redis_client -> sAdd("ips", $ip);
        $count = $redis_client -> sCard("ips");
        echo "Count of unique visitors: ".$count;
    }

?>