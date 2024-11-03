<?php

namespace App\Service\Exam_one;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;

/**
 * @author [Kai]
 * @email [z85385637@gmail.com]
 * @create date 2024-10-19 13:32:54
 * @modify date 2024-10-19 13:32:54
 * @desc 題目1 - 單純取得字串，不做任何邏輯抽象
 */
class DailySentenceService
{
    private $httpClient;

    /**
     * 建構方法
     * @param \GuzzleHttp\Client|null $httpClient
     * @desc 提供更彈性地使用該類別，因此在參數中加入httpClient，也方便做測試
     */
    public function __construct(Client $httpClient = null)
    {
        $this->httpClient = $httpClient ?: new Client([
            'base_uri' => 'http://metaphorpsum.com',
            'timeout'  => 2.0
        ]);
    }

    /**
     * API呼叫
     * @return string
     */
    public function getSentence(): string
    {
        try {
            $response = $this->httpClient->get('/sentences/3');

            if ($response->getStatusCode() !== 200) {
                throw new \Exception("ERROR: Response code is not 200. Code: " . $response->getStatusCode());
            }

            $data = $response->getBody()->getContents();

            if (empty($data)) {
                throw new \Exception("ERROR: API returned empty data.");
            }

            
            return trim($data);

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
}
