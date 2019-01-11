<?php

require 'vendor/autoload.php';

use QL\QueryList;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

$server = 'https://konachan.com/post';

$guzzle = new Client();
// Last ID
$i      = 1;

$dir    = "./Photo/Konachan/";

while(1)
{
    $page = $server . '?page=' . $i;

    var_dump('开始下载第 ' . $i . ' 页.');

    $path = $dir . '/' . ceil($i / 100);

    if (! is_dir($path)) {
        mkdir($path, 0755, true);
    }

    try {
        $large  = QueryList::get($page)->find('.largeimg')->attrs('href');
        $small  = QueryList::get($page)->find('.smallimg')->attrs('href');

        $photos = $large->all();

        $photos = array_merge($photos, $small->all());

        var_dump('找到图片 ' . count($photos) . ' 张.');

        foreach ($photos as $photo) {
            try {
                $file = pathinfo($photo);
                $guzzle->request('GET', $photo, [
                    'sink' => $path . '/' . md5($file['basename']) . '.' . $file['extension'],
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

