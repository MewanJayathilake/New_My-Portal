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
      <!-- foreach for get the enrolment -->
      <?php foreach ($enrolments as $filter_enrolment) {
       $filter_enrolments[$filter_enrolment->ENROLID] = $filter_enrolment;

     } 

     $enrolments = $filter_enrolments;
     $user_enrolments = '';
     
     ?>

     <!-- togele  for Surguard Transcript-->
     <div class="training-item toggle-main">
      <div class="columns">
        
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
          <!-- foreach for get the  enroiment -->
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
      // if  enrolmet status compleated
          if ($enrolment->STATUS == "Completed") {
            
  //get instant details from axerlator ,pass the parameters(InstanceID,course_type)
            $get_instance_details = $client->request('GET', 'course/instance/detail',
             ['form_params' => ['instanceID' => $enrolment->INSTANCEID, 
             'type'=>'w'],
             
             'headers' => ['apitoken' => $AXL_api_token,
             'wstoken' => $AXL_ws_token,]
           ]);
            $instance_details = json_decode($get_instance_details->getBody());
         //if LINKEDCLASSID is null
            if ($instance_details->LINKEDCLASSID == null) {
              $data_type = "statusID";
              $data_id = $enrolment->ENROLID;
              
            }
  //else data_type equel enrolID
            else{
              
              $data_type = "enrolID";
  //get the linked_enrolment from axelator, pass parameeters(course_type,displaylength)
              $get_linked_enrolments = $client->request('GET', 'contact/enrolments/'.$contactid.'/',
               ['form_params' => [
                 'type'=>'p','displayLength'=>100],
                 
                 'headers' => ['apitoken' => $AXL_api_token,
                 'wstoken' => $AXL_ws_token,]
               ]);
              $linked_enrolments = json_decode($get_linked_enrolments->getBody());
      // foreach for get enrolID
              foreach ($linked_enrolments as $linked_enrolment) {

                if ($linked_enrolment->INSTANCEID == $instance_details->LINKEDCLASSID) {
                 
                  $data_id = $linked_enrolment->ENROLID;
                }
              }
            } 

            ?>
            <tr>
              <td></td>
              <!-- get InstantID -->
              <td>{{$enrolment->NAME.''.$enrolment->INSTANCEID}}</td>
              <!-- get COMPLETIONDATE -->
              <td>{{date("d-M-Y", strtotime($enrolment->COMPLETIONDATE))}}</td>
              
              <td></td>
              
              
              <td>
                <!-- for download to thr certificate -->
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
      
    </div> 
  </div>
  


  <!--end tbl -->
  <!-- togele  for Surguard Transcript-->
  <div class="training-item toggle-main">
    <div class="columns">
      <div class="column is-11">
        <h6 class="title is-6">Surguard Transcript<span class="txt-secondary-blue"></span></h6>
        <p class="status-txt"></p>
      </div>
      <span class="toggle-icon"><a><i class="fas fa-angle-down"></i></a></span>
    </div>

    <div class="tab" id="">
      
      
      <!-- surguard_transcript table print -->
      <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
          <tr>
            <th>Award Number</th>
            <th>Date Award</th>
            <th>Date Proficiency</th>
          </tr>
        </thead>
        <tbody>
          <!-- for loop for get surguard transcript -->
          @for($i=0; $i< count($get_surguard_transcript); $i++)



          <tr>
            <!-- get values -->
            <td>{{$get_surguard_transcript[$i]->award_number}}</td>
            <td>{{date("d-M-Y ", strtotime($get_surguard_transcript[$i]->date_award))}}</td>
            <td>{{date("d-M-Y ", strtotime($get_surguard_transcript[$i]->date_proficiency))}}</td>
          </tr>



          @endfor

        </tbody>
        <tfoot>
          <tr>
            <th>Award Number</th>
            <th>Date Award</th>
            <th>Date Proficiency</th>
          </tr>
        </tfoot>
        <tbody>
        </table>
        <!--  end surguard_transcript table print -->

      </div>
    </div>
    

  </div>
</div>
<!-- End Dashbord Data Section -->
@endsection