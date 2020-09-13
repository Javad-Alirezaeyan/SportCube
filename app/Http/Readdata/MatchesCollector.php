<?php

namespace App\Http\Readdata;


class MatchesCollector
{

    public function __construct()
    {
        
    }

    /**
     * @param $matches
     * @param string $groupInterval
     * @return array
     */
    public function collect($matches, $groupInterval = DAILY_Interval)
    {
       switch ($groupInterval){
           case DAILY_Interval:
               return $this->dailyCollect($matches);
               break;
           default :
               return $this->dailyCollect($matches);
       }

    }

    /*
     *
     */
    public function dailyCollect($matches)
    {

        $matches = collect($matches)->groupBy("day")->toArray();

        foreach ($matches as $key => $items) {
            $importances = array_column($items, 'globalImportance');
            $kickTimes = array_column($items, 'kickoffTime');
            array_multisort($importances, SORT_DESC, $kickTimes, SORT_ASC, $items);
            $items = array_slice($items, 0, MAX_MATCH_SHOW);
            $matches[$key] = $items;
        }

        return $matches;
    }

    public function weeklyCollect($matches)
    {
       throw new Exception("not implemented");
    }



}