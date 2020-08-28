<?php
namespace App\Services\BiglandService\Parser;

use App\Services\BiglandService\Parser\ParserInterface;
use App\Services\BiglandService\Speaker\Response;

/**
 * Парсит данные из Response
 *
 * Class Parser
 * @package App\Services\BiglandService
 */
class Parser implements ParserInterface
{
    /**
     * @param Response $response
     */
    static public function parse($response)
    {
        $res = [];
        foreach ($response->getData() as $obj) {
            $attrs = $obj->data->attrs;
            $cn = new CnEntity();
            $cn->cn = $attrs->cn;
            $cn->address = $attrs->address;
            $cn->price = $attrs->cad_cost;
            $cn->area = $attrs->area_value;
            $res[] = $cn;
        }
        return $res;
    }

}
