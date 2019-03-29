<?php

namespace App\Console\Commands;


use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Setting;
use App\Order;
use App\User;
use Mail;




class AlertCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alert:check {step}';  // step: culture_match || match_user_consultant || second_call 

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if user has terminated the phase after X days [culture_match, dream_check_lab, calls] & send email to notificationlist'; 


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $step = $this->argument('step'); // argument of command
        
        Log::info('Cron: start AlertCheck for '. $step);



        if($step === 'culture_match') {

            $daysAgo = 4;
            $step_id = 3;
            $phase = 'Culture Match Survey';

        } elseif ($step === 'dream_check_lab') {
            
            $daysAgo = 14;
            $step_id = 4; 
            $phase = 'Dream Check Lab';

        } elseif ($step === 'calls') {
            
            $daysAgo = 40;
            $step_id = 5; 
            $phase = 'Calls';

        } else {
            $this->error('Argument specified in the command is not correct. Retype..');
            exit();

        }




        // [ !!! IMPORTANT: for testing commands FROM CONSOLE --> "php5.6 artisan alert:check culture_match" because installed PHP 5.6 version in Homestead.yaml !!! ]

        $this->info('AlertCheck started for "'. $phase .'" phase.');
        Log::info('Cron: AlertCheck started for "'. $phase .'" phase.');
        
        // get users that registered 4 days ago        
        $registration_date = Carbon::now()->subDays($daysAgo)->toDateTimeString();
        $registration_date = explode(' ', $registration_date)[0]; 
        $users = User::where('created_at', 'like', '%'.$registration_date.'%')->get(['id'])->toArray();   
        $this->line('Found ' . count($users) . ' users registered '.$daysAgo.' days ago');
        Log::info('Cron: found ' . count($users) . ' users registered '.$daysAgo.' days ago');

        // get users that have NOT terminated the phase
        $incompleteds = [];
        if(count($users) > 0 ) {

            foreach ($users as $user) {
                $user_ids[] = $user['id'];
            }
        

            $incompleteds = Order::whereIn('user_id', $user_ids)
                                ->where('step_id', '<', $step_id)
                                ->get(['user_id'])
                                ->toArray();
        }

        $this->line(count($incompleteds).' of this users have NOT terminated "'. $phase . '" phase');     
        Log::info('Cron: '.count($incompleteds).' of this users have NOT terminated "'. $phase . '" phase');   
        // dd($incompleted);

        if(count($incompleteds) > 0) {

            foreach ($incompleteds as $incompleted) {
                $incompleted_user_id[] = $incompleted['user_id'];
            }
            

            $data['daysago'] = $daysAgo;
            $data['phase'] = $phase;
            $data['users'] = User::whereIn('id', $incompleted_user_id)->get(['name','surname','email'])->toArray();


            Mail::send('emails.alerts.culture_match', ['data' => $data], function($m) use ($data) {  
                
                $site_email = Setting::find(1)->website_email;
                $admin_emails = User::getNotificationList();

                $m->from($site_email, 'Wexplore');
                $m->to($admin_emails)->subject('One or more users have NOT completed "'. $data['phase'] . '" phase');
            });
 
            $this->line('Sent Alert Mail to notification list');
            Log::info('Cron: Sent Alert Mail to notification list');

        } else { 

            $this->line('No Alert Mail sent to notification list for "'. $phase .'" phase.');
            Log::info('Cron: No Alert Mail sent to notification list for "'. $phase .'" phase.');

        }

        $this->info('AlertCheck terminated');
        Log::info('Cron: end AlertCheck for '. $step);

        // $this->error('test');
        // $this->line('test');
        // $this->comment('test')

    }
}
