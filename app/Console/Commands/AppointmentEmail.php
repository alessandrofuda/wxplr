<?php

namespace App\Console\Commands;

use App\ConsultantAvailablity;
use App\ConsultantBooking;
use App\Setting;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;

class AppointmentEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:appointment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'You have appoinment';

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
        $bookings = ConsultantBooking::where('is_sent', 0)->where('state_id','!=',ConsultantBooking::STATE_CANCELLED)->get();
        Log::info('cron run');
        foreach( $bookings as $booking ) {

            $availability = ConsultantAvailablity::where('id', $booking->availablity_id)->first();

            if ($availability != null) {

                /* notifica un giorno prima dell'appuntamento */
                if ($availability->available_date <= strtotime("+1 day") && $availability->available_date >= strtotime("-1 day")) {
                    $booking->update(['is_sent' => 1]);
                    
                    /* Email to client */
                    $consulant = User::where('id', $availability->consultant_id)->first();
                    Log::info('cron run c'.$consulant->id);
                    $data['booking'] = $booking;
                    $user = User::where('id', $booking->user_id)->first();
                    $user_array = ['user_name' => $user->name . ' ' . $user->surname, 'user_id' => $user->id];
                    $to_email = $user->email;
                    Mail::send('emails.booking_client_notification', ['consultantbooking'=>$booking, 'user_array' => $user_array, 'data' => $data], function ($m) use ($to_email) {
                        $settings = Setting::find(1);
                        $site_email = $settings->website_email;
                        $m->from($site_email, 'Wexplore');
                        $m->to($to_email, 'Wexplore')->subject('You have appointment please log in 10-5 min before the booked time]');
                    });
                    
                    /* Email to Consultant */
                    $consulant_array = ['user_name' => $consulant->name . ' ' . $consulant->surname, 'user_id' => $consulant->id];
                    $to_email = $consulant->email;
                    Mail::send('emails.booking_consultant_notification', ['consultantbooking'=>$booking,'user_array' => $consulant_array, 'data' => $data], function ($m) use ($to_email) {
                        $settings = Setting::find(1);
                        $site_email = $settings->website_email;
                        $m->from($site_email, 'Wexplore');
                        $m->to($to_email, 'Wexplore')->subject('You have an appointment please log in 10-5 min before the booked time!');
                    });
                }
            }
        }



        /* notifica 2 ore prima dell'appuntamento */
        $bookings = ConsultantBooking::where('is_sent',1)->where('state_id','!=',ConsultantBooking::STATE_CANCELLED)->get();
        Log::info('cron run 2 hours');
        foreach( $bookings as $booking ) {

            $availability = ConsultantAvailablity::where('id', $booking->availablity_id)->first();

            if ($availability != null) {
                if ($availability->available_date <= strtotime("+2 hours")) {
                    $booking->update(['is_sent' => 2]);
                    /* Email to client */
                    $consulant = User::where('id', $availability->consultant_id)->first();
                    Log::info('cron run c'.$consulant->id);
                    $data['booking'] = $booking;
                    $user = User::where('id', $booking->user_id)->first();
                    $user_array = ['user_name' => $user->name . ' ' . $user->surname, 'user_id' => $user->id];
                    $to_email = $user->email;
                    Mail::send('emails.booking_client_notification', ['consultantbooking'=>$booking, 'user_array' => $user_array, 'data' => $data], function ($m) use ($to_email) {
                        $settings = Setting::find(1);
                        $site_email = $settings->website_email;
                        $m->from($site_email, 'Wexplore');
                        $m->to($to_email, 'Wexplore')->subject('You have appointment please log in 10-5 min before the booked time]');
                    });
                    /* Email to Consultant */
                    $consulant_array = ['user_name' => $consulant->name . ' ' . $consulant->surname, 'user_id' => $consulant->id];
                    $to_email = $consulant->email;
                    Mail::send('emails.booking_consultant_notification', ['consultantbooking'=>$booking,'user_array' => $consulant_array, 'data' => $data], function ($m) use ($to_email) {
                        $settings = Setting::find(1);
                        $site_email = $settings->website_email;
                        $m->from($site_email, 'Wexplore');
                        $m->to($to_email, 'Wexplore')->subject('You have an appointment please log in 10-5 min before the booked time!');
                    });
                }
            }
        }


        $this->info('You have an appointment!');
    }
}
