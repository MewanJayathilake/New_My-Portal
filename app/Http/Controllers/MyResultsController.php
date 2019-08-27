<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Session;

use GuzzleHttp\Client;

use DB;



class MyResultsController extends Controller

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
          $member_id = $request->session()->get('member_id');
        // conenction to guzzle api

        $client = new Client([

        'base_uri' => $axl_apiurl]); 

// $contact->CONTACTID; 

 $id = 2594099;// ranga's contact id
        $user = $client->request('GET', 'contact/enrolments/'.$id.'/',

         ['form_params' => ['type' => 'w', 'displayLength' =>10000],

       'headers' => ['apitoken' => $AXL_api_token,

       'wstoken' => $AXL_ws_token,]

        ]);

        // encode the details
         $enrolments = json_decode($user->getBody());

          $eLearning = array();

        //if they have > 0 enrolments, check any e-learning now. We will assign this later to save API calls

        if (count($enrolments) > 0) {

     //$contact->CONTACTID

      $id = 2594099;// ranga's  contact id
        $get_eLearning = $client->request('GET', 'contact/enrolments/'.$id.'/',

        ['form_params' => ['type' => 'el', 'displayLength' =>10000],
        'headers' => ['apitoken' => $AXL_api_token,
          'wstoken' => $AXL_ws_token,]

        ]);
        // encode the results
 $eLearning = json_decode($get_eLearning->getBody());

        }

  // conenction to guzzle api  sso
        $client = new Client([
        'base_uri' => $apiurl]); 
		
       $member_awards = $client->request('GET','members/'.$member_id.'/awards/',
         ['headers' => ['Authorization' => $apitoken, ]]);

       // $contactid = $contact->CONTACTID;
$get_surguard_transcript = json_decode($member_awards->getBody());
 $contactid = $id;
		
		// pass the parameter to view page
 return view('my-results', compact('enrolments','client','AXL_api_token','AXL_ws_token','contactid','eLearning','get_surguard_transcript'));

		}else{

			// if user is not loged in redrict to 

		\Session::flash('message','You are not logged in. Please log in');

         return redirect('/login');

		}

	}



 // generate certificate

  public function getCertificate($id){


     // get user id in session
     $auth =   $request->session()->get('contactID');
    // chk user is already loged in 
    if($auth){

      // global variables

         $axl_apiurl = config('constants.AXL_Url');

         $AXL_api_token = config('constants.AXL_API_Token');

         $AXL_ws_token = config('constants.AXL_WS_Token');


              // conenction to guzzle api axl

        $client = new Client([

        'base_uri' => $axl_apiurl]); 
      
         
 try {
  // get sucess results

      $get_certificate = $client->request('GET', 'contact/enrolment/certificate',

        ['form_params' => ['enrolID' => $id],

      
       'headers' => ['apitoken' => $AXL_api_token,

       'wstoken' => $AXL_ws_token,]

        ]);

}

      // error response

catch (\Exception $ex) {

     $response = $ex->getResponse();

   $responseBodyAsString = json_decode($response->getBody()->getContents(), true);

     //return $responseBodyAsString;
	 dd($responseBodyAsString['MESSAGES']);

} 

 // encode the results
    $certificates = json_decode($get_certificate->getBody());

      $pdf = $certificates->CERTIFICATE;

     return view('pdf', compact('pdf')); 

       

  }else{
   // if user not loged in redrict to login page with error msg 

  \Session::flash('message','You are not logged in. Please log in');

         return redirect('/login'); 

  }

}

	

}	



