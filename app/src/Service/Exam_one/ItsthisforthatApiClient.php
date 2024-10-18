<?php 
namespace App\Service\Exam_one;

use App\Service\Exam_one\SentenceApiClientInterface;
use GuzzleHttp\Client;

class ItsthisforthatApiClient implements SentenceApiClientInterface
{
    private $client;
    protected $targetUrl = 'https://itsthisforthat.com/api.php?text';

    public function __construct()
    {
        $this->client = new Client();
    }

    public function fetchSentence(): string
    {
        $response = $this->client->get($this->targetUrl);
        $data = $response->getBody()->getContents();
        return trim($data);
    }
}


?>