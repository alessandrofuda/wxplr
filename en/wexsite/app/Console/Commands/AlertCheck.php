<?php

namespace App\Console\Commands;



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
    protected $description = 'Check if user has terminated the phase after X days [culture_match, ...]';  // and send email to User::getnotificationlist()

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
        
        //[pro-memoria --> create Alerts table to avoid send more than one email to notification list (fields: id, user_id, is_sent [0,1,2,3] )] [testare migration without shell !!! ]

        // [ !!! IMPORTANT: for testing commands FROM CONSOLE --> "php5.6 artisan alert:check culture_match" because installed PHP 5.6 version in Homestead.yaml !!! ]

        //
        $this->info('AlertCheck started for "'. $this->argument('step') .'" phase.');


        
        // get users that registered 4 days ago
        $daysAgo = 4;
        $registration_date = Carbon::now()->subDays($daysAgo)->toDateTimeString();
        $registration_date = explode(' ', $registration_date)[0]; 
        $users = User::where('created_at', 'like', '%'.$registration_date.'%')->get(['id'])->toArray();   
        $this->line('Found ' . count($users) . ' users registered '.$daysAgo.' days ago');



        // get users that havo NOT terminated the phase
        foreach ($users as $user) {
            $user_ids[] = $user['id'];
        }

        $incompleteds = Order::whereIn('user_id',$user_ids)
                            ->where('step_id', '<', 3)
                            ->get(['user_id'])
                            ->toArray();

        $this->line(count($incompleteds).' of this users have NOT terminated '. $this->argument('step'). ' phase');        
        // dd($incompleted);

        if(count($incompleteds) > 0) {

            foreach ($incompleteds as $incompleted) {
                $incompleted_user_id[] = $incompleted['user_id'];
            }
            

            $data['daysago'] = $daysAgo;
            // $data['phase'] = $this->argument('step');
            $data['users'] = User::whereIn('id', $incompleted_user_id)->get(['name','surname','email'])->toArray();

            Mail::send('emails.alerts.culture_match', ['data' => $data], function($m) use ($data) {  
                
                $site_email = Setting::find(1)->website_email;
                $admin_emails = User::getNotificationList();

                $m->from($site_email, 'Wexplore');
                $m->to($admin_emails)->subject('One or more users have NOT completed Culture Match Survey');
            });
 
            $this->line('Sent Alert Mail to notification list');

        } else { 

            $this->line('No Alert Mail sent to notification list');

        }

        $this->info('AlertCheck terminated');

        // $this->error('test');
        // $this->line('test');

    }
}
