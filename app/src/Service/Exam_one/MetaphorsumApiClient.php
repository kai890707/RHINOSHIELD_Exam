<?php

namespace App\Service\Exam_one;

use App\Service\Exam_one\AbstractApiClient;

/**
 * @author [Kai]
 * @email [z85385637@gmail.com]
 * @create date 2024-10-19 13:33:45
 * @modify date 2024-10-19 13:33:45
 * @desc Metaphorsum Strategy API
 */
class MetaphorsumApiClient extends AbstractApiClient
{
    protected string $targetUrl = "http://metaphorpsum.com/sentences/3";

    public function __construct()
    {
        parent::__construct($this->targetUrl);
    }

    protected function handleResponse(string $response): string
    {
        // 假設回應是純文字，需要直接返回
        return trim($response);
    }
}
