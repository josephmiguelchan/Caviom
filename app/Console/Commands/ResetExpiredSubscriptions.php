<?php

namespace App\Console\Commands;

use App\Models\CharitableOrganization;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ResetExpiredSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expired_subscriptions:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will revert subscriptions back to FREE for those subscriptions that already expired.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        CharitableOrganization::whereDate('subscription_expires_at', '<=', Carbon::now()->toDateTimeString())
            ->update([
                'subscription' => 'Free',
                'subscribed_at' => null,
                'subscription_expires_at' => null
            ]);
        return 0;
    }
}
