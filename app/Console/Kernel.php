<?php

namespace App\Console;

use App\Console\Commands\CrawlGuideRankingData;
use App\Console\Commands\CrawlRankingData;
use App\Console\Commands\CrawlCoupleRankingData;
use App\Console\Commands\CrawlServerList;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
//        $schedule->command(CrawlServerList::class)->hourly();
//        $schedule->command(CrawlLcRankingData::class)->hourly();
//        $schedule->command(CrawlCoupleRankingData::class)->hourly();
//        $schedule->command(CrawlGuideRankingData::class)->hourly();

        $schedule->command('data:crawl-server-list')->hourly()->withoutOverlapping();
        $schedule->command('data:crawl-ranking-data')->everyFifteenMinutes()->withoutOverlapping();
        $schedule->command('cache:clear')->everyFifteenMinutes()->withoutOverlapping();
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
