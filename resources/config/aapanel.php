<?php 

return [

    // The URL of the AAPanel instance
    'url' => env('AAPANEL_URL', 'https://'),

    // The API key for the AAPanel instance
    'key' => env('AAPANEL_KEY', 'M1RHx7XVwrrfn1eapAdExRSijryPCxy0Kmc'),

    // The API version to use
    'version' => env('AAPANEL_VERSION', 'v1'),

    // The timeout for the API requests
    'timeout' => env('AAPANEL_TIMEOUT', 10),
];
