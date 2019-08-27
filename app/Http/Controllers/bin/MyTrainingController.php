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
        
        
        // conenction to guzzle api
        $client = new Client([
        'base_uri' => $axl_apiurl]); 
         

        $user = $client->request('GET', 'contact/enrolments/2594099/',
         ['form_params' => ['type' => 'w', 'displayLength' =>10000],
      
       'headers' => ['apitoken' => $AXL_api_token,
       'wstoken' => $AXL_ws_token,]
        ]);


         $enrolments = json_decode($user->getBody());
          $eLearning = array();
        //if they have > 0 enrolments, check any e-learning now. We will assign this later to save API calls
        if (count($enrolments) > 0) {

        $get_eLearning = $client->request('GET', 'contact/enrolments/2594099/',
        ['form_params' => ['type' => 'el', 'displayLength' =>10000],
      
       'headers' => ['apitoken' => $AXL_api_token,
       'wstoken' => $AXL_ws_token,]
        ]);

        $eLearning = json_decode($get_eLearning->getBody());    
        }
        

        $contactid = $contact->CONTACTID;
          //dd($get_enrolments_details);
          

             return view('my-training', compact('enrolments','client','AXL_api_token','AXL_ws_token','contactid','eLearning'));
		}else{
			
		\Session::flash('message','You are not logged in. Please log in');
         return redirect('/login');
		}
	}

	
}	
