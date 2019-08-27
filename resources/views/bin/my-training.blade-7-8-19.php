@extends('layouts.app')

@section('content')
  <!-- Dashbord Data Section -->
    <div class="column right" id="dashbord">
          <div class="inner">

            <!-- Main Tab Section -->
            <div class="columns main-tabs">
              <div class="column">
                <div class="tab-box">
                  <a href="#">
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
                <div class="tab-box active">
                  <a href="#">
                    <i class="fas fa-tv"></i>
                    My Training
                    <i class="fas fa-info-circle info-icon"></i>
                  </a>
                </div>
              </div>
              <div class="column">
                <div class="tab-box">
                  <a href="#">
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
           
           <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
  <thead>
    <tr>
      <th>Course</th>
      <th>Date</th>
      <th>Location</th>
      <th>Result</th>
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

 $get_linked_enrolments = $client->request('GET', 'contact/enrolments/2594099/',
         ['form_params' => ['instanceID' => $enrolment->INSTANCEID, 
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
      <td>{{$enrolment->NAME.''.$enrolment->INSTANCEID}}</td>
      <td>{!!$session_times!!}</td>
      <td>{{$enrolment->LOCATION}}</td>
      <td>{{$enrolment->STATUS}}</td>
      
     
      <td>
        <a class="button inactive-btn">
        <span>link</span>
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

           <!--end tbl -->
            <!-- Dashbord Data Section -->
            <div class="data-section">

              <div class="my-training-section">

              @foreach ($enrolments as $enrolment)
              <?php  if ($enrolment->STATUS == "Booked" || $enrolment->STATUS == "Moved" || $enrolment->STATUS == "Paid") {
     $get_instance_details = $client->request('GET', 'course/instance/detail',
         ['form_params' => ['instanceID' => $enrolment->INSTANCEID, 
         'type'=>'w'],
      
       'headers' => ['apitoken' => $AXL_api_token,
       'wstoken' => $AXL_ws_token,]
        ]);
   $instance_details = json_decode($get_instance_details->getBody());

   $venue_contactid = $instance_details->VENUECONTACTID;

      if ($venue_contactid != "") {

                          
                              $get_venue_details = $client->request('POST', 'venues/',
         ['form_params' => ['CONTACTID' => $venue_contactid],
      
       'headers' => ['apitoken' => $AXL_api_token,
       'wstoken' => $AXL_ws_token,]
        ]);

                              $venue_details = json_decode($get_venue_details->getBody());


                            if ($venue_details != array()) {
                                $venue_detail = $venue_details[0];
                                $location = $venue_detail->NAME . "<br/>" . $venue_detail->SADDRESS1 . "<br/>";
                                $add2 = $venue_detail->SADDRESS2;
                                if ($add2 != null || $add2 != "") {
                                    $location .= $add2;
                                }
                                $location .= $venue_detail->SCITY . ", " . $venue_detail->SSTATE . " " . $venue_detail->SPOSTCODE;
                            } else {
                                $location = $enrolment->LOCATION;
                            }
                        } else {
                            $location = $enrolment->LOCATION;
                        }
           
$get_course_types = $client->request('GET', 'courses/',
         ['headers' => ['apitoken' => $AXL_api_token,
       'wstoken' => $AXL_ws_token,]
        ]);

$course_types = json_decode($get_course_types->getBody());
$short_description = "";
foreach ($course_types as $coursetype) {
if ($coursetype->ID == $enrolment->ID) {
$short_description = $coursetype->SHORTDESCRIPTION . '<br/><br/>';
}
}

 
                        if ($instance_details->LINKEDELEARNING != null) {
                            $instanceResources = array();
                            $eLearningCompleted = true;
                       
								
                            foreach ($instance_details->LINKEDELEARNING as $linkedLearning) { 
                                foreach ($eLearning as $eLearningModule) {
                          
                                    if ($linkedLearning->INSTANCEID == $eLearningModule->INSTANCEID) {			
                                        $instanceResources[] = array(
                                            'name' => $eLearningModule->NAME,
                                            'url' => $eLearningModule->LAUNCHURL,
                                            'status' => $eLearningModule->STATUS,
                                            'newWindow' => $eLearningModule->ACTIVITYTYPE !== 'SCORMEngine'
                                        );
                                        if (!in_array($eLearningModule->STATUS, array('Completed', 'Passed', 'Failed'))) $eLearningCompleted = false;
                                    }
                                }
                            }
							//print_r($instanceResources);
							
							$rdate = explode("/", $session_day);
							$cdate = $rdate[2].'-'.$rdate[1].'-'.$rdate[0];
                           $datecr = date_create($enrolment->STARTDATE);

                        ?> 
        

   <div class="training-item toggle-main">
                  <div class="columns is-vcentered">
                    <div class="column is-1">
                      <div class="color-secondary-blue txt-center date-box">
                        <h4 class="title is-3 txt-white">{{date_format($datecr,'d')}}</h4>
                        <p class="txt-white">{{date_format($datecr,'M')}}</p>
                      </div>
                    </div>
                    <div class="column is-11">
                      <h3 class="title is-4">{{$enrolment->NAME}} <span class="txt-secondary-blue">{{$enrolment->INSTANCEID}}</span></h3>
                      <p>Status:{{$enrolment->STATUS}}</p>
                    </div>
                    <span class="toggle-icon"><a href="#"><i class="fas fa-angle-down"></i></a></span>
                  </div>

                  <div class="tab" id="tabs{{$enrolment->INSTANCEID }}">
                    <div class="tabs is-medium">
                      <ul>
                        <li><a href="#tabs-1{{$enrolment->INSTANCEID }}">Step 1 : Completed</a></li>
                        <li><a href="#tabs-2{{$enrolment->INSTANCEID }}">Step 2 : Face to Face Training</a></li>
                      </ul>
                    </div> 
                    <div id="tabs-1{{$enrolment->INSTANCEID }}">
                      <p>Important information regarding your training</p>
                    </div>
                    <div id="tabs-2{{$enrolment->INSTANCEID }}">
                      <p>{{$short_description}}
                      <strong>Sessions:</strong> {!!$session_times!!}<br/>
					   <strong>Location:</strong> {{$location }}
                      </p>
                    </div>
                  </div>
                </div>

            <?php }else{
            	$rdate = explode("/", $session_day);
$cdate = $rdate[2].'-'.$rdate[1].'-'.$rdate[0];
//$datecr = date_create($cdate);
$datecr = date_create($enrolment->STARTDATE);?>
<div class="training-item toggle-main">
                  <div class="columns is-vcentered">
                    <div class="column is-1">
                      <div class="color-secondary-blue txt-center date-box">
                        <h4 class="title is-3 txt-white">30</h4>
                        <p class="txt-white">Mar</p>
                      </div>
                    </div>
                    <div class="column is-11">
                      <h3 class="title is-4">Bronze Medallion <span class="txt-secondary-blue">475663</span></h3>
                    </div>
                    <span class="toggle-icon"><a href="#"><i class="fas fa-angle-down"></i></a></span>
                  </div>

                  <div class="tab" id="tabs">
                    <div class="tabs is-medium">
                      <ul>
                        <li><a href="#tabs-1">Step 1 : Completed</a></li>
                        <li><a href="#tabs-2">Step 2 : Face to Face Training</a></li>
                      </ul>
                    </div> 
                    <div id="tabs-1">
                      <p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
                    </div>
                    <div id="tabs-2">
                      <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
                    </div>
                  </div>
                </div>
            <?php }  }?>
                   @endforeach
                
                <!-- End Item Rows -->

              </div>

            </div>
            <!-- End Dashbord Data Section -->

          </div>
        </div>
            <!-- End Dashbord Data Section -->
@endsection