<?php

require __DIR__ . '/../vendor/autoload.php';
/**
 * @author [Kai]
 * @email [z85385637@gmail.com]
 * @create date 2024-10-19 13:33:15
 * @modify date 2024-10-19 13:33:15
 * @desc 進入點
 */
use App\Service\Exam_one\DailySentenceService;
use App\Service\Exam_one\MetaphorsumApiClient;
use App\Service\Exam_one\ItsthisforthatApiClient;

/**
 * MetaphorsumApiClient 使用範例
 */
$metaphorsumApiClient = new MetaphorsumApiClient();
$metaphorsumservice = new DailySentenceService($metaphorsumApiClient);
echo $metaphorsumservice->getSentence() . PHP_EOL;


/**
 * ItsthisforthatApiClient 使用範例
 */
$itsthisforthatApiClient = new ItsthisforthatApiClient();
$itsthisforthatservice = new DailySentenceService($itsthisforthatApiClient);
echo $itsthisforthatservice->getSentence() . PHP_EOL;