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

#----------------------------------題目1------------------------------------------------
$dailySentenceService = new DailySentenceService();
echo "dailySentence result : " . $dailySentenceService->getSentence();