<?php

namespace App\Console\Commands;

use App\Models\Address;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RemoveInactiveUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inactive_users:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $inactive_users = User::whereDate('updated_at', '<', Carbon::now()->subYears(5)->toDateTimeString())->where('role', '!=', 'Root Admin')->get();

        foreach ($inactive_users as $key => $item) {
            // $oldImg = $item->profile_image;
            // if ($oldImg) unlink(public_path('upload/avatar_img/') . $oldImg);
            $item->delete();
            // Address::findOrFail($item->info->address_id)->delete();
        }
        return 0;
    }
}
