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
        $social_icons = $this->socialmedialink->where('status', '=', 1)->orderBy('sort')->get();

        return view('login',compact('social_icons'));
    }

    public function dologin(Request $request)
    {

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
        
   
       // api connection
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
    // do nothing
     //\Log::error($ex);
     
     $response = $ex->getResponse();
     
     $responseBodyAsString = json_decode($response->getBody()->getContents(), true);

     if($responseBodyAsString['detail']='No active account found with the given credentials')
     {
        // set error msg in session
         \Session::flash('message','invalid credentials');
         return redirect('/login');
     }
}   


$array = json_decode($response->getBody()->getContents(), true);


 $refresh = isset($array['refresh']) ? $array['refresh']: 'error';
       
 $access = isset($array['access']) ? $array['access']: 'error';
 $detail = isset($array['detail']) ? $array['detail']: 'ok';

if($detail == 'ok'){

 $getuser_details = json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $refresh)[1])))); 

 $user_id = $getuser_details->user_id; 
  
  // set user id in session
  $request->session()->put('user_id', $user_id);

 // get member details 
 $member_details = $client->request('GET', 'memberships/'.$user_id.'/',
  ['headers' => ['Authorization' => $apitoken]]);

        $get_member_details = json_decode($member_details->getBody());
        $get_member_id = $get_member_details->member;
// set member id session
     $request->session()->put('member_id', $get_member_id);

    // get login member details

           // get session value
         
        
          $client = new Client([
         'base_uri' => $apiurl,]); 
        // conenction to guzzle api
        $client = new Client([
        'base_uri' => $apiurl]); 
          $member_details = $client->request('GET', 'members/'.$get_member_id.'/', ['headers' => ['Authorization' => $apitoken, ]]);
          $get_member_details = json_decode($member_details->getBody());
          // get member email id

          $member_emailId = $get_member_details->email;

         // get contact id from login user emailis

       //conenction to guzzle api
        $client = new Client([
        'base_uri' => $axl_apiurl]); 
 
        $get_contact= $client->request('GET', 'contacts/search',[
        'form_params' => ['EMAILADDRESS' => $member_emailId],
       'headers' => ['apitoken' => $AXL_api_token,
       'wstoken' => $AXL_ws_token,]
        ]);

         $get_contact_details = json_decode($get_contact->getBody());
         
            if(!empty($get_contact_details))
            {
                $request->session()->put('contact_details', $get_contact_details[0]);
            }
            
       

    
  return redirect('/course');
}else{
    \Session::flash('message','invalid credentials');
         return redirect('/login');
}
}


public function logout(Request $request)
{
    $auth =   $request->session()->get('user_id');
    if($auth){
        session()->forget('user_id');
        session()->flush();

    }

         return redirect('/login');
}
}