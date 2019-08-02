<?php

require 'vendor/autoload.php';

use QL\QueryList;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

$server = 'http://oswallpapers.com';

$guzzle = new Client();

$total = 34;

for ($i = 1; $i <= $total; $i++) {
    var_dump('开始下载第 ' . $i . ' 页.');

    if ($i === 1) {
        $page = $server;
    } else {
        $page = $server . '/page/' . $i;
    }

    try {
        $pageHtmlArr = QueryList::get($page)->find('.wpex-loop-entry-title')->htmls();
    
        var_dump('找到 ' . count($pageHtmlArr) . ' 条记录.');

        foreach ($pageHtmlArr as $pageHtml) {
            preg_match_all('/<a href="(http[^"]+?)"/s', $pageHtml, $match);
    
            $link = $match[1][0];
    
            try {
                $pageHref = QueryList::get($link)->find('a')->attrs('href');
                $links    = $pageHref->all();
            
                foreach ($links as $string) {
                    if (strpos($string, 'drive.google.com') !== false) {
                        $driveArr = Yaml::parseFile('drive.yaml');
    
                        if (! in_array($string, $driveArr)) {
                            $driveArr[] = $string;
                        
                            $yaml       = Yaml::dump($driveArr);
                            
                            file_put_contents('drive.yaml', $yaml);
                        }
                    }
                }
            } catch (RequestException $e){
                var_dump('详情页请求错误.');
            }
        }
        
    } catch (RequestException $e){
        var_dump('列表页请求错误.');
    }
}


