<?php

namespace Tests\Service;

use App\Service\Exam_one\MetaphorsumApiClient;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

/**
 * @author [Kai]
 * @email [z85385637@gmail.com]
 * @create date 2024-10-19 19:10:41
 * @modify date 2024-10-19 19:10:41
 * @desc MetaphorsumApiClient 測試
 */
class MetaphorsumApiClientTest extends TestCase
{
    /**
     * handleResponse 方法成功案例測試
     * @return void
     */
    public function testHandleResponse()
    {
        $client = new MetaphorsumApiClient();

        $reflection = new \ReflectionClass($client);
        $method = $reflection->getMethod('handleResponse');
        $method->setAccessible(true);

        // 測試 handleResponse 方法是否正確
        $response = '  Test sentence with extra spaces.  ';
        $result = $method->invokeArgs($client, [$response]);

        $this->assertEquals('Test sentence with extra spaces.', $result);
    }

    /**
     * 與AbstractApiClient的整合測試，僅測試 200 code
     * @return void
     */
    public function testFetchSentenceUsesHandleResponse()
    {
        $mockClient = $this->createMock(Client::class);

        $mockResponse = new Response(200, [], ' Test sentence. ');

        $mockClient->expects($this->once())
                   ->method('get')
                   ->willReturn($mockResponse);

        $client = new MetaphorsumApiClient();

        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('client');
        $property->setAccessible(true);
        $property->setValue($client, $mockClient);

        $result = $client->fetchSentence();
        $this->assertEquals('Test sentence.', $result);
    }
}
