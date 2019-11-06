<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * Class Kernel
 * @package Grocelivery\IdentityProvider\Console
 */
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [];

    /**
     * @param  Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * @return void
     */
    protected function commands(): void
    {
//        $this->load(__DIR__.'/Commands');
//        require base_path('routes/console.php');
    }
}
