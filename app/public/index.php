<?php

require __DIR__ . '/../vendor/autoload.php';
/**
 * @author [Kai]
 * @email [z85385637@gmail.com]
 * @create date 2024-10-19 13:33:15
 * @modify date 2024-10-19 13:33:15
 * @desc 進入點
 */
use App\Service\Exam_one\SentenceService;
use App\Service\Exam_one\DailySentenceService;
use App\Service\Exam_one\MetaphorsumApiClient;
use App\Service\Exam_one\ItsthisforthatApiClient;


#----------------------------------題目1------------------------------------------------
$dailySentenceService = new DailySentenceService();
echo $dailySentenceService->getSentence() . PHP_EOL;


#-----------------------題目1進階-使用抽換依賴類別實現題目需求-----------------------------
/**
 * MetaphorsumApiClient 使用範例
 */
$metaphorsumApiClient = new MetaphorsumApiClient();
$metaphorsumservice = new SentenceService($metaphorsumApiClient);
echo $metaphorsumservice->getSentence() . PHP_EOL;


/**
 * ItsthisforthatApiClient 使用範例
 */
$itsthisforthatApiClient = new ItsthisforthatApiClient();
$itsthisforthatservice = new SentenceService($itsthisforthatApiClient);
echo $itsthisforthatservice->getSentence() . PHP_EOL;