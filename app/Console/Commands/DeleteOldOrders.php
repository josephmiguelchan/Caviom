<?php

namespace App\Console\Commands;

use App\Models\Admin\order;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteOldOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'old_orders:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will automatically delete orders with status_updated_at for more than a year.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $orders = order::whereDate('status_updated_at', '<', Carbon::now()->subYears(2)->toDateTimeString())->get(); // or ->toArray();

        foreach ($orders as $key => $item) {
            $oldImg = $item->proof_of_payment;
            if ($oldImg) unlink(public_path('upload/orders/') . $oldImg);
            $item->delete();
        }

        return 0;
    }
}
