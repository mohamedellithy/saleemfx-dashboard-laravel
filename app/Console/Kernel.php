<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\User;
use App\ExpireCashback;
use Illuminate\Support\Facades\Http;
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
        // $schedule->command('inspire')->hourly();
        $schedule->call(function(){
            // $date_max_ended = strtotime("-".Options()->setting['max_date_cashback_withdraw']." months");
            // $users = User::where('role','!=',1)->get();
            // foreach($users as $user):
            //     $rest_value = $user->total_cashback_can_withdraw() - $user->cashbacks()->where('cash_backs.created_at','>=',date('Y-m-d H:i:s',$date_max_ended))->sum('value');
            //     if($rest_value > 0):
            //         $user->expire_cashbacks()->updateOrCreate([
            //             "user_id" => $user->id
            //             ],[
            //             'value'   => $rest_value
            //         ]);
            //     endif;
            // endforeach;
            Http::get("https://webhook.site/11d7346f-73f8-4e5a-aeff-dd674907847d");
        })->name('run_expire_cashbacks');
        //->withoutOverlapping()->everyMinute()->timezone('Africa/Cairo')->onOneServer();

        //->monthly();
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
