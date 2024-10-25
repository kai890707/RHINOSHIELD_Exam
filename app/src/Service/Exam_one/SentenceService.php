<?php

namespace App\Service\Exam_one;

use App\Service\Exam_one\SentenceApiClientInterface;

/**
 * @author [Kai]
 * @email [z85385637@gmail.com]
 * @create date 2024-10-19 13:32:54
 * @modify date 2024-10-19 13:32:54
 * @desc Dependency Injection容器
 */
class SentenceService
{
    private $apiClient;

    public function __construct(SentenceApiClientInterface $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * API呼叫
     * @return string
     */
    public function getSentence(): string
    {
        return $this->apiClient->fetchSentence();
    }
}
