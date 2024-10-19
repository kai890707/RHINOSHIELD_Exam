<?php

namespace App\Service\Exam_one;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;

/**
 * @author [Kai]
 * @email [z85385637@gmail.com]
 * @create date 2024-10-19 19:27:04
 * @modify date 2024-10-19 19:27:04
 * @desc API實作的抽象類別，將API進行HTTP操作行為抽離，子類別僅需實作handleResponse進行API result處理即可
 */
abstract class AbstractApiClient implements SentenceApiClientInterface
{
    protected Client $client;
    protected string $targetUrl;

    public function __construct(string $url)
    {
        $this->client = new Client();
        $this->targetUrl = $url;
    }

    // 定義具體的 HTTP 請求邏輯
    public function fetchSentence(): string
    {
        try {
            $response = $this->client->get($this->targetUrl);

            if ($response->getStatusCode() !== 200) {
                throw new \Exception("ERROR: Response code is not 200. Code: " . $response->getStatusCode());
            }

            $data = $response->getBody()->getContents();

            if (empty($data)) {
                throw new \Exception("ERROR: API returned empty data.");
            }

            // 調用抽象方法來處理不同格式的回應
            return $this->handleResponse($data);

        } catch (ClientException $e) {
            throw new \Exception("ERROR: Client side error (400)." . $e->getMessage());
        } catch (ServerException $e) {
            throw new \Exception("ERROR: Server side error (500)." . $e->getMessage());
        } catch (RequestException $e) {
            throw new \Exception("ERROR: HTTP request failed." . $e->getMessage());
        } catch (\Exception $e) {
            throw new \Exception("ERROR: Unknown error." . $e->getMessage());
        }
    }

    // 強制子類實現處理不同回應格式的邏輯
    abstract protected function handleResponse(string $response): string;
}
