<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use SoftDeletes;
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deleted_at', 'logo','website_email','timings','facebook_active','facebook_url','twitter_active','twitter_url','linkedin_active','linkedin_url','google_plus_active','google_plus_url','behance_active','behance_url','location_address','website_phone','contact_us_email','copyright','currency_type'
    ];
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'settings';

    public static function saveUploadedImage($image_file,$old_image = '') {
        $base_path = base_path();
        $base_path = str_replace("/wexsite", "", $base_path);
        $file_save_folder_path = '/uploads/';
        // get cv file
        $image_file_path = '';
        if($old_image != '') {
            $image_file_path = $old_image;
        }
        $old_image_path = '';
        if (!empty($image_file)) {
            $image_original_name = $image_file->getClientOriginalName();
            if (file_exists($base_path . $file_save_folder_path . $image_original_name)) {
                $image_file_name = time() . '-' . $image_original_name;
                //$outcome_image->getClientOriginalExtension();
            } else {
                $image_file_name = $image_original_name;
            }
            $image_file_name = str_replace(' ', '-', $image_file_name);
            $image_file_path = $file_save_folder_path . $image_file_name;
            $image_public_path = $base_path . $file_save_folder_path;
            if($image_file->move($image_public_path, $image_file_name) ) {
                if($old_image != '') {
                    $old_image_path = $base_path.$old_image;
                    @unlink($old_image_path);
                }
            }
        }
        return $image_file_path;
    }


    public static function getTimeZone(){
       /* $clientsIpAddress = self::get_client_ip();

        $clientInformation = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$clientsIpAddress));

        $clientsLatitude = $clientInformation['geoplugin_latitude'];
        $clientsLongitude = $clientInformation['geoplugin_longitude'];
        $clientsCountryCode = $clientInformation['geoplugin_countryCode'];

        $timeZone = self::get_nearest_timezone($clientsLatitude, $clientsLongitude, $clientsCountryCode) ;*/

        return session('timezone');

    }

    public static function get_nearest_timezone($cur_lat, $cur_long, $country_code = '') {
        $timezone_ids = ($country_code) ? \DateTimeZone::listIdentifiers(\DateTimeZone::PER_COUNTRY, $country_code)
            : \DateTimeZone::listIdentifiers();

        if($timezone_ids && is_array($timezone_ids) && isset($timezone_ids[0])) {

            $time_zone = '';
            $tz_distance = 0;

            //only one identifier?
            if (count($timezone_ids) == 1) {
                $time_zone = $timezone_ids[0];
            } else {

                foreach($timezone_ids as $timezone_id) {
                    $timezone = new \DateTimeZone($timezone_id);
                    $location = $timezone->getLocation();
                    $tz_lat   = $location['latitude'];
                    $tz_long  = $location['longitude'];

                    $theta    = $cur_long - $tz_long;
                    $distance = (sin(deg2rad($cur_lat)) * sin(deg2rad($tz_lat)))
                        + (cos(deg2rad($cur_lat)) * cos(deg2rad($tz_lat)) * cos(deg2rad($theta)));
                    $distance = acos($distance);
                    $distance = abs(rad2deg($distance));
                    // echo '<br />'.$timezone_id.' '.$distance;

                    if (!$time_zone || $tz_distance > $distance) {
                        $time_zone   = $timezone_id;
                        $tz_distance = $distance;
                    }

                }
            }
            return  $time_zone;
        }
        return 'unknown';
    }

    public static function file_get_contents_curl($url) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    public static function get_client_ip() {
        $externalContent = self::file_get_contents_curl('http://checkip.dyndns.com/');
        preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', $externalContent, $m);
        $externalIp = $m[1];
        return $externalIp;
    }

    public static function dump($data) {
        echo '<pre>';print_r($data);echo '<br/>';exit;
    }

    public static function getDateTime($date, $time = true, $format = 'M d, Y') {
        $timezone = 'Europe/Rome';

       // if(\Auth::check()) {
            if(\Session::has('timezone')) {
                $timezone = \Session::get('timezone');
            }else{
                $timezone = self::getTimeZone();

                if($timezone == '') {
                    $timezone = 'Europe/Rome';
                }
                
                \Session::put('timezone', $timezone);
            }
       // }

        $date = new \DateTime($date, new \DateTimeZone('UTC'));

        $date->setTimezone(new \DateTimeZone($timezone));

        if($time == false)
            return $date->format($format);

        return $date->format('Y-m-d h:i a');
    }

    public static function dateUtc($date,$time = false, $format = 'Y-m-d') {
        $timezone = 'Europe/Rome';

        if(\Auth::check()) {
            if(\Session::get('user_timezone') != '') {
                $timezone = \Session::get('user_timezone');
            }else{
                $timezone = self::getTimeZone();
                \Session::put('user_timezone', $timezone);
            }
        }

        $date = new \DateTime($date, new \DateTimeZone($timezone));

        $date->setTimezone(new \DateTimeZone('UTC'));
        if($time == false)
            return $date->format($format);

        return $date->format('H:i:s');
    }
}