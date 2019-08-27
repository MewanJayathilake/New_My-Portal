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
		 $auth =   $request->session()->get('user_id');
		// dd($auth);
		if($auth){
			
     // get course details frm db  
       
   $get_course_details = $this->courses->where('c_status',1)->get();     
       
  
    return view('course', compact('get_course_details'));
		}else{
			
		\Session::flash('message','You are not logged in. Please log in');
         return redirect('/login');
		}
	}

	public function advancedSearch(Request $request)
	{
           // get global varibles
		 $axl_apiurl = config('constants.AXL_Url');
         $AXL_api_token = config('constants.AXL_API_Token');
         $AXL_ws_token = config('constants.AXL_WS_Token');
       
          //dd($request);
        
       
        // geting parameters
       if(isset($request) && $request['coursetype'] != ""){
			$params['ID'] = $request['coursetype'];
		}
        if(isset($request) && $request['courseid'] != ""){
			$params['INSTANCEID'] = $request['courseid'];
		}

         $params['startDate_min'] = date("Y-m-d");

		if (isset($request) && $request['startdate'] != "") {
        $params['startDate_max']= $request['startdate'];
        } else {
            $params['startDate_max'] = '2050-01-01';
         }
         $params['finishDate_min'] = date("Y-m-d");
         $params['finishDate_max'] = '2050-01-01';
         $params['type'] = "w";
        //$params['displayLength'] = 10000;
     // conenction to guzzle api
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

          
	}
}	
