<?php

namespace App\Console\Commands;



use Illuminate\Console\Command;
use App\User;



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
        //
        $this->info('AlertCheck started for "'. $this->argument('step') .'" phase.');

        //[pro-memoria --> create Alerts table to avoid send more than one email to notification list (fields: id, user_id, is_sent [0,1,2,3] )] [testare migration without shell !!! ]

        // if step == culture_match ...
        // get all users that have payed last year
        $this->info('Get all payers from 1 year ago');
        // foreach user: check if Order::step_id < 3 and step_id > ??
        // if payment date is before 4 day ago --> send to notification list
        $this->info('Mail sent to notification list');


        $this->info('AlertCheck terminated');

        // $this->error('test');
        // $this->line('test');

    }
}
