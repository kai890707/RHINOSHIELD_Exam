<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\RequestException;
use App\Service\Exam_one\DailySentenceService;

class DailySentenceServiceTest extends TestCase
{
    /**
     * 測試正常回應情況
     */
    public function testGetSentenceReturnsTrimmedResponse()
    {
        $mockClient = $this->createMock(Client::class);
        $mockResponse = new Response(200, [], '  Test sentence with extra spaces.  ');

        $mockClient->expects($this->once())
                   ->method('get')
                   ->willReturn($mockResponse);

        $dailySentenceService = new DailySentenceService($mockClient);

        $result = $dailySentenceService->getSentence();
        $this->assertEquals('Test sentence with extra spaces.', $result);
    }

    /**
     * 測試當狀態碼不是 200 時
     */
    public function testGetSentenceThrowsExceptionOnNon200StatusCode()
    {
        $mockClient = $this->createMock(Client::class);
        $mockResponse = new Response(500);

        $mockClient->expects($this->once())
                   ->method('get')
                   ->willReturn($mockResponse);

        $dailySentenceService = new DailySentenceService($mockClient);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('ERROR: Response code is not 200');

        $dailySentenceService->getSentence();
    }

    /**
     * 測試當 ClientException 發生時
     */
    public function testGetSentenceThrowsExceptionOnClientError()
    {
        $mockClient = $this->createMock(Client::class);

        $mockClient->expects($this->once())
                   ->method('get')
                   ->willThrowException(
                       new ClientException(
                           'ERROR: Client side error (400)', 
                           new \GuzzleHttp\Psr7\Request('GET', '/sentences/3'),
                           new Response(400)
                       )
                   );

        $dailySentenceService = new DailySentenceService($mockClient);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('ERROR: Client side error (400)');

        $dailySentenceService->getSentence();
    }

    /**
     * 測試當 ServerException 發生時
     */
    public function testGetSentenceThrowsExceptionOnServerError()
    {
        $mockClient = $this->createMock(Client::class);

        // 模擬 ServerException
        $mockClient->expects($this->once())
                   ->method('get')
                   ->willThrowException(
                       new ServerException(
                           'ERROR: Server side error (500)', 
                           new \GuzzleHttp\Psr7\Request('GET', '/sentences/3'),
                           new Response(500)
                       )
                   );

        $dailySentenceService = new DailySentenceService($mockClient);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('ERROR: Server side error (500)');

        $dailySentenceService->getSentence();
    }

    /**
     * 測試當 RequestException 發生時
     */
    public function testGetSentenceThrowsExceptionOnRequestError()
    {
        $mockClient = $this->createMock(Client::class);

        $mockClient->expects($this->once())
                   ->method('get')
                   ->willThrowException(
                       new RequestException(
                           'ERROR: HTTP request failed', 
                           new \GuzzleHttp\Psr7\Request('GET', '/sentences/3')
                       )
                   );

        $dailySentenceService = new DailySentenceService($mockClient);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('ERROR: HTTP request failed');

        $dailySentenceService->getSentence();
    }
}
