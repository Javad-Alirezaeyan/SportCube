<?php

namespace App\Console;

use App\Http\Api\APiClientSportCube;
use App\Http\Cache\CacheMatches;
use App\Http\Date\BuildDate;
use App\Http\Readdata\BuildMatch;
use Illuminate\Console\Scheduling\Schedule;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Cache;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->call(function () {
            $upDate = BuildDate::getUpDate();
            $api = new APiClientSportCube();
            $buildMatch = new BuildMatch($api);
            $matches = $buildMatch->run($upDate);
            CacheMatches::setMatches($matches);
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
