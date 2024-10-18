<?php 
namespace Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Service\Exam_one\DailySentenceService;
use App\Service\Exam_one\MetaphorsumApiClient;
use App\Service\Exam_one\ItsthisforthatApiClient;

class DailySentenceServiceTest extends TestCase
{
    public function testGetData()
    {
        // 建立 ApiClient 的模擬物件
        $mockApiClient = $this->createMock(MetaphorsumApiClient::class);

        // 設定模擬的 fetchData 方法回傳特定的值
        $mockApiClient->expects($this->once())    // 預期 fetchData 會被呼叫一次
                     ->method('fetchSentence')       // 指定 fetchData 方法
                     ->willReturn('mocked data'); // 設定回傳的結果

        // 使用模擬的 ApiClient 建立 DataService
        $service = new DailySentenceService($mockApiClient);

        // 測試 getData 方法
        $this->assertEquals('mocked data', $service ->getSentence());
    }
}


?>