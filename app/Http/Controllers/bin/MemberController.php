<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use GuzzleHttp\Client;
class MemberController extends Controller
{
	
	public function index(Request $request)
	{
		 $auth =   $request->session()->get('user_id');
		// dd($auth);
		if($auth){
			// constant variables
         $apitoken = config('constants.api_key');
         $apiurl = config('constants.apiurl');
         // get session value
          $member_id =   $request->session()->get('member_id');
        
          $client = new Client([
         'base_uri' => $apiurl,]); 
        // conenction to guzzle api
        $client = new Client([
        'base_uri' => $apiurl]); 
          $member_details = $client->request('GET', 'members/'.$member_id.'/', ['headers' => ['Authorization' => $apitoken, ]]);
          $get_member_details = json_decode($member_details->getBody());
          
             return view('member', compact('get_member_details'));
		}else{
			
		\Session::flash('message','You are not logged in. Please log in');
         return redirect('/login');
		}
	}
}	
