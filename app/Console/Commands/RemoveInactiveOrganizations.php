<?php

namespace App\Console\Commands;

use App\Models\CharitableOrganization;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RemoveInactiveOrganizations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inactive_orgs:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will soft delete Charitable Organizations that have last updated_at with 5 years or more.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $inactive_charities = CharitableOrganization::whereDate('updated_at', '<', Carbon::now()->subYears(5)->toDateTimeString())->get();
        foreach ($inactive_charities as $key => $item) {

            # Remove Profile Photo of Charity
            // $oldImg = $item->profile_photo;
            // if ($oldImg) unlink(public_path('upload/charitable_org/profile_photo/') . $oldImg);

            # Remove users of charities
            $users = User::where('charitable_organization_id', $item->id)->get();
            foreach ($users as $key => $user) {
                // $oldImg = $item->profile_photo;
                // if ($oldImg) unlink(public_path('upload/charitable_org/profile_photo/') . $oldImg);
                $user->delete();
                // Address::findOrFail($item->info->address_id)->delete();
            }

            # Remove actual organization
            $item->delete();
        }
        return 0;
    }
}
