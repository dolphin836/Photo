<?php

require 'vendor/autoload.php';

use QL\QueryList;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

$server = 'https://burst.shopify.com/photos?page=';

$guzzle = new Client();

$i      = 1;

$dir    = "./Photo/Shopify/";

while(1)
{
    $page = $server . $i;

    var_dump('开始下载第 ' . $i . ' 页.');

    $path = $dir . '/' . $i;

    if (is_dir($path)) {
        $i++;

        continue;
    } else {
        mkdir($path, 0755, true);
    }

    try {
        $response = QueryList::get($page)->find('.js-download-premium')->attrs('data-modal-image-url');

        $photos = $response->all();

        var_dump('找到图片 ' . count($photos) . ' 张.');

        foreach ($photos as $photo) {
            try {
                $data   = pathinfo($photo);
                $name   = explode('_', $data['filename'], -1);
                $source = $data['dirname'] . '/' . $name[0] . '.' . $data['extension'];
    
                $guzzle->request('GET', $source, [
                    'sink' => $path . '/' . md5($name[0]) . '.' . $data['extension'],
                  'verify' => false
                ]);
    
                var_dump('已成功下载一张图片.');
            } catch(RequestException $e) {
                var_dump('图片请求错误.');
            }
        }
    } catch (RequestException $e){
        var_dump('页面请求错误.');
    }

    $i++;
}

