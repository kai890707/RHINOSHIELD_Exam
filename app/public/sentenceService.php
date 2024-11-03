<?php

require __DIR__ . '/../vendor/autoload.php';
/**
 * @author [Kai]
 * @email [z85385637@gmail.com]
 * @create date 2024-10-19 13:33:15
 * @modify date 2024-10-19 13:33:15
 * @desc Metaphorsum進入點
 */
use App\Service\Exam_one\SentenceService;
use App\Service\Exam_one\MetaphorsumApiClient;
use App\Service\Exam_one\ItsthisforthatApiClient;


#-----------------------題目1進階-使用抽換依賴類別實現題目需求-----------------------------
/**
 * MetaphorsumApiClient 使用範例
 */
$metaphorsumApiClient = new MetaphorsumApiClient();
$metaphorsumservice = new SentenceService($metaphorsumApiClient);

if (PHP_SAPI === 'cli') {
    echo "metaphorsum result : " . $metaphorsumservice->getSentence() . PHP_EOL;
} else {
    echo "metaphorsum result : " . $metaphorsumservice->getSentence() . "<br>";
}


/**
 * ItsthisforthatApiClient 使用範例
 */
$itsthisforthatApiClient = new ItsthisforthatApiClient();
$itsthisforthatservice = new SentenceService($itsthisforthatApiClient);

if (PHP_SAPI === 'cli') {
    echo "itsthisforthat result : " . $itsthisforthatservice->getSentence() . PHP_EOL;
} else {
    echo "itsthisforthat result : " . $itsthisforthatservice->getSentence() . "<br>";
}


