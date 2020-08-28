<?php

namespace App\Services\BiglandService;

/**
 * Interface BiglandServiceInterface
 * @package App\Services\BiglandService
 */
interface BiglandServiceInterface
{
    /**
     * constructor.
     * @param array $config
     */
    public function __construct($config);

    /**
     * @param array $numbers
     * @return mixed
     */
    public function search($numbers): \Illuminate\Database\Eloquent\Collection;

}
