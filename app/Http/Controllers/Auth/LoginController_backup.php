<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Session;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\SocialMediaLink;
class LoginController extends Controller
{
/*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct(SocialMediaLink $socialmedialink)
    {
        $this->socialmedialink=$socialmedialink;
        $this->middleware('guest')->except('logout');
    }
    public function showlogin()
    {
        // get social media icon frm db
        $social_icons = $this->socialmedialink->where('status', '=', 1)->orderBy('sort')->get();

        return view('login',compact('social_icons'));
    }
     public function dologin(Request $request)
    {
 // set the server side validation
        $this->validate($request, [
        'username' => 'required',
        'password' => 'required',
      
    ]);
        // constant variables (global variable)
         $apitoken = config('constants.api_key');
         $apiurl = config('constants.apiurl');
         $axl_apiurl = config('constants.AXL_Url');
         $AXL_api_token = config('constants.AXL_API_Token');
         $AXL_ws_token = config('constants.AXL_WS_Token');
        
   
       // api connection sso
      $client = new Client([
         'base_uri' => $apiurl,]); 
      try {
        // posting request value to api
    $response = $client->request('POST', 'token/',[
    'form_params' => [
        "username" => $request['username'],
        "password"=>  $request['password'],     
    ],
    'headers' => ['Authorization' =>$apitoken ]
]);   

}
// error response
catch (\Exception $ex) {
   
      $response = $ex->getResponse();
     
     $responseBodyAsString = json_decode($response->getBody()->getContents(), true);
     // if user name and password is invalid

     if($responseBodyAsString['detail']='No active account found with the given credentials')
     {
        // set error msg in session
         \Session::flash('message','Invalid Credentials');
         return redirect('/login');
     }
}
//Get the response in SSO api (access & refresh)
$array = json_decode($response->getBody()->getContents(), true);

//set response(refresh)
 $refresh = isset($array['refresh']) ? $array['refresh']: 'error';
//set response(Access)
 $access = isset($array['access']) ? $array['access']: 'error';
 // set response detail
 $detail = isset($array['detail']) ? $array['detail']: 'ok';
 // check  response
if($detail == 'ok'){
// response refresh decode  json base64
 $getuser_details = json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $refresh)[1])))); 
//get user_id and member_id 
 $user_id = $getuser_details->user_id; 
 $member_id = $getuser_details->member_id; 
  // set user id and member_id in session
  $request->session()->put('user_id', $user_id);
  $request->session()->put('member_id', $member_id);  
// get login member details 
        // conenction to guzzle api
        $client = new Client([
        'base_uri' => $apiurl]); 
          $member_details = $client->request('GET', 'members/'.$member_id.'/', ['headers' => ['Authorization' => $apitoken, ]]);
          $get_member_details = json_decode($member_details->getBody());
          // get member email id

          $member_emailId = $get_member_details->email;
          $member_dob=$get_member_details->dob;
          $member_first_name=$get_member_details->first_name;
          $member_last_name=$get_member_details->last_name;
// get contact id from login user emailis

       //conenction to guzzle api
        $client = new Client([
        'base_uri' => $axl_apiurl]); 
        // set member email
        $get_contact= $client->request('GET', 'contacts/search',[
        'form_params' => ['EMAILADDRESS' => $member_emailId],
       'headers' => ['apitoken' => $AXL_api_token,
       'wstoken' => $AXL_ws_token,]
        ]);

        
        // get contact details 
         $get_contact_details = json_decode($get_contact->getBody());
         // for loop for get contact details
          for($i=0; $i<count($get_contact_details); $i++)
         {
            echo $givenname=$get_contact_details[$i]->SURNAME.'<br/>';
         }
          exit();   
            $givenname=$get_contact_details[$i]->GIVENNAME;
            dd($member_first_name);
            $suename=$get_contact_details[$i]->SURNAME;
            $d_of_b=$get_contact_details[$i]->DOB;
if($givenname==$member_first_name)
    // ||$suename==$member_last_name||$d_of_b==$member_dob
          { 
            if(!empty($get_contact_details[$i]))
            {
                $request->session()->put('contact_details', $get_contact_details[$i]);
                
                $contactID=$get_contact_details[$i]->CONTACTID ;
                $request->session()->put('contactID', $contactID);
            }
            else{
                 \Session::flash('message','invalid credentials');
         return redirect('/login');
            }


          //}
         
            // if the username & password are correcct redirect to the course page   
    return redirect('/course');
        }

    }
    else{

    \Session::flash('message','invalid credentials');
         return redirect('/login');
}

}public function logout(Request $request)
{
    // unset the session
    $auth =   $request->session()->get('user_id');
    if($auth){
        session()->forget('user_id');
        session()->flush();

    }
// if unset the session redirect loging page
         return redirect('/login');
}

}
