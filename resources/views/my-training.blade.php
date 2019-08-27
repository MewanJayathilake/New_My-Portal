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
                <div class="tab-box active">
                  <a href="{{url('my-training')}}">
                    <i class="fas fa-tv"></i>
                    My Training
                    <i class="fas fa-info-circle info-icon"></i>
                  </a>
                </div>
              </div>
              <div class="column">
                <div class="tab-box">
                  <a href="{{url('my-results')}}">
                    <i class="fas fa-medal"></i>
                    My Results
                    <i class="fas fa-info-circle info-icon"></i>
                  </a>
                </div>
              </div>
            </div>
            <!-- End Main Tab Section -->
  

          
            <!-- Dashbord Data Section -->
            <div class="data-section">

              <div class="my-training-section">

              @foreach ($enrolments as $enrolment)

              <?php  
     // get the session for enrolmet details(date,start time,end time) using foreach

$session_times = "";
    foreach ($enrolment->COMPLEXDATES as $session) {
    $session_day = date("d/m/Y", strtotime($session->DATE));
    $session_start = date("h:i A", strtotime($session->STARTTIME));
    $session_end = date("h:i A ", strtotime($session->ENDTIME));
    $session_times .= "$session_day at $session_start to $session_end <br/>";
    }
// using a if condition check status is Booked or Moved or paid
              if ($enrolment->STATUS == "Booked" || $enrolment->STATUS == "Moved" || $enrolment->STATUS == "Paid") {
                // get the instance_ details from axerlator pass parameeters(instanceID,type)
     $get_instance_details = $client->request('GET', 'course/instance/detail',
         ['form_params' => ['instanceID' => $enrolment->INSTANCEID, 
         'type'=>'w'],
      
       'headers' => ['apitoken' => $AXL_api_token,
       'wstoken' => $AXL_ws_token,]
        ]);
   $instance_details = json_decode($get_instance_details->getBody());
// get the VENUECONTACTID
   $venue_contactid = $instance_details->VENUECONTACTID;
// if VENUECONTACTID is not null
      if ($venue_contactid != "") {

                          // get_venue_details from axerlator pass the parameeter(CONTACTID)
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
 // get_course_types  form axerlator    
$get_course_types = $client->request('GET', 'courses/',
         ['headers' => ['apitoken' => $AXL_api_token,
       'wstoken' => $AXL_ws_token,]
        ]);

$course_types = json_decode($get_course_types->getBody());
$short_description = "";
// for each for course_type
foreach ($course_types as $coursetype) {
  // when courseID equel enrolmentId
if ($coursetype->ID == $enrolment->ID) {
$short_description = $coursetype->SHORTDESCRIPTION . '<br/><br/>';
}
}

 //LINKEDELEARNING is not null when eLearningCompleted
                        if ($instance_details->LINKEDELEARNING != null) {
                            $instanceResources = array();
                            $eLearningCompleted = true;
                       
								//foreach 
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
							
							
							$rdate = explode("/", $session_day);
							$cdate = $rdate[2].'-'.$rdate[1].'-'.$rdate[0];
                           $datecr = date_create($enrolment->STARTDATE);

                        ?> 
        

   <div class="training-item toggle-main">
                  <div class="columns">
                    <div class="column no-padding is-1">
                      <div class="color-secondary-blue txt-center date-box">
                        <h4 class="title is-4 txt-white">{{date_format($datecr,'d')}}</h4>
                        <p class="txt-white">{{date_format($datecr,'M')}}</p>
                      </div>
                    </div>
                    <div class="column is-11">
                      <h6 class="title is-6">{{$enrolment->NAME}} <span class="txt-secondary-blue">{{$enrolment->INSTANCEID}}</span></h6>
                      <p class="status-txt">Status : {{$enrolment->STATUS}}</p>
                    </div>
                    <span class="toggle-icon"><a><i class="fas fa-angle-down"></i></a></span>
                  </div>

                  <div class="tab" id="tabs{{$enrolment->INSTANCEID }}">
                    <div class="tabs is-medium">
                      <ul>
                        <li><a href="#tabs-1{{$enrolment->INSTANCEID }}">Step 1 : Completed</a></li>
                        <li><a href="#tabs-2{{$enrolment->INSTANCEID }}">Step 2 : Face to Face Training</a></li>
                      </ul>
                    </div> 
                    <div id="tabs-1{{$enrolment->INSTANCEID }}">
                      <p class="tab-info-txt">Important information regarding your training</p>
						
						<?php 
                         
                       foreach($instanceResources as $instanceResource) { ?>
						<div class="columns action-row">
                        
							<div class="column is-7">
								<p><?php echo  $instanceResource['name']; ?></p>
							</div>
							<div class="column is-5 txt-right">
                            <?php if (!in_array($instanceResource['status'], array('Completed', 'Passed', 'Failed'))) {
                                  ?>
                                <a target="{{($instanceResource['newWindow'] ? '_blank' : '_self')}}" class="button selected-btn" href="{{$instanceResource['url']}}">Launch</a> 
                 <?php $statusLabel = $instanceResource['status'] == 'In Progress' ? 'In Progress' : 'Not Completed'; ?> 
								<a class="button cancel-btn">Not Completed</a>
                                <?php }else{ ?>
								<a class="button normal-btn">Completed</a>
                                <?php } ?>
							</div>
                            
						</div>
						<?php } ?>

                       
                             
                               
                                
                                  

                                   
              

                               
                    </div>
                    <div id="tabs-2{{$enrolment->INSTANCEID }}">
                      <p>{{$short_description}}
                      <strong>Sessions:</strong> {!!$session_times!!}<br/>
					   <strong>Location:</strong> {!!$location !!}
                      </p>
                    </div>
                  </div>
                </div>
  <script type="text/javascript">
                    $( function() {
    $( "#tabs{{$enrolment->INSTANCEID }}" ).tabs();
  } );
                </script>
                  
            <?php }else{?>
              <script type="text/javascript">
                    $( function() {
    $( "#tabs{{$enrolment->INSTANCEID }}" ).tabs();
  } );
                </script>

            	<?php $rdate = explode("/", $session_day);
$cdate = $rdate[2].'-'.$rdate[1].'-'.$rdate[0];

$datecr = date_create($enrolment->STARTDATE);?>
<!-- toggle for get my training -->
<div class="training-item toggle-main">
                  <div class="columns">
                    <div class="column no-padding is-1">
                      <div class="color-secondary-blue txt-center date-box">
                        <h4 class="title is-4 txt-white">{{date_format($datecr,'d')}}</h4>
                        <p class="txt-white">{{date_format($datecr,'M')}}</p>
                      </div>
                    </div>
                    <div class="column is-11">
                      <h6 class="title is-6">{{$enrolment->NAME}} <span class="txt-secondary-blue">{{$enrolment->INSTANCEID}}</span></h6>
                      <p class="status-txt">Status : {{$enrolment->STATUS}}</p>
                    </div>
                    <span class="toggle-icon"><a><i class="fas fa-angle-down"></i></a></span>
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
             <strong>Location:</strong> {!!$location !!}
                      </p>
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