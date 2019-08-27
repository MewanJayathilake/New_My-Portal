<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use GuzzleHttp\Client;
use DB;
use App\Onsite;


class ModalController extends Controller

{
public function __construct(Onsite $Onsite)
    {
        $this->Onsite=$Onsite;
        
  
    }



	public function verify_certificate(Request $request)

	{
      // get user id in session
     $auth =   $request->session()->get('contactID');
    // chk user is already loged in 
    if($auth){

      // get global varibles

          $axl_apiurl = config('constants.AXL_Url');

         $AXL_api_token = config('constants.AXL_API_Token');

         $AXL_ws_token = config('constants.AXL_WS_Token');

     // get request vales
      $params = $request->all();

      $certificate = $params["id1"] . "-" . $params["id3"];

       // conenction to guzzle api axl

        $client = new Client([

        'base_uri' => $axl_apiurl]); 

  try {

        $get_results = $client->request('GET', 'contact/enrolment/verifyCertificate/'.$certificate.'',[

       'headers' => ['apitoken' => $AXL_api_token,

       'wstoken' => $AXL_ws_token]

        ]);



 $results = json_decode($get_results->getBody());
 // set sucess msg to display

 $result = json_encode(array("status" => "success", "message" => "Record verified", "results" => $results));

}// error response

catch (\Exception $ex) {

   $response = $ex->getResponse();
   $responseBodyAsString = json_decode($response->getBody()->getContents(), true);
     // set error msg to display
    $result = json_encode(array("status" => "error", "message" => "No record found, please contact us via email: training@lsv.com.au or phone: (03) 9676 6950"));

}
// return the sucess or error msg
  return $result;
		}else{

		 // if user not loged in redrict to login page with error msg	

		\Session::flash('message','You are not logged in. Please log in');

         return redirect('/login');

		}

	}


public function onsitetraining(Request $request)

    {
        // get user id in session
     $auth =   $request->session()->get('contactID');
    // chk user is already loged in 
    if($auth){

        //insert data into onpage Table------
$onsite_Data= $this->Onsite::create([
           
            'organisation_name'=>$request->organisation_name,
            'contact_name'=>$request->contact_name,
            'contact_number'=>$request->contact_number,
            'contact_email'=>$request->contact_email,
            'course'=>implode (",",$request->course),
            'course_venue'=>$request->course_venue,
            'trainig_session'=>$request->trainig_session,
            'additional_comment'=>$request->Additional_comment,
            
            ]);
  }else{

     // if user not loged in redrict to login page with error msg 

    \Session::flash('message','You are not logged in. Please log in');

         return redirect('/login');

    }

    }
	

}	

