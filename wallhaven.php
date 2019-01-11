<?php

require 'vendor/autoload.php';

use QL\QueryList;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

$server = 'https://alpha.wallhaven.cc/wallpaper/';

$guzzle = new Client();
// Last ID
$i      = 718126;

$dir    = "./Photo/Wallhaven/";

while(1)
{
    var_dump($i);

    $page = $server . $i;

    try {
        $response = QueryList::get($page)->find('#wallpaper')->attrs('src');

        $data     = $response->all();

        $photo    = "https:" . $data[0];

        try {
            $guzzle->request('GET', $photo, [
                'sink' => $dir . basename($photo),
              'verify' => false
            ]);
        } catch(RequestException $e) {
            var_dump('图片请求错误.');
        }
    } catch (RequestException $e){
        var_dump('页面请求错误.');
    }

    $i++;
}

