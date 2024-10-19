<?php

namespace App\Service\Exam_one;

use App\Service\Exam_one\AbstractApiClient;

/**
 * @author [Kai]
 * @email [z85385637@gmail.com]
 * @create date 2024-10-19 13:33:32
 * @modify date 2024-10-19 13:33:32
 * @desc ItsthisforthatApiClient Strategy API
 */
class ItsthisforthatApiClient extends AbstractApiClient
{
    protected string $targetUrl = "https://itsthisforthat.com/api.php?text";

    public function __construct()
    {
        parent::__construct($this->targetUrl);
    }

    /**
     * 處理 Itsthisforthat API result的具體邏輯
     * @param string $response
     * @return string
     */
    protected function handleResponse(string $response): string
    {
        return trim($response);
    }
}
