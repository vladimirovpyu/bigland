<?php
namespace App\Services\BiglandService\Speaker;

use App\Services\BiglandService\Speaker\SpeakerInterface;
use App\Services\BiglandService\Speaker\Request;
use App\Services\BiglandService\Speaker\Response;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;

class Speaker implements SpeakerInterface
{
    public $baseUri = '';

    function __construct($config){
        $this->baseUri = $config['url'];
    }

    /**
     * @param Request $request
     */
    public function sendRequest($request)
    {
        $client = new Client([
            'base_uri' => $this->baseUri,
            'timeout'  => 2.0,
        ]);

        $guzzleRequest = new \GuzzleHttp\Psr7\Request(
            $request->method,
            $this->baseUri.$request->uri,
            $request->headers,
            json_encode($request->data)
        );
        try {
            $guzzleResponse = $client->send($guzzleRequest);
        } catch (ConnectException $e) {
            throw new \Exception($e->getMessage());
        }

        foreach ($guzzleResponse->getHeaders() as $name => $values) {
            echo $name . ': ' . implode(', ', $values) . "\r\n";
        }

        return new Response($guzzleResponse);
    }
}
