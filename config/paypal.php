<?php

return array(

    /**
     * Set our Sandbox and Live credentials
     */
	'paypal_mode'	=> 'live',
	'sandbox_client_id' => env('PAYPAL_SANDBOX_CLIENT_ID', 'AddTN_OWP675fIVxuKT_c8GUxfMLn0xrLyV4cmjr-hkgqJOVD6lL5zBSTKkmWURXeMdyN7N6ET4MzdqJ'),
    'sandbox_secret' => env('PAYPAL_SANDBOX_SECRET', 'EOf90TwEeJUrIaZyN_n6cbkr4SzLBioIOvuFCmC1xb3w_MhwQw7Ag4RhyYHanmaatdDrkNyFoQAq9Ph3'),
    'sandbax_api_url' => env('PAYPAL_SANDBOX_API_URL', 'https://api.sandbox.paypal.com'),
	// 'sandbox_productId' => env('PAYPAL_SANDBOX_PRODUCT_ID', 'PROD-8RB87379NK620822Y'),
   
    'live_client_id' => env('PAYPAL_LIVE_CLIENT_ID', 'AQfobYRCbQss5pNHNnLk4sw5LHZ1LhU2vNERbo5UM81DmEugKxc67kU1J1PuKCC7Gw47UAwRogpXYoRg'),
    'live_secret' => env('PAYPAL_LIVE_SECRET', 'EF-pGEFbHRZsCHEtUn7Q7evwMi3VSuMTefuUsnbj6Yxl6-ZmW6KFpQwM1gn_BvkBs5C773zrBXZfgDuE'),
	// 'live_productId' => env('PAYPAL_LIVE_PRODUCT_ID', ''),
	'live_api_url' => env('PAYPAL_LIVE_API_URL', 'https://api.paypal.com'),
	



    
    /**
     * SDK configuration settings
     */
    'settings' => array(

        /** 
         * Payment Mode
         *
         * Available options are 'sandbox' or 'live'
         */
        'mode' => env('PAYPAL_MODE', 'sandbox'),
        
        // Specify the max connection attempt (3000 = 3 seconds)
        'http.ConnectionTimeOut' => 300000,
       
        // Specify whether or not we want to store logs
        'log.LogEnabled' => true,
        
        // Specigy the location for our paypal logs
        'log.FileName' => storage_path() . '/logs/paypal.log',
        
        /** 
         * Log Level
         *
         * Available options: 'DEBUG', 'INFO', 'WARN' or 'ERROR'
         * 
         * Logging is most verbose in the DEBUG level and decreases 
         * as you proceed towards ERROR. WARN or ERROR would be a 
         * recommended option for live environments.
         * 
         */
        'log.LogLevel' => 'DEBUG'
    ),
);