<?php

namespace Tests\Service;

use App\Service\Exam_one\DailySentenceService;
use App\Service\Exam_one\SentenceApiClientInterface;
use PHPUnit\Framework\TestCase;

/**
 * @author [Kai]
 * @email [z85385637@gmail.com]
 * @create date 2024-10-19 13:39:10
 * @modify date 2024-10-19 13:39:10
 * @desc DailySentenceService測試
 */
class DailySentenceServiceTest extends TestCase
{
    public function testGetSentenceReturnsCorrectSentence()
    {
        // SentenceApiClientInterface 的模擬物件
        $apiClientMock = $this->createMock(SentenceApiClientInterface::class);

        // 設置模擬物件的 fetchSentence 方法
        $apiClientMock->expects($this->once()) // 期望 fetchSentence 做一次就好
                      ->method('fetchSentence')
                      ->willReturn('This is a test sentence.');

        // 使用模擬的 SentenceApiClientInterface 來創建 DailySentenceService (DI)
        $dailySentenceService = new DailySentenceService($apiClientMock);

        $result = $dailySentenceService->getSentence();

        $this->assertEquals('This is a test sentence.', $result);
    }
}
