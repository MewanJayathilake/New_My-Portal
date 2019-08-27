<?php



return [



    /*

    |--------------------------------------------------------------------------

    | User Defined Variables

    |--------------------------------------------------------------------------

    |

    | This is a set of variables that are made specific to this application

    | that are better placed here rather than in .env file.

    | Use config('your_key') to get the values.

    |

    */


     // sso api
    'api_key' => env('apitoken','Token f100f7996917af6e3bb841948e240e79653f5b21'),
    'apiurl' => env('apiurl','https://staging-sso-api.lsv.com.au/api/'),

     // aXcelerate API 

    'AXL_API_Token' => env('AXL_API_Token','D4E9A85F-C343-43A4-9586409C185B6ADF'),

    'AXL_WS_Token' => env('AXL_WS_Token','731D225A-2150-46FF-B7592205B2B79574'),

    'AXL_Url' => env('AXL_Url','https://stg.axcelerate.com.au/api/'),

];