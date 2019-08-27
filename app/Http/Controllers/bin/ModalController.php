<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use GuzzleHttp\Client;
use DB;

class ModalController extends Controller
{

 
	
	public function verify_certificate(Request $request)
	{
		 $auth =   $request->session()->get('user_id');
		
		if($auth){

    
      // get global varibles
          $axl_apiurl = config('constants.AXL_Url');
         $AXL_api_token = config('constants.AXL_API_Token');
         $AXL_ws_token = config('constants.AXL_WS_Token');

			
      $params = $request->all();
      $certificate = $params["id1"] . "-" . $params["id3"];


       // conenction to guzzle api
        $client = new Client([
        'base_uri' => $axl_apiurl]); 
  try {
        $get_results = $client->request('GET', 'contact/enrolment/verifyCertificate/'.$certificate.'',[
       'headers' => ['apitoken' => $AXL_api_token,
       'wstoken' => $AXL_ws_token]
        ]);

 $results = json_decode($get_results->getBody());
 $result = json_encode(array("status" => "success", "message" => "Record verified", "results" => $results));
}// error response
catch (\Exception $ex) {
   $response = $ex->getResponse();
     
     $responseBodyAsString = json_decode($response->getBody()->getContents(), true);
    $result = json_encode(array("status" => "error", "message" => "No record found, please contact us via email: training@lsv.com.au or phone: (03) 9676 6950"));
}
        return $result;
    //}
		}else{
			
		\Session::flash('message','You are not logged in. Please log in');
         return redirect('/login');
		}
	}

  public function onsite_training(Request $request)
  {
      try {
            $data = $request->all();
            $data['Courses'] = implode(",", $params['Courses']);
            Mail::send('course_group_mail', ['organisation' => $data["OrganisationName"], "contact_name" => $data['ContactName'],
                "contact_email" => $data['ContactEmail'], "contact_number" => $data['ContactNumber'], "venue" => $data['CourseVenue'],
                "date" => $data['Date'], "comments" => $data['AdditionalComments'], "courses" => $data['Courses']], function ($message) use ($data) {
                $message->to('palika@230i.com', 'Training')->subject
                ('New group training enquiry');
                $message->from($data['ContactEmail'], $data['ContactName']);
            });
            $status["success"] = "New group training enquiry";
            $status["error"] = "";
        } catch (\Exception $exception) {
            $status["error"] = "An error occurred";
            $status["success"] = "";
        }
  }

	
}	
