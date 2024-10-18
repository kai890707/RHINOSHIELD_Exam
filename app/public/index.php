<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Service\DailySentenceService;

$service = new DailySentenceService();
echo $service->getSentence();

?>