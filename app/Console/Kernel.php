<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\CharitableOrganization;
use Illuminate\Support\Facades\DB;

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
        // $schedule->command('inspire')->hourly();

        $schedule->call(function () {
            CharitableOrganization::whereDate('subscription_expires_at', '<=', now())
                ->update([
                    'subscription' => 'Free',
                    'subscribed_at' => null,
                    'subscription_expires_at' => null
                ]);
        })->everyMinute();

        /*
        $schedule->call(function () {

            $orders = Order::whereDate('status_updated_at', '<', Carbon::now()->subYear()->toDateTimeString())->get(); // or ->toArray();
            foreach ($orders as $key => $item) {
                $oldImg = $item->proof_of_payment;
                if ($oldImg) unlink(public_path('upload/orders/') . $oldImg);
                $item->delete();
            }

        })->everyMinute();
        */
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
