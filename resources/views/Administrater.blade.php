@extends('layouts.app')

@section('content')
<!-- Dashbord Data Section -->
    <div class="column right" id="dashbord">
          <div class="inner">

            <!-- Main Tab Section -->
            <div class="columns main-tabs">
              <div class="column">
                <div class="tab-box">
                  <a href="#course-skills-maintenance-modal" rel="modal:open">
                  	<!-- <a class="navbar-item " href="#onsite" rel="modal:open" > -->
                    <i class="fas fa-search"></i>
                    Create New Course Or Skills Maintenance
                    <i class="fas fa-info-circle info-icon"></i>
                  </a>
                </div>
              </div>
              <div class="column">
                <div class="tab-box">
                  <a href="#">
                    <i class="fas fa-sort-amount-up"></i>
                    Reports
                    <i class="fas fa-info-circle info-icon"></i>
                  </a>
                </div>
              </div>
              
            <!-- End Main Tab Section -->
<!-- Create New Course Or Skills Maintenance modal start -->
<div id="course-skills-maintenance-modal" class="modal">
	<!-- manualy I add--><br><br><br><br> <!--end add-->
<div class="field">
    <label class="label">COURSE</label>
        <div class="control">
      <div class="select">
        <select id="course" name="course"> 
          <option value="">Select</option>
          @foreach($get_course_details as $course_type)                     
       <option value="{{$course_type->c_id}}">{{$course_type->c_name}}</option>
          @endforeach
        </select>
      </div>
    </div> 
  </div>

<div class="field">
  <label class="label">Location</label>
                              
    
    <div class="control">
      <div class="select">
        <select id="course_location"> 
          	<option value="">Select</option>
             <!-- for loop for get_course_location -->
            @for($z=0; $z < count($get_course_location); $z++)
                              <option value="{{$get_course_location[$z]}}">{{$get_course_location[$z]}}</option>
                           @endfor                   
       		
        </select>
      </div>
    </div> 
  </div>
<div class="field">
    <label class="label">Delivery Mode</label>
    <div class="control">
      <div class="select">
        <select id="course_delivery" name="course_delivery"> 
        </select>
      </div>
    </div> 
  </div>
  
<div class="field">
    <label class="label">Session Breakdown</label>
    <div class="control">
      <div class="select">
        <select id="session_breakdown"> 
          	<option value="">Select</option>                    
       		<option value="">op1</option>
       		<option value="">op2</option>
       		<option value="">op3</option>
       		<option value="">op4</option>
        </select>
      </div>
    </div> 
  </div>
<!-- session tag -->
  
<div class="field">
<div class="training-item toggle-main">
                  <div class="columns is-vcentered">
                    <div class="column is-5">
                      <div class=" txt-left ">
                        <p class="txt-black">Session 1, 4hrs</p> 
                      </div>
                    </div>
                    <span class="toggle-icon"><a ><i class="fas fa-angle-down"></i></a></span>
                  </div>

    				<div class="tab" id="tabs">
                   <label>Start Date</label> 
                    <input class="input" type="text" id="start_date" placeholder="Date">
                    <label>Start Time</label> 
                    <input type="text"class="input timepicker"  name="time" placeholder="Time" id="timepicker1" >
                    <input class="checkbox" type="checkbox" id="session_1_start_time_30_min_break" name="session_2_start_time_30_min_break" value="30_min">30 min Break <br>
                    <input class="checkbox" type="checkbox"id="session_1_start_time_60_min_break" name="session_2_start_time_60_min_break" value="60_min">60 min Break 
                  	</div>

</div>
</div>
<div class="field">
<div class="training-item toggle-main">
                  <div class="columns is-vcentered">
                    <div class="column is-5">
                      <div class=" txt-left ">
                        <p class="txt-black">Session 2, 4hrs</p> 
                      </div>
                    </div>
                    <span class="toggle-icon"><a ><i class="fas fa-angle-down"></i></a></span>
                  </div>

    				<div class="tab" id="tabs">
                   <label>Start Date</label> 
                    <input class="input" type="text" id="start_date_2" placeholder="Date">
                    <label>Start Time</label> 
                    <input type="text" class="input  column is-3" name="time"  placeholder="Time" id="timepicker2">
                    <input class="checkbox" type="checkbox" id="session_2_start_time_30_min_break" name="session_2_start_time_30_min_break" value="30_min">30 min Break <br>
                    <input class="checkbox" type="checkbox"id="session_2_start_time_60_min_break" name="session_2_start_time_60_min_break" value="60_min">60 min Break  
                  	</div>

</div>

</div>

<div class="field">
  <label class="label">Min candidates</label>
  <div class="control">
    <input class="input" type="text"  id="min-candidates"> 
  </div>
</div>
<div class="field">
  <label class="label">Max candidates</label>
  <div class="control">
    <input class="input" type="text"  id="man_candidates">
  </div>
</div>
<div class="field ">
  <label class="label">Reserved for your club</label>
  <div class="control">
    <input class="input" type="text"  id="reserved_club">
  </div>
</div>
<div class="field">
  <label class="label ">Primary Contact </label>
  
    <input class="input field " type="text" value="<?php echo $user->GIVENNAME.'&nbsp;'.$user->SURNAME ?>" id="primary_contact_name" placeholder="Name"  readonly="readonly">
     <input class="input field " type="email" value="<?php echo $user->EMAILADDRESS?>" id="primary_contact_email" placeholder="Email" readonly="readonly">
</div>
<div class="field">
	<label class="label ">Trainer </label>
<div class="control has-icons-left has-icons-right">
  <input class="input" type="text" id="trainer_search">
  <span class="icon is-small is-left">
    <i class="fas fa-search"></i>
  </span>
  
</div>
</div>
<div class="field">
	<label class="label ">Assesor </label>
<div class="control has-icons-left has-icons-right">
  <input class="input" type="text" id="assesor_search">
  <span class="icon is-small is-left">
    <i class="fas fa-search"></i>
  </span>
  
</div>
</div>
<div class="field">
	<label class="label ">Facilitator </label>
<div class="control has-icons-left has-icons-right">
  <input class="input" type="text" id="facilitator_search">
  <span class="icon is-small is-left">
    <i class="fas fa-search"></i>
  </span>
  
</div> 
</div>
<div class="field ">
  <label class="label">Trainee<br>Trainer</label>
  <div class="control">
    <input class="input" type="text"  id="trainee_trainer">
  </div>
</div>
<div class="field ">
  <label class="label">Trainee<br>Assesor</label>
  <div class="control">
    <input class="input" type="text"  id="tarinee_assesor">
  </div>
</div>
<div class="field ">
  <label class="label">Trainee<br>Facilitator</label>
  <div class="control">
    <input class="input" type="text"  id="trainee_facilitator">
  </div>
</div>
<div class="field ">
  <label class="label">Social/<br>Web Link</label>
  <div class="control">
    <input class="input" type="text"  id="sicial_web_link" placeholder="URL">
  </div>
</div> 
<div class="field ">
  <label class="label">Extra Candidate Information</label>
  <div class="control">
    <textarea class="textarea" id="extra_candidate_information"></textarea>
  </div>
</div>

  <div class="field">
    <div class="field ">
      <div class="control">
        <button class="button is-primary" id="create_course">
          Save
        </button>
      </div>
    </div>
  </div>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function(e) {
        $('select[name="course"]').on('change', function() {
            var courseID = $(this).val();
            if(courseID) {
                $.ajax({
                  url: "{!! url('get_delivery_mode/ajax/' ) !!}" + "/" + courseID,
                    
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                      var result = JSON.stringify(data, undefined, 2);
                     
                        
                        $('select[name="course_delivery"]').empty();
                        $.each(data, function(i, item) {
                          
                            $('select[name="course_delivery"]').append('<option value="'+ data[i].c_id +'">'+ data[i].c_delivery  +'</option>');
                        });


                    }
                });
            }else{
                $('select[name="course_delivery"]').empty();
            }
        });
    


// onsite training

 $("#create_course").click(function(){

 var course=$('#course').val();
 var course_location=$('#course_location').val();
 var course_delivery=$('#course_delivery').val();
 var session_breakdown=$('#session_breakdown').val();             

var start_date=$('#start_date').val();
var timepicker1=$('#timepicker1').val();
var session_1_start_time_30_min_break=$('#session_1_start_time_30_min_break').val();
var session_1_start_time_60_min_break=$('#session_1_start_time_60_min_break').val();
var start_date_2=$('#start_date_2').val();
var timepicker2=$('#timepicker2').val();
var session_2_start_time_30_min_break=$('#session_2_start_time_30_min_break').val();
var session_2_start_time_60_min_break=$('#session_2_start_time_60_min_break').val();
var min_candidates=$('#min_candidates').val();
var max_candidates=$('#max_candidates').val();
var reserved_club=$('#reserved_club').val();     
var primary_contact_name=$('#primary_contact_name').val();
var primary_contact_email=$('#primary_contact_email').val();
var trainer_search=$('#trainer_search').val();
var assesor_search=$('#assesor_search').val();
var facilitator_search=$('#facilitator_search').val();
var trainee_trainer=$('#trainee_trainer').val();
var tarinee_assesor=$('#tarinee_assesor').val();
var sicial_web_link=$('#sicial_web_link').val();
var extra_candidate_information=$('#extra_candidate_information').val();
           
      // passing values
    
 
 // alert("success");
  $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

        $.ajax({

           type:'POST',
            url:"{{url('create-course-post')}}",
           

           data:{course:course,course_location:course_location,course_delivery:course_delivery,session_breakdown:session_breakdown,start_date:start_date,timepicker1:timepicker1,session_1_start_time_30_min_break:session_1_start_time_30_min_break,session_1_start_time_60_min_break:session_1_start_time_60_min_break,start_date_2:start_date_2,timepicker2:timepicker2,session_2_start_time_30_min_break:session_2_start_time_30_min_break,session_2_start_time_60_min_break:session_2_start_time_60_min_break,min_candidates:min_candidates,max_candidates:max_candidates,reserved_club:reserved_club,primary_contact_name:primary_contact_name,primary_contact_email:primary_contact_email,trainer_search:trainer_search,assesor_search:assesor_search,facilitator_search:facilitator_search,trainee_trainer:trainee_trainer,tarinee_assesor:tarinee_assesor,sicial_web_link:sicial_web_link,extra_candidate_information:extra_candidate_information},

           


        });


 });



    });

</script>
<!-- <script type="text/javascript">
  $('.timepicker').timepicker({     timeFormat: 'h:mm p',     interval: 60,     minTime: '10',     maxTime: '6:00pm',     defaultTime: '11',     startTime: '10:00',     dynamic: false,     dropdown: true,     scrollbar: true });
</script> -->

            @endsection
