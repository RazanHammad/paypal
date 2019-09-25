<?php

return [
'sandbox_client_id' => env('PAYPAL_SANDBOX_CLIENT_ID'),
	'sandbox_secret' => env('PAYPAL_SANDBOX_SECRET'),

'settings' =>[
'mode' => env('PAYPAL_MODE','sandbox'),
'http.ConnectionTimeOut'  =>3000,
'log.LongEnabled' =>true,
'log.FileName' =>storage_path() . '/logs/paypal.log',
'log.LogLevel' => 'DEBUG',

],
	];