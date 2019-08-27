@extends('layouts.app')

@section('content')
 <table id="table_id" class="display">
    <thead>
        <tr>
            <th>Course Type</th>
            <th>Start Date</th>
            <th>Session</th>
            <th>Location</th>
            <th>Delivery Method</th>
            <th>Spaces Available</th>
            <th>Enrol</th>
        </tr>
    </thead>
    <tbody id="tbody">


      @for($i=0; $i< count($get_course_details); $i++)
    <?php 

$data_array['contactID'] = 6536706;
$data_array['instanceID'] = $get_course_details[$i]->INSTANCEID;
$data_array['TYPE'] = $get_course_details[$i]->TYPE;

 try {
        // posting request value to api
   $enrolment = $client->request('PUT', 'course/enrolment',[
       'form_params' => $data_array,
       'headers' => ['apitoken' => $AXL_api_token,
       'wstoken' => $AXL_ws_token,]
        ]);

    // encode the results 
        $get_enrolment_details = json_decode($enrolment->getBody());
        $msg = $get_enrolment_details['MSG']; 

}
// error response
catch (\Exception $ex) {
   $response = $ex->getResponse();   
$responseBodyAsString = json_decode($response->getBody()->getContents(), true);
$msg = $responseBodyAsString['MESSAGES'];


}


        switch($get_course_details[$i]->TYPE){
                case "p":
                    $delivery_type = "Face-to-face only";
                break;
                
                case "w":
                    $delivery_type = "Face-to-face only";
                break;
                
                case "el":
                    $delivery_type = 'Online only';
                break;
                
                case "All":
                    $delivery_type = 'Online training + Face-to-face';
                break;
            }
            ?>
      
        <tr>
            <th>{{$get_course_details[$i]->NAME}}</th>
            <th>{{date("d-M-Y ", strtotime($get_course_details[$i]->STARTDATE))}}</th>
        <?php 
        $comdate = array();

        foreach($get_course_details[$i]->COMPLEXDATES as $list)
          {
            $comdate[] = $list->DATE.'=>'.$list->STARTTIME.'=>'.$list->ENDTIME;
        }

       $complexdate_array =  implode(" ",$comdate);
 
 ?>
            <th>

            <button type="submit" id="ag1e" title="{{$complexdate_array}}" style="width: 100px;height: 30px;cursor: pointer;">view</button>

        </th>
     
        
            <th>{{$get_course_details[$i]->LOCATION}}</th>
            <th>{{$delivery_type}}</th>
            <th>{{$get_course_details[$i]->PARTICIPANTS}}/{{$get_course_details[$i]->MAXPARTICIPANTS}}</th>
            <th>
            <a href="#ex1" rel="modal:open">Enrol</a>
        </th>
        </tr>


 <div id="ex1" class="modal">
  <p>{{$msg}}</p>
  <a href="#" rel="modal:close">Close</a>
</div>
        @endfor
       
    </tbody>
</table> 




 @endsection
    
               
                
                
                
                
            