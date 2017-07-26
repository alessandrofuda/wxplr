<?php
return array(
// set your paypal credential
'client_id' => 'ASwpyBeEKN450OAoz9Z1QNyRDlhQgfAeHqp4MHHerU5GRsnUyUq-qvIfPhWGjc1WrTBz-2e8MdLimhmF',
'secret' => 'EKgiuY_lGmRFxy-YTDmNsbHlsZyYhdFZaOK6ZUMIaXV0vINBJ4WRl788JO5aOy2xLEL6Szp-drsah9xh',
/**
* SDK configuration 
*/
'settings' => array(
/**
* Available option 'sandbox' or 'live'
*/
'mode' => 'sandbox',
/**
* Specify the max request time in seconds
*/
'http.ConnectionTimeOut' => 30,
/**
* Whether want to log to a file
*/
'log.LogEnabled' => true,
/**
* Specify the file that want to write on
*/
'log.FileName' => storage_path() . '/logs/paypal.log',
/**
* Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
*
* Logging is most verbose in the 'FINE' level and decreases as you
* proceed towards ERROR
*/
'log.LogLevel' => 'FINE'
),
);
