<?php
namespace App\Services\BiglandService\Speaker;

use App\Services\BiglandService\Speaker\RequestInterface;

class Request implements RequestInterface
{
    public $method = 'GET';

    public $uri = '';

    public $headers = [
        'Content-Type'=>'application/json',
        'Accept'=>'application/json'
    ];

}
