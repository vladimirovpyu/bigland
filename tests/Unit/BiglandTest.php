<?php

namespace Tests\Unit;

use App\CadastralNumber;
use Tests\TestCase;
use App\Services\BiglandService\BiglandService;

class BiglandTest extends TestCase
{
    private $servise;
    private $model;

    public function setUp(): void
    {
        parent::setUp();

        $this->service = new BiglandService([
            'url' => 'http://pkk.bigland.ru/api/test/'
        ]);

        $this->numbers = ['69:27:0000022:1306', '69:27:0000022:1307'];
    }

    public function testCreate()
    {
        $this->assertInstanceOf('App\Services\BiglandService\BiglandServiceInterface',$this->service);
    }

    public function testGetFromDb()
    {
        $data = $this->service->getFromDatabase($this->numbers);
        $this->assertInstanceOf('\Illuminate\Database\Eloquent\Collection', $data);
    }

    public function testGetFromRemote()
    {
        $data = $this->service->getFromRemoteService($this->numbers);
        $this->assertIsArray($data);
    }

    public function testSearch()
    {
        $data = $this->service->search($this->numbers);
        $this->assertInstanceOf('\Illuminate\Database\Eloquent\Collection', $data);
    }
}
