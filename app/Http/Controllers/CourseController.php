<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Session;

use GuzzleHttp\Client;

use DB;

use App\Courses;



class CourseController extends Controller

{



   public function __construct(Courses $courses)

    {

        $this->courses=$courses;

        

  

    }

	

	public function store(Request $request)

	{
     // get user id in session
		 $auth =   $request->session()->get('user_id');

		// chk user is already loged in 

		if($auth){

			// get global varibles

         $axl_apiurl = config('constants.AXL_Url');

         $AXL_api_token = config('constants.AXL_API_Token');

         $AXL_ws_token = config('constants.AXL_WS_Token');

         $apitoken = config('constants.api_key');

         $apiurl = config('constants.apiurl');

         // get session value

          $member_id =   $request->session()->get('member_id');

        // conenction to guzzle api axl

        $client = new Client([

        'base_uri' => $axl_apiurl]); 

         // get all course details 

          $allcourses = $client->request('GET', 'courses/',[

         'form_params' => ['displayLength'=>10000,

                          'isActive'=>1,
                           ],   

       'headers' => ['apitoken' => $AXL_api_token,

       'wstoken' => $AXL_ws_token,]

        ]);

          // decode and get cose details
          $all_course_details = json_decode($allcourses->getBody());

     


// use foreach loop to insert into tbl
foreach ($all_course_details as $course_list) {

            // chk course already exit in the db

            $chk_course = $this->courses->where('c_id',$course_list->ID)->get();


     //if course count is equal to 0 insert the data
          if(count($chk_course) == 0){

          $course= $this->courses::create([

            'c_id' => $course_list->ID,

            'c_name' => $course_list->NAME,

            'c_streamname' => $course_list->STREAMNAME,

            'c_code' => $course_list->CODE,

            'c_delivery'=>$course_list->DELIVERY,

            'c_isactive'=> $course_list->ISACTIVE,

            'c_type'=> $course_list->TYPE,

            'c_shortdescription'=> $course_list->SHORTDESCRIPTION,

            'c_primaryimage'=> $course_list->PRIMARYIMAGE,

            'c_secondaryimage'=> $course_list->SECONDARYIMAGE,

            'c_status'=>1,

          
            ]);

        }

             

           }


		}else{

			// if user not loged in redrict to login page with error msg

		\Session::flash('message','You are not logged in. Please log in');

         return redirect('/login');

		}

	}



	

}	

