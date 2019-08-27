<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use GuzzleHttp\Client;
use DB;
use App\Courses;
class FindNewCourseController extends Controller
{

   public function __construct(Courses $courses)
    {
        $this->courses=$courses;
        
  
    }
	
	public function index(Request $request)
	{
     // get user id in session
		 $auth =   $request->session()->get('contactID');
		// chk user is already loged in 
		if($auth){
			
     // get course details frm db  
       
   $get_course_details = $this->courses->where('c_status',1)->get();     
       
  
    return view('course', compact('get_course_details'));
		}else{
			// if user not loged in redrict to login page with error msg
		\Session::flash('message','You are not logged in. Please log in');
         return redirect('/login');
		}
	}

	public function advancedSearch(Request $request)
	{
      // get user id in session
     $auth =   $request->session()->get('contactID');
    // chk user is already loged in 
    if($auth){
           // get global varibles
		     $axl_apiurl = config('constants.AXL_Url');
         $AXL_api_token = config('constants.AXL_API_Token');
         $AXL_ws_token = config('constants.AXL_WS_Token');
       
        
        // geting parameters pass to api
          if(isset($request) && $request['coursetype'] != ""){
          $params['ID'] = $request['coursetype'];
          }
          if(isset($request) && $request['courseid'] != ""){
          $params['INSTANCEID'] = $request['courseid'];
          }

          $params['startDate_min'] = date("Y-m-d");

          if (isset($request) && $request['startdate'] != "") {
          $tmp2 = explode("/", $request['startdate']);
          $params['startDate_max'] = "$tmp2[2]-$tmp2[0]-$tmp2[1]";

          } else {
          $params['startDate_max'] = '2050-01-01';
          }
          $params['public'] = false;
	
		
         $params['finishDate_min'] = date("Y-m-d");
         $params['finishDate_max'] = '2050-01-01';
         $params['type'] = "w";
		 
	
     // conenction to guzzle api axl
        $client = new Client([
        'base_uri' => $axl_apiurl]); 
 
        $courses = $client->request('POST', 'course/instance/search',[
        'form_params' => $params,
       'headers' => ['apitoken' => $AXL_api_token,
       'wstoken' => $AXL_ws_token,]
        ]);
 
        // encode the results 
        $get_course_details = json_decode($courses->getBody());
       
            // pass the parameter to page
        return view('ajax_table', compact('get_course_details','client','AXL_api_token','AXL_ws_token','axl_apiurl'));
  }else{
      // if user not loged in redrict to login page with error msg
    \Session::flash('message','You are not logged in. Please log in');
         return redirect('/login');
    }
          
	}
	
	
	public function entrollment(Request $request)
	{
		  // get user id in session
     $auth =   $request->session()->get('contactID');
    // chk user is already loged in 
    if($auth){
		    // get global varibles
		     $axl_apiurl = config('constants.AXL_Url');
         $AXL_api_token = config('constants.AXL_API_Token');
         $AXL_ws_token = config('constants.AXL_WS_Token');
		//6536706
$data_array['contactID'] = $request->contactID;
$data_array['instanceID'] = $request->instanceID;
$data_array['TYPE'] = $request->TYPE;

 // conenction to guzzle api axl
        $client = new Client([
        'base_uri' => $axl_apiurl]);

 try {
        // posting request value to api
   $enrolment = $client->request('POST', 'course/enrol',[
       'form_params' => $data_array,
       'headers' => ['apitoken' => $AXL_api_token,
       'wstoken' => $AXL_ws_token,]
        ]);

    // encode the results 
        $get_enrolment_details = json_decode($enrolment->getBody());
        // set sucess msg when user entrolled
	 $result = json_encode(array("status" => "success", "message" => "Sucessfully enrolled", "results" => $get_enrolment_details)); 

}
// error response
catch (\Exception $ex) {
	
   $response = $ex->getResponse();   
$responseBodyAsString = json_decode($response->getBody()->getContents(), true);
// set error msg when user not entrolled
	 $result = json_encode(array("status" => "error", "message" => "Sorry. The Contact  is already enrolled")); 


}
// return the results
return $result;

  }else{
      // if user not loged in redrict to login page with error msg
    \Session::flash('message','You are not logged in. Please log in');
         return redirect('/login');
    }
	}
}	
