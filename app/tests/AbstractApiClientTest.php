<?php

namespace Tests\Service;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\RequestException;
use App\Service\Exam_one\AbstractApiClient;

/**
 * @author [Kai]
 * @email [z85385637@gmail.com]
 * @create date 2024-10-19 18:40:22
 * @modify date 2024-10-19 18:40:22
 * @desc API Client 的抽象類別測試
 */
class AbstractApiClientTest extends TestCase
{
    protected string $fakeURL = 'http://example.com';

    /**
     * 成功請求測試
     * @return void
     */
    public function testFetchSentenceReturnsTrimmedResponse()
    {
        // 模擬 GuzzleHttp\Client與填充樣本Response
        $mockClient = $this->createMock(Client::class);
        $mockResponse = new Response(200, [], ' Test sentence. ');

        // 期望client使用get跑一次模擬請求並回傳樣本Response
        $mockClient->expects($this->once())
                   ->method('get')
                   ->willReturn($mockResponse);

        // 建立抽象類別 AbstractApiClient 的模擬物件
        // 抽象類別中僅有handleResponse需讓子類別覆寫
        $clientMock = $this->getMockBuilder(AbstractApiClient::class)
                           ->setConstructorArgs([$this->fakeURL])
                           ->onlyMethods(['handleResponse'])
                           ->getMock();

        // 模擬 handleResponse 方法的行為
        $clientMock->expects($this->once())
                   ->method('handleResponse')
                   ->willReturnCallback(function ($response) {
                       return trim($response);
                   });

        // 在抽象類別中的client為私有屬性,因此用映射來做訪問處理
        // client替換，避免真實的HTTP訪問產生
        $reflection = new \ReflectionClass($clientMock);
        $property = $reflection->getProperty('client');
        $property->setAccessible(true);
        $property->setValue($clientMock, $mockClient);

        $result = $clientMock->fetchSentence();

        $this->assertEquals('Test sentence.', $result);
    }

    /**
     * 400 ERROR 測試
     * @return void
     */
    public function testFetchSentenceThrowsClientException()
    {
        $mockClient   = $this->createMock(Client::class);
        $mockResponse = new Response(400);
        $mockRequest  = new Request('GET', 'test');

        // Client做完get後時拋出 ClientException
        $mockClient->expects($this->once())
                ->method('get')
                ->willThrowException(new ClientException(
                    'ERROR: Client side error (400).',
                    $mockRequest,
                    $mockResponse
                ));

        $clientMock = $this->getMockBuilder(AbstractApiClient::class)
                        ->setConstructorArgs([$this->fakeURL])
                        ->onlyMethods(['handleResponse'])
                        ->getMock();

        $reflection = new \ReflectionClass($clientMock);
        $property = $reflection->getProperty('client');
        $property->setAccessible(true);
        $property->setValue($clientMock, $mockClient);

        // 檢查是否拋出 ClientException
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('ERROR: Client side error (400).');

        $clientMock->fetchSentence();
    }

    public function testFetchSentenceThrowsServerException()
    {
        // 模擬 GuzzleHttp\Client
        $mockClient   = $this->createMock(Client::class);
        $mockResponse = new Response(500);
        $mockRequest  = new Request('GET', 'test');

        // Client做完get後時拋出 ServerException
        $mockClient->expects($this->once())
                   ->method('get')
                   ->willThrowException(new ServerException(
                       'ERROR: Server side error (500).',
                       $mockRequest,
                       $mockResponse
                   ));

        $clientMock = $this->getMockBuilder(AbstractApiClient::class)
                           ->setConstructorArgs([$this->fakeURL])
                           ->onlyMethods(['handleResponse'])
                           ->getMock();

        $reflection = new \ReflectionClass($clientMock);
        $property = $reflection->getProperty('client');
        $property->setAccessible(true);
        $property->setValue($clientMock, $mockClient);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('ERROR: Server side error (500).');

        $clientMock->fetchSentence();
    }

    public function testFetchSentenceThrowsRequestException()
    {
        // 模擬 GuzzleHttp\Client
        $mockClient = $this->createMock(Client::class);

        // Client做完get後時拋出 RequestException
        $mockClient->expects($this->once())
                   ->method('get')
                   ->willThrowException(new RequestException(
                       'ERROR: HTTP request failed.',
                       new Request('GET', 'test')
                   ));

        $clientMock = $this->getMockBuilder(AbstractApiClient::class)
                           ->setConstructorArgs([$this->fakeURL])
                           ->onlyMethods(['handleResponse'])
                           ->getMock();

        $reflection = new \ReflectionClass($clientMock);
        $property = $reflection->getProperty('client');
        $property->setAccessible(true);
        $property->setValue($clientMock, $mockClient);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('ERROR: HTTP request failed.');

        $clientMock->fetchSentence();
    }
}
