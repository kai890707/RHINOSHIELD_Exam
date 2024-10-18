<?php 
namespace App\Service\Exam_one;
use App\Service\Exam_one\SentenceApiClientInterface;

class DailySentenceService
{
    private $apiClient;

    public function __construct(SentenceApiClientInterface $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function getSentence(): string
    {
        return $this->apiClient->fetchSentence();
    }
}


?>