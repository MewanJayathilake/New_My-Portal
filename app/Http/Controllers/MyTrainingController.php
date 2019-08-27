<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use GuzzleHttp\Client;
use DB;


class MyTrainingController extends Controller

{

	public function index(Request $request)

	{
// get user id in session
     $auth =   $request->session()->get('contactID');
    // chk user is already loged in 
    if($auth){

			// global variables


         $axl_apiurl = config('constants.AXL_Url');

         $AXL_api_token = config('constants.AXL_API_Token');

         $AXL_ws_token = config('constants.AXL_WS_Token');

         $apitoken = config('constants.api_key');

         $apiurl = config('constants.apiurl');

         // get session value

          $contact =   Session::get('contact_details');

        
        // conenction to guzzle api axl

        $client = new Client([

        'base_uri' => $axl_apiurl]); 

      
        $user = $client->request('GET', 'contact/enrolments/2594099/',

         ['form_params' => ['type' => 'w', 'displayLength' =>10000],

      

       'headers' => ['apitoken' => $AXL_api_token,

       'wstoken' => $AXL_ws_token,]

        ]);

// encode the results
         $enrolments = json_decode($user->getBody());
         // create an array

          $eLearning = array();

        //if they have > 0 enrolments, check any e-learning now. We will assign this later to save API calls

        if (count($enrolments) > 0) {


     // 2594099
        $get_eLearning = $client->request('GET', 'contact/enrolments/2594099/',

        ['form_params' => ['type' => 'el', 'displayLength' =>10000],

       'headers' => ['apitoken' => $AXL_api_token,

       'wstoken' => $AXL_ws_token,]

        ]);


        // encode the results
        $eLearning = json_decode($get_eLearning->getBody());    

        }

        //$contactid = $contact->CONTACTID;
          $contactid =2594099;

           return view('my-training', compact('enrolments','client','AXL_api_token','AXL_ws_token','contactid','eLearning'));

		}else{
 // if user not loged in redrict to login page with error msg 

		\Session::flash('message','You are not logged in. Please log in');

         return redirect('/login');

		}

	}



	

}	

