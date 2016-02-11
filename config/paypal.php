<?php
return array(
    // set your paypal credential
    'client_id' => 'AZBNohXoBU-d9i1b8Z-xxkfiKT_KoLAmEEDW-8EJNtELznWAq1_SjHiaZCYaJXI4syjGAPFeSTUjm7rn',
    'secret' => 'EDzSTe869rmGEpdTF9HEfZUmKyfsDZQHCQuusIDPknn-tKxqevkWyE5vGKbG13n-T_Qm5g3yMgOH616h',

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