<?php

require 'vendor/autoload.php';

use QL\QueryList;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

$server = 'https://bing.ioliu.cn/?p=';

$guzzle = new Client();
// Last ID
$i      = 1;

$dir    = "./Photo/Bing/";

while(1)
{
    $page = $server . $i;

    var_dump('开始下载第 ' . $i . ' 页.');

    try {
        $response  = QueryList::get($page)->find('.progressive__img')->attrs('src');

        $photos    = $response->all();

        var_dump('找到图片 ' . count($photos) . ' 张.');

        foreach ($photos as $photo) {
            try {
                $data   = pathinfo($photo);
                $name   = explode('_', $data['filename'], -1);
                $name   = implode('_', $name);
                $name   = $name . '_1920x1080';
                $source = $data['dirname'] . '/' . $name . '.' . $data['extension'];

                $guzzle->request('GET', $source, [
                    'sink' => $dir . '/' . md5($name) . '.' . $data['extension'],
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

