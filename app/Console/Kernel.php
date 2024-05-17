<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        // Register your custom command here
        //Registered supply Report command
        \App\Console\Commands\supply\WeeklyReport::class,
        \App\Console\Commands\supply\MonthlyReport::class,
        \App\Console\Commands\supply\AnnualReport::class,

        //Registerd equipment Report Command
        \App\Console\Commands\equipment\AnnualEquipmentReport::class,
        \App\Console\Commands\equipment\MonthlyEquipmentReport::class,
        \App\Console\Commands\equipment\WeeklyEquipmentReport::class,
    ];
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        //Supply Generate Report Command
        $schedule->command('generate:supply-weekly-report')->everyMinute();
        $schedule->command('generate:supply-monthly-report')->everyTwoMinutes();
        $schedule->command('generate:supply-annual-report')->everyThreeMinutes();

        $schedule->command('generate:equipment-weekly-report')->everyMinute();
        $schedule->command('generate:equipment-monthly-report')->everyTwoMinutes();
        $schedule->command('generate:equipment-annual-report')->everyThreeMinutes();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
