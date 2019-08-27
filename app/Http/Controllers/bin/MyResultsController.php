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
    
		 $auth =   $request->session()->get('user_id');
		// dd($auth);
		if($auth){
			// constant variables
       
         $axl_apiurl = config('constants.AXL_Url');
         $AXL_api_token = config('constants.AXL_API_Token');
         $AXL_ws_token = config('constants.AXL_WS_Token');
         $apitoken = config('constants.api_key');
         $apiurl = config('constants.apiurl');
         // get session value
         //  get contact id
          $contact =   Session::get('contact_details');
        // dd($contact);
        
        // conenction to guzzle api
        $client = new Client([
        'base_uri' => $axl_apiurl]); 
         
  
        $user = $client->request('GET', 'contact/enrolments/'.$contact->CONTACTID.'/',
         ['form_params' => ['type' => 'w', 'displayLength' =>10000],
      
       'headers' => ['apitoken' => $AXL_api_token,
       'wstoken' => $AXL_ws_token,]
        ]);


         $enrolments = json_decode($user->getBody());
          $eLearning = array();
        //if they have > 0 enrolments, check any e-learning now. We will assign this later to save API calls
        if (count($enrolments) > 0) {

        $eLearning = $client->request('GET', 'contact/enrolments/'.$contact->CONTACTID.'/',
        ['form_params' => ['type' => 'el', 'displayLength' =>10000],
      
       'headers' => ['apitoken' => $AXL_api_token,
       'wstoken' => $AXL_ws_token,]
        ]);

            
        }

        $contactid = $contact->CONTACTID;
        
          

             return view('my-results', compact('enrolments','client','AXL_api_token','AXL_ws_token','contactid','eLearning'));
		}else{
			
		\Session::flash('message','You are not logged in. Please log in');
         return redirect('/login');
		}
	}

 // generate certificate
  public function getCertificate($id){

   $auth =   session()->get('user_id');
    if($auth){
      // constant variables
       
         $axl_apiurl = config('constants.AXL_Url');
         $AXL_api_token = config('constants.AXL_API_Token');
         $AXL_ws_token = config('constants.AXL_WS_Token');

              // conenction to guzzle api
        $client = new Client([
        'base_uri' => $axl_apiurl]); 
         
 try {
      $get_certificate = $client->request('GET', 'contact/enrolment/certificate',
        ['form_params' => ['enrolID' => $id],
      
       'headers' => ['apitoken' => $AXL_api_token,
       'wstoken' => $AXL_ws_token,]
        ]);

      $certificates = json_decode($get_certificate->getBody());
      $pdf = $certificates->CERTIFICATE;
}
      // error response
catch (\Exception $ex) {
    // do nothing
   
    $response = $ex->getResponse();
   $responseBodyAsString = json_decode($response->getBody()->getContents(), true);
     dd($responseBodyAsString['MESSAGES']);
     
} 

     
    
      
     return view('pdf', compact('pdf')); 
       
  }else{
  \Session::flash('message','You are not logged in. Please log in');
         return redirect('/login'); 
  }
}
	
}	

