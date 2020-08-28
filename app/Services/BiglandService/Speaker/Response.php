<?php
namespace App\Services\BiglandService\Speaker;

use App\Services\BiglandService\Speaker\ResponseInterface;

class Response implements ResponseInterface
{
    public $data;

    public function __construct($guzzleResponse) {
        $this->data = json_decode($guzzleResponse->getBody());
    }

    public function getData()
    {
        return $this->data;
    }

}
