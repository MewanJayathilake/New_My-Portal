<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use GuzzleHttp\Client;
use DB;


class UserController extends Controller
{

   // public function __construct(Courses $courses)
   //  {
   //      $this->courses=$courses;
        
  
   //  }
	
  public function my_details()
  {
    $user = session()->get('contact_details');

    return view('my-details',compact('user'));
  }


     public function profile($id)
    {

             // get global varibles
         $axl_apiurl = config('constants.AXL_Url');
         $AXL_api_token = config('constants.AXL_API_Token');
         $AXL_ws_token = config('constants.AXL_WS_Token');



             // conenction to guzzle api
        $client = new Client([
        'base_uri' => $axl_apiurl]); 
         try {
 
       

       $contact = $client->request('GET', 'contact/'.$id,[
       'headers' => ['apitoken' => $AXL_api_token,
       'wstoken' => $AXL_ws_token,]
        ]);

$get_contact_details = json_decode($contact->getBody());

$response = array("status" => "success",  "contactDetails" => $get_contact_details);

}catch (\Exception $ex) {
        // encode the results 
   $response = $ex->getResponse();
     
     $responseBodyAsString = json_decode($response->getBody()->getContents(), true);
   $response = array("status" => "error", "message" => "An error occurred: $results->MESSAGES");
      
       
        }

        return json_encode($response);
    }



  public function update_mydetails(Request $request)
  {
dd($request);
exit();
        // get global varibles
     $axl_apiurl = config('constants.AXL_Url');
         $AXL_api_token = config('constants.AXL_API_Token');
         $AXL_ws_token = config('constants.AXL_WS_Token');


    $params = $request->all();
        // unset($params["_token"]);
        // unset($params["url"]);
        $update_details = array(
            "givenName" => $params->givenName,
            "surname" => $params->surname,
            "emailAddress" => $params->emailAddress,
            "title" => $params->title,
            "sex" => $params->sex,
            "dob" => $params->dob,
            "buildingName" => $params->buildingName,
            "unitNo" => $params->unitNo,
            "streetNo" => $params->streetNo,
            "streetName" => $params->streetName,
            "city" => $params->city,
            "state" => $params->state,
            "postcode" => $params->postcode,
            "POBox" => $params->POBox,
            "sbuildingName" => $params->sbuildingName,
            "sstreetNo" => $params->sstreetNo,
            "sstreetName" => $params->sstreetName,
            "scity" => $params->scity,
            "sstate" => $params->sstate,
            "spostcode" => $params->spostcode,
            "phone" => $params->phone,
            "workphone" => $params->workphone,
            "mobilephone" => $params->mobilephone,
            "CountryofBirthID" => $params->CountryofBirthID,
            "CountryofBirthID" => $params->CountryofBirthID,
            "IndigenousStatusID" => $params->IndigenousStatusID,
            "MainLanguageID" => $params->MainLanguageID,
            "MainLanguageID" => $params->MainLanguageID,
            "EnglishProficiencyID" => $params->EnglishProficiencyID,
            "DisabilityFlag" => $params->DisabilityFlag,
            "customField1" => $params->customField1,
            "USI" => $params->USI,
            "HighestSchoolLevelID" => $params->HighestSchoolLevelID,
            "HighestSchoolLevelYear" => $params->HighestSchoolLevelYear,
            "AtSchoolFlag" => $params->AtSchoolFlag,
            "LabourForceID" => $params->LabourForceID,
            "DisabilityTypeIDs" =>$params->DisabilityTypeIDs,
            "PriorEducationIDs" => $params->PriorEducationIDs,
            "contactID" => $params->contactID,
          );



             // conenction to guzzle api
        $client = new Client([
        'base_uri' => $axl_apiurl]); 
         try {
 
        $user = $client->request('PUT', 'contact/'.$params->contactID.'/',[
        'form_params' => $update_details,
       'headers' => ['apitoken' => $AXL_api_token,
       'wstoken' => $AXL_ws_token,]
        ]);
        $get_user_details = json_decode($user->getBody());
 $response = array("status" => "success", "message" => "You have successfully updated your details.");
}catch (\Exception $ex) {
        // encode the results 
   $response = $ex->getResponse();
     
     $responseBodyAsString = json_decode($response->getBody()->getContents(), true);
   $response = array("status" => "error", "message" => $responseBodyAsString->MESSAGES, "response" => $responseBodyAsString);
      
       
        }
        return json_encode($response);
}
	
}	
