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

$client = new MetaphorsumApiClient();
$service = new DailySentenceService($client);
echo $service->getSentence();
