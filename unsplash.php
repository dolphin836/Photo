<?php

/**
 * 从 Unsplash 随机下载图片
 * @author whb
 * @create 2018-09-26 18:14:00
 * @update 2018-10-31 18:00:00
 */

// 载入自动加载文件
require 'vendor/autoload.php';

use Dolphin\Wang\Unsplash\Random;

$access_key_arr = [
    'b98fc10777cea951e97eecc7edb46a37d0681d7d290319d048e40157b758c05f',
    '390bdbdaca55000a94974dc27ac1bbcd160e3d4e061954e051f22f9ac191a55e',
    'dfe45c544f26e0b5700f442d629ca16d250655919f8670bf00a2374fecd6845d',
    'd67ff81ddb5ba6a1343b03f7a3ae26d3d695f48f5343860b180d9514e61e9629',
    'c04ee95b15edecd3968009da1db1382ddd99628b29604465ee8939021be474ed',
    '7948a3f2bef5cae42e5cbd2bc507e8d6caa79b8a3f130277ea4f7bea8f0dd8d1',
    '23f166f40a84ba98ec53c737aade230de5aa7338fb4b69d686e99618b279b47b',
    '91f22fa489309e7055cdb63e016915ff95b239c25d7a4385f3e6ffca2af760a1',
    'df2bc512bd95322650a1c14261c0a3cda362c6c579d978b0f2c442c19eee1ea8',
    'ebf6cbb1c0721d003336f4e2a9ef303c08b1d2bd60e220f6911736efd8db6397',
    'bb7f4917e35d9fd341bf60b481ac934ee5b23960860c7dcc6c9ea78bc46c47b1'
];

$dir    = "./Photo/Unsplash/";

$random = new Random($access_key_arr, $dir);

$random->run();