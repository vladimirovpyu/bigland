<?php
namespace App\Services\BiglandService\Speaker;

use App\Services\BiglandService\Speaker\Request;

class PlotsRequest extends Request
{
    public $method = 'GET';

    public $uri = 'plots';

    public $data = [
        'collection'=>
            [ 'plots' => ['69:27:0000022:1306', '69:27:0000022:1307'] ]
    ];

    public function __construct($requestData)
    {
        $this->data = [
            'collection' =>
            [ 'plots' => $requestData['plots'] ]
        ];
    }

}
