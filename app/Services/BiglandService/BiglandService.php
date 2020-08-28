<?php
namespace App\Services\BiglandService;

use App\CadastralNumber;
use App\Services\BiglandService\BiglandServiceInterface;
use App\Services\BiglandService\Speaker\Speaker;
use App\Services\BiglandService\Parser\Parser;
use App\Services\BiglandService\Speaker\PlotsRequest;

/**
 *
 * Class BiglandService
 * @package App\Services
 */
class BiglandService implements BiglandServiceInterface
{
    private $parser;
    private $speaker;

    /**
     * BiglandService constructor.
     * @param array $config
     */
    function __construct($config)
    {
        $this->speaker = new Speaker($config);
        $this->parser = new Parser();
    }


    /**
     * @param $numbers - массив кадастровых номеров
     * @return \Illuminate\Database\Eloquent\Collection - коллекция записей в БД
     */
    public function search($numbers): \Illuminate\Database\Eloquent\Collection
    {
        if (empty($numbers))
            throw new \Exception('Need array of cadastral numbers');

        // ищем в базе
        $collection = $this->getFromDatabase($numbers);
        $models = [];
        if ($collection) {
            $numbersAsKeys = array_flip($numbers);
            foreach ($collection as $model) {
                $models[] = $model;
                if (isset($numbersAsKeys[$model->cn])) {
                    unset($numbersAsKeys[$model->cn]);
                }
            }
            $numbers = array_keys($numbersAsKeys);
        }

        // делаем запрос на сервер
        if (!empty($numbers)) {
            // если нашли на сервере, и записали в базу, достаем из базы еще раз.
            $this->getFromRemoteService($numbers);
        }

        // достаем из базы еще раз, т.к. первый раз коллекцию мы уже перебрали
        $collection = $this->getFromDatabase($numbers);

        return $collection;
    }

    /**
     * @param $numbers
     * @return mixed
     */
    public function getFromDatabase($numbers): \Illuminate\Database\Eloquent\Collection
    {
        return CadastralNumber::query()->whereIn('cn',$numbers)->get();
    }

    /**
     * @param $numbers
     */
    public function getFromRemoteService($numbers)
    {
        $models = [];
        $request = new PlotsRequest(['plots'=>$numbers]);
        try {
            $response = $this->speaker->sendRequest($request);
            $data = Parser::parse($response);
            foreach ($data as $obj)
            {
                $model = new CadastralNumber();
                $model->cn = $obj->cn;
                $model->address = $obj->address;
                $model->price = $obj->price;
                $model->area = $obj->area;
                $model->save();
                $models[] = $model;
            }
        } catch(\Exception $e) {
            // TODO: обрабатываем ошибку спикера
            throw new \Exception($e->getMessage());
        }
        return $models;
    }
}
