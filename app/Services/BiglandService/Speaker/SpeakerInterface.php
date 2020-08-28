<?php
namespace App\Services\BiglandService\Speaker;

use App\Services\BiglandService\Speaker\RequestInterface;

interface SpeakerInterface
{
    public function sendRequest(RequestInterface $request);


}
