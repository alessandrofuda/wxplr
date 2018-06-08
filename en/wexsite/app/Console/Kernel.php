<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Inspire::class,
        'App\Console\Commands\AppointmentEmail',
        Commands\AlertCheck::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

    // [ !!! IMPORTANT: for testing commands FROM CONSOLE --> "php5.6 artisan alert:check culture_match" because installed PHP 5.6 version in Homestead.yaml !!! ]


        $schedule->command('inspire')
                 ->hourly()
                 ->withoutOverlapping();

        $schedule->command('email:appointment')
                 ->cron('* * * * *')
                 ->withoutOverlapping();

        //$schedule->command('alert:check culture_match')
        //         ->dailyAt('05:00')
        //         ->withoutOverlapping();


        //$schedule->command('alert:check dream_check_lab')
        //         ->dailyAt('05:10')
        //         ->withoutOverlapping();


        //$schedule->command('alert:check calls')
        //         ->dailyAt('05:20')
        //         ->withoutOverlapping();
    }
}
