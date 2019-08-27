<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use GuzzleHttp\Client;
use DB;
use App\course_create;
use App\Courses;

class AdiministraterController extends Controller
{


    public function __construct(Courses $courses)
    
  
    {
        $this->courses=$courses;
        
  
    }
 

// public function ajaxRequestPost(Request $request)

//     {

//         //insert data into onpage Table------
// $onsite_Data= $this->Onsite::create([
           
//             'organisation_name'=>$request->organisation_name,
//             'contact_name'=>$request->contact_name,
//             'contact_number'=>$request->contact_number,
//             'contact_email'=>$request->contact_email,
//             'course'=>implode (",",$request->course),
//             'course_venue'=>$request->course_venue,
//             'trainig_session'=>$request->trainig_session,
//             'additional_comment'=>$request->Additional_comment,
            
//             ]);
// ;

//     }



    
    public function index(Request $request){
$auth =   $request->session()->get('user_id');
		// dd($auth);
		if($auth){
			// constant variables
       
         $axl_apiurl = config('constants.AXL_Url');
         $AXL_api_token = config('constants.AXL_API_Token');
         $AXL_ws_token = config('constants.AXL_WS_Token');
         
         // get session value
          $member_id =   $request->session()->get('member_id');
        
       //dd($member_id);
        // conenction to guzzle api
        $client = new Client([
        'base_uri' => $axl_apiurl]); 
         

        $location = $client->request('GET', 'course/locations',[
       'headers' => ['apitoken' => $AXL_api_token,
       'wstoken' => $AXL_ws_token,]
        ]);

          $get_course_location = json_decode($location->getBody());
$user = session()->get('contact_details');
// dd($user);
 
// exit();
$get_course_details = $this->courses->where('c_status',1)->get();

        return view('administrater',compact('get_course_details','get_course_location','user',));
// return view('administrater',compact('get_course_location'));
    }
    else{
			
		\Session::flash('message','You are not logged in. Please log in');
         return redirect('/login');
		}
}

public function get_delivery_mode($id)
    {
     $get_delevery_method = $this->courses->where('c_id',$id)->get(); 
        return json_encode($get_delevery_method);
    }
    

public function create_course_details( Request $request )
{

    $get_input = $request->all();

        return response()->json(['success'=>$get_input]);
      
}

}
