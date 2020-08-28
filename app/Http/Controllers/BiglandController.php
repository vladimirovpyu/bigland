<?php

namespace App\Http\Controllers;

use App\CadastralNumber;
use App\Http\Controllers\Controller;
use App\Services\BiglandService\BiglandService;
use Woo\GridView\DataProviders\EloquentDataProvider;

class BiglandController extends Controller
{
    /**
    * Show the profile for the given user.
    *
    * @param  int  $id
    * @return View
    */
    public function index(BiglandService $service)
    {
        //$service = app()->make('BiglandService');
        //return view('bigland.index', ['models' => $service->search($numbers)]);

        $query = CadastralNumber::query();

        if (request()->get('numbers')) {
            $numbers = explode(',',request()->get('numbers'));

            $service = app()->make('App\Services\BiglandService\BiglandService');
            $service->search($numbers);
            $query->whereIn('cn',$numbers);
        }

        return view ('bigland.index', [
            'numbers' => request()->get('numbers'),
            'provider' => new EloquentDataProvider($query)]
        );
    }

    public function api()
    {
        $numbers = request()->get('numbers');
        $service = app()->make('App\Services\BiglandService\BiglandService');
        $service->search($numbers);

        $query = CadastralNumber::query();
        $query->whereIn('cn', $numbers);

        return $query->get()->toJson();
    }

}
