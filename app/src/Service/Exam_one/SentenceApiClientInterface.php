<?php

namespace App\Service\Exam_one;

/**
 * @author [Kai]
 * @email [z85385637@gmail.com]
 * @create date 2024-10-19 13:33:53
 * @modify date 2024-10-19 13:33:53
 * @desc API Client Interface
 */
interface SentenceApiClientInterface
{
    public function fetchSentence(): string;
}
