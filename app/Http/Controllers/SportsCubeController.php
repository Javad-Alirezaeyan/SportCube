<?php

namespace App\Http\Controllers;


use App\Http\Api\APiClientSportCube;

use App\Http\Cache\CacheMatches;
use App\Http\Date\BuildDate;
use App\Http\Readdata\BuildMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class SportsCubeController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * route /
     */
    public function index()
    {
        $upDate = BuildDate::getUpDate();
        $api = new APiClientSportCube();
        $buildMatch = new BuildMatch($api);

        $matchItems = $buildMatch->run($upDate);

        //caching
        CacheMatches::setMatches($matchItems);
        return view("sportsCube.list",[
            'items' => $matchItems
        ]);
    }

    public function getCache()
    {
        return view("sportsCube.list",[
            'items' => CacheMatches::getMatches()
        ]);
    }

}
