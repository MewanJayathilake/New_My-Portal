@extends('layouts.app')

@section('content')
  <!-- Dashbord Data Section -->
    <div class="column right" id="dashbord">
          <div class="inner">

            <!-- Main Tab Section -->
            <div class="columns main-tabs">
              <div class="column">
                <div class="tab-box">
                  <a href="{{url('course')}}">
                    <i class="fas fa-search"></i>
                    Find New Course
                    <i class="fas fa-info-circle info-icon"></i>
                  </a>
                </div>
              </div>
              <div class="column">
                <div class="tab-box">
                  <a href="#">
                    <i class="fas fa-sort-amount-up"></i>
                    Skills Maintenance
                    <i class="fas fa-info-circle info-icon"></i>
                  </a>
                </div>
              </div>
              <div class="column">
                <div class="tab-box">
                  <a href="{{url('my-training')}}">
                    <i class="fas fa-tv"></i>
                    My Training
                    <i class="fas fa-info-circle info-icon"></i>
                  </a>
                </div>
              </div>
              <div class="column">
                <div class="tab-box active">
                  <a href="{{url('my-results')}}">
                    <i class="fas fa-medal"></i>
                    My Results
                    <i class="fas fa-info-circle info-icon"></i>
                  </a>
                </div>
              </div>
            </div>
            <!-- End Main Tab Section -->
           <!-- tbl--->
           @if(count($enrolments) > 0)

           <?php foreach ($enrolments as $filter_enrolment) {
               $filter_enrolments[$filter_enrolment->ENROLID] = $filter_enrolment;

             } 

            $enrolments = $filter_enrolments;
            $user_enrolments = '';
            
            ?>

             <div class="training-item toggle-main">
                  <div class="columns">
                   <!--  <div class="column no-padding is-1">
                      
                    </div> -->
                    <div class="column is-11">
                      <h6 class="title is-6">Current </h6>
                 
                    </div>
                    <span class="toggle-icon"><a><i class="fas fa-angle-down"></i></a></span>
                  </div>

                  <div class="tab" id="tabs">

                               <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
  <thead>
    <tr>
      <th>Type</th>
      <th>Course</th>
      <th>Completion Date</th>
      <th>Update Due</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($enrolments as $enrolment) 
     <?php
    $session_times = "";
    foreach ($enrolment->COMPLEXDATES as $session) {
    $session_day = date("d/m/Y", strtotime($session->DATE));
    $session_start = date("h:i A", strtotime($session->STARTTIME));
    $session_end = date("h:i A ", strtotime($session->ENDTIME));
    $session_times .= "$session_day at $session_start to $session_end <br/>";
    }
    if ($enrolment->STATUS == "Completed") {
    

      $get_instance_details = $client->request('GET', 'course/instance/detail',
         ['form_params' => ['instanceID' => $enrolment->INSTANCEID, 
         'type'=>'w'],
      
       'headers' => ['apitoken' => $AXL_api_token,
       'wstoken' => $AXL_ws_token,]
        ]);
       $instance_details = json_decode($get_instance_details->getBody());
    if ($instance_details->LINKEDCLASSID == null) {
                        $data_type = "statusID";
                        $data_id = $enrolment->ENROLID;
                      
                    }else{
                      
$data_type = "enrolID";

 $get_linked_enrolments = $client->request('GET', 'contact/enrolments/'.$contactid.'/',
         ['form_params' => [
         'type'=>'p','displayLength'=>100],
      
       'headers' => ['apitoken' => $AXL_api_token,
       'wstoken' => $AXL_ws_token,]
        ]);
   $linked_enrolments = json_decode($get_linked_enrolments->getBody());
    
       foreach ($linked_enrolments as $linked_enrolment) {

                            if ($linked_enrolment->INSTANCEID == $instance_details->LINKEDCLASSID) {
                                //$data_id = $enrolment->ENROLID;
                                $data_id = $linked_enrolment->ENROLID;
                            }
                        }
                    } 

                    ?>
    <tr>
      <td></td>
      <td>{{$enrolment->NAME.''.$enrolment->INSTANCEID}}</td>
      <td>{{date("d-M-Y", strtotime($enrolment->COMPLETIONDATE))}}</td>
      
      <td></td>
      
     
      <td>
        <a href="{{ url('generate-certificate', $data_id) }}" class="button inactive-btn" target="_blank">
        <span>Download certificate</span>
        <span class="icon is-small">
          <i class="fas fa-caret-right"></i>
        </span>
        </a>
      </td>
    </tr>
<?php } ?>
  @endforeach
  </tbody>
</table>



 @endif
                   <!--  <div class="tabs is-medium">
                      <ul>
                        <li><a href="#tabs-1">Step 1 : Completed</a></li>
                        <li><a href="#tabs-2">Step 2 : Face to Face Training</a></li>
                      </ul>
                    </div> 
                    <div id="tabs-1">
                      <p class="tab-info-txt">Important information regarding your training</p>
            
           
            <div class="columns action-row">
                        
              <div class="column is-7">
                <p>dfdf</p>
              </div>
             
                            
            </div>
        

               
                               
                    </div>
                    <div id="tabs-2">
                      <p>4444444444444
                      <strong>Sessions:</strong> 4545<br/>
             <strong>Location:</strong> 6666666666666
                      </p>
                    </div> -->
                  </div> 
                </div>
          


           <!--end tbl -->
     

          </div>
        </div>
            <!-- End Dashbord Data Section -->
@endsection