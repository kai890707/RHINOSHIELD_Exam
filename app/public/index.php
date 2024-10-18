<?php

use App\Service\Exam_one\DailySentenceService;
use App\Service\Exam_one\MetaphorsumApiClient;

$client = new MetaphorsumApiClient();
$service = new DailySentenceService($client);
echo $service->getSentence();

?>