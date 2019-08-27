<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashbord | Life Saving Victoria - Public Portal</title>
  <link type="image/png" href="{{ asset('site/images/favicon.png')}}" rel="icon" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" type="text/css" href="{{ asset('site/css/main.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('site/css/ui-styles.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('site/css/bulma.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('site/css/jquery.modal.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('site/css/bulma-steps.min.css')}}">
  <link rel="stylesheet" href="{{ asset('site/css/jquery-ui.css')}}">
  <!-- <link rel="stylesheet" href="css/jquery.dataTables.min.css"> -->

  <script src="{{ asset('site/js/jquery-3.4.1.js')}}"></script>
  <script src="{{ asset('site/js/jquery-ui.js')}}"></script>
  <script defer src="{{ asset('site/js/all.js')}}"></script>
  <script src="{{ asset('site/js/custom.js')}}"></script>
  <script src="{{ asset('site/js/jquery.modal.min.js')}}"></script>
  <script src="{{ asset('site/js/jquery.dataTables.min.js')}}"></script>

  <script>
$(window).on("load", function () {
   // $("#ChkSubmit").trigger('click'); 
    // set the varibles
    var courseid = $("#courseid").val(); 
    var startdate = $("#datepicker").val(); 
    var coursetype = $("#coursetype").val(); 
      // passing values
        var dataString = {
courseid: courseid,startdate:startdate,coursetype:coursetype,
};

   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

$.ajax
({
 type: "POST",
 url: "{{url('course-serach')}}",
data: dataString,
success: function(data){
  
// do something 
$("#tbl").html(data);

}
});
});
 
$(document).ready(function () {


// fnid new course search function
$("#ChkSubmit").click(function(){

 // set the varibles
    var courseid = $("#courseid").val(); 
    var startdate = $("#datepicker").val(); 
    var coursetype = $("#coursetype").val(); 
      // passing values
        var dataString = {
courseid: courseid,startdate:startdate,coursetype:coursetype,
};

   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

$.ajax
({
 type: "POST",
 url: "{{url('course-serach')}}",
data: dataString,
success: function(data){
  
// do something 
$("#tbl").html(data);

}
});
                    
        });


// verfify certificate function

$("#verify-certificate").click(function(){
$(".txt-support-red").remove();
 // set the varibles
    var firstname = $("#firstname").val(); 
    var surename = $("#surename").val(); 
    var id1 = $("#id1").val(); 
    var id3 = $("#id3").val(); 

     if(firstname == "") {
                $("#firstname").closest('.input').addClass('is-danger');
                $("#firstname").after('<p class="txt-support-red">The   field is required</p>');
            } else {
                $("#firstname").closest('.input').removeClass('is-danger');
                 $("#firstname").closest('.is-success').addClass('has-success');
            
            }

             if(surename == "") {
                $("#surename").closest('.input').addClass('is-danger');
                $("#surename").after('<p class="txt-support-red">The   field is required</p>');
            } else {
                $("#surename").closest('.input').removeClass('is-danger');
                 $("#surename").closest('.is-success').addClass('has-success');
                
            }

             if(id1 == "") {
                $("#id1").closest('.input').addClass('is-danger');
                $("#id1").after('<p class="txt-support-red">The   field is required</p>');
            } else {
                $("#id1").closest('.input').removeClass('is-danger');
                 $("#id1").closest('.is-success').addClass('has-success');
              
            }

             if(id3 == "") {
                $("#id3").closest('.input').addClass('is-danger');
                $("#id3").after('<p class="txt-support-red">The   field is required</p>');
            } else {
                $("#id3").closest('.input').removeClass('is-danger');
                $("#id3").closest('.is-success').addClass('has-success');
                
            }

    if(firstname,surename,id1,id3){
      // passing values
        var dataString = {
    
firstname: firstname,surename:surename,id1:id1,id3:id3
};

   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

$.ajax
({
 type: "POST",
 url: "{{url('verify-certificate')}}",
data: dataString,
success: function(data){
  
// do something 
var obj = JSON.parse(data);
console.log(obj);
if(obj.status == 'success'){
  $("#verify-certificate-details-sucess").html(obj.results.MSG);
}else if(obj.status == 'error'){
   $("#verify-certificate-details-error").html(obj.message);
}


}
});
      
      }              
        });



// onsite training

 $("#chkonsite").click(function(){

      

  var OrganisationName = $('#OrganisationName').val();
    var ContactName = $('#ContactName').val();
var ContactNumber=$('#ContactNumber').val();
var ContactEmail=$('#ContactEmail').val();
//var Courses=$('#Courses').val();
var Courses = $('#Courses option:selected')
                .toArray().map(item => item.value);
alert(Courses);
var CourseVenue=$('#CourseVenue').val();
var Date=$('#Date').val();
var AdditionalComments=$('#AdditionalComments').val();


      // passing values
        var dataString = {
    
OrganisationName:OrganisationName,ContactName:ContactName,contact_number:contact_number,ContactEmail:ContactEmail,course:Courses,CourseVenue:CourseVenue,Date:Date,AdditionalComments:AdditionalComments
};

 

  $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

        $.ajax({

           type:'POST',

           url:"{{url('onsite-training')}}",

           data:dataString,

           success:function(data){

              alert(data.success);

           }

        });


 });

 //  view courses or skill maintenance

 // fnid new course search function
$("#ChkSubmit-skill-course").click(function(){

 // set the varibles
    var courseid = $("#courseid").val(); 
    var startdate = $("#datepicker").val(); 
    var location = $("#location").val(); 
      // passing values
        var dataString = {
courseid: courseid,startdate:startdate,location:location,
};

   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

$.ajax
({
 type: "POST",
 url: "{{url('courses-skillmaintenance-serach')}}",
data: dataString,
success: function(data){
  
// do something 
$("#tbl").html(data);

}
});
                    
        });
  

});


</script>
    <script>
  $( function() {
    $( "#accordion" ).accordion({
      collapsible: true
    });
  } );

  // get user details

  function getUserDetails(contactID, page_name)
  {

      $.ajax({
        type: "GET",
        url: "{!! url('user/profile' ) !!}" + "/" + contactID,
        
        dataType: 'json',
        cache: false,
        success: function (data) {
            var result = JSON.stringify(data, undefined, 2);
            if (data.status == 'success') {
                var contactDetails = data.contactDetails;
                var userDetails = data.userDetails;
                if (page_name == "account") {
                    if (contactDetails && !contactDetails.ERROR) {
                        $("#name").text(contactDetails.GIVENNAME + " " + contactDetails.SURNAME + " (" + contactDetails.CONTACTID + ")");

                        if (contactDetails.DOB && contactDetails.DOB != "") {
                            var dob = contactDetails.DOB.split("-");
                            $("#dob").text("Date of birth: " + dob[2] + "/" + dob[1] + "/" + dob[0]);
                            //console.log(contactDetails);
                            $("#oldemail").val(contactDetails.EMAILADDRESS);
                        }
                    }
                } else if (page_name == "enrolment") {
                    if (userDetails && !userDetails.ERROR) {
                        //$("#username").val(userDetails.USERNAME);
                    }

                    if (contactDetails && !contactDetails.ERROR) {
                        $("#givenName").val(contactDetails.GIVENNAME);
                        $("#surname").val(contactDetails.SURNAME);
                        $("#emailAddress").val(contactDetails.EMAILADDRESS);
                        $("#title").val(contactDetails.TITLE);
                        $("#sex").val(contactDetails.SEX);
                        $("#buildingName").val(contactDetails.BUILDINGNAME);
                        $("#unitNo").val(contactDetails.UNITNO);
                        $("#streetNo").val(contactDetails.STREETNO);
                        $("#streetName").val(contactDetails.STREETNAME);
                        $("#city").val(contactDetails.CITY);
                        $("#state").val(contactDetails.STATE);
                        $("#postcode").val(contactDetails.POSTCODE);

                        $("#phone").val(contactDetails.PHONE);
                        $("#mobilephone").val(contactDetails.MOBILEPHONE);
                        $("#workphone").val(contactDetails.WORKPHONE);
                        $("#sunitNo").val(contactDetails.SUNITNO);

                        function diff_years(dt2, dt1) {
                            var diff = (dt2.getTime() - dt1.getTime()) / 1000;
                            diff /= (60 * 60 * 24);
                            return Math.abs(Math.round(diff / 365.25));
                        }

                        if (contactDetails.DOB && contactDetails.DOB != "") {
                            var dob = contactDetails.DOB.split("-");
                            var dateq = dob[2] + "/" + dob[1] + "/" + dob[0];
                            //calculate age
                            var date1 = new Date(dateq);
                            var date2 = new Date();
                            var age = diff_years(date1, date2);
                            $("#dob").val(dob[2] + "/" + dob[1] + "/" + dob[0]);
                            if (age <= 18) {
                                $("#emstat").val("Y");
                                $("#parent").show();
                                $("#fsn").addClass("req");
                                $("#fcn").addClass("req");
                                $("#relst").addClass("req");
                                $("#emcn").addClass("req");
                                var fname;
                                var lname;

                                if (contactDetails.EMERGENCYCONTACT != null && contactDetails.EMERGENCYCONTACT != "") {
                                    fname = (contactDetails.EMERGENCYCONTACT).split(' ').slice(0, -1).join(' ');
                                    lname = (contactDetails.EMERGENCYCONTACT).split(' ').slice(-1).join(' ');
                                }
                                $("#fcnfull").val(contactDetails.EMERGENCYCONTACT)
                                $("#fcn").val(fname);
                                $("#fsn").val(lname);
                                $("#emcn").val(contactDetails.EMERGENCYCONTACTPHONE);
                                $("#relst").val(contactDetails.EMERGENCYCONTACTRELATION);
                            }
                        }

                        //postal address
                        $('[name="POBox"]').val(contactDetails.POBOX);
                        $('[name="sbuildingName"]').val(contactDetails.SBUILDINGNAME);
                        $('[name="sstreetNo"]').val(contactDetails.SSTREETNO);
                        $('[name="sstreetName"]').val(contactDetails.SSTREETNAME);
                        $('[name="scity"]').val(contactDetails.SCITY);
                        $('[name="sstate"]').val(contactDetails.SSTATE);
                        $('[name="spostcode"]').val(contactDetails.SPOSTCODE);
                        $('[name="sPOBox"]').val(contactDetails.POBOX);

                        //background
                        if (contactDetails.COUNTRYOFBIRTHID != "1101") {
                            var COUNTRYOFBIRTHID = "No";
                            var COUNTRYOFBIRTHID2 = contactDetails.COUNTRYOFBIRTHID;
                        } else {
                            var COUNTRYOFBIRTHID = "1101";
                        }
                        $("#CountryofBirthID").val(COUNTRYOFBIRTHID);
                        if ($("#CountryofBirthID").val() == "1101") {
                            $("#CountryofBirthID2").val();
                            $("#CountryofBirthID2").select2('disable');
                        } else {
                            $("#CountryofBirthID2").select2("destroy");
                            $("#CountryofBirthID2").val(COUNTRYOFBIRTHID2);
                            $("#CountryofBirthID2").select2();
                            $("#CountryofBirthID2").select2('enable');
                        }

                        $("#CountryofBirthID").on('change', function (e) {
                            var optionSelected = $("option:selected", this);
                            if (this.value == "No") {
                                $("#CountryofBirthID2").select2('enable');
                            } else {
                                $("#CountryofBirthID2").val();
                                $("#CountryofBirthID2").select2("destroy");
                                $("#CountryofBirthID2").select2('disable');
                            }
                        });

                        $('[name="IndigenousStatusID"]').val(contactDetails.INDIGENOUSSTATUSID);

                        if (contactDetails.MAINLANGUAGEID != "1201") {
                            var MainLanguageID = "Yes";
                            var MainLanguageID2 = contactDetails.MAINLANGUAGEID;
                        } else {
                            var MainLanguageID = "1201";
                            var MainLanguageID2 = "";
                        }
                        $("#MainLanguageID").val(MainLanguageID);
                        if ($("#MainLanguageID").val() != "1201") {
                            $("#MainLanguageID2").val(MainLanguageID2);
                            $("#MainLanguageID2").select2();
                            $("#MainLanguageID2").select2('enable');
                        } else {
                            $("#MainLanguageID2").val();
                            $("#MainLanguageID2").select2("destroy");
                            $("#MainLanguageID2").select2();
                            $("#MainLanguageID2").select2('disable');

                        }
                        $("#MainLanguageID").on('change', function (e) {
                            var optionSelected = $("option:selected", this);
                            if (this.value == "Yes") {
                                $("#MainLanguageID2").select2();
                                $("#MainLanguageID2").select2('enable');
                            } else {
                                $("#MainLanguageID2").val();
                                $("#MainLanguageID2").select2("destroy");
                                $("#MainLanguageID2").select2();
                                $("#MainLanguageID2").select2('disable');
                            }
                        });
                       // console.log(contactDetails.MAINLANGUAGEID);

                        $('[name="EnglishProficiencyID"]').val(contactDetails.ENGLISHPROFICIENCYID);
                        $('[name="DisabilityTypeID"]').val(contactDetails.DISABILITYTYPEIDS);
                        var DISABILITYFLAG = contactDetails.DISABILITYFLAG == true ? "1" : "0";
                        $('[name="DisabilityFlag"]').val(DISABILITYFLAG);

                        $.each($("#DisabilityTypeID"), function () {
                            $(this).select2('val', contactDetails.DISABILITYTYPEIDS);
                        });
                        //Education
                        $('[name="USI"]').val(contactDetails.USI);
                        $('[name="HighestSchoolLevelID"]').val(contactDetails.HIGHESTSCHOOLLEVELID);
                        $('[name="HighestSchoolLevelYear"]').val(contactDetails.HIGHESTSCHOOLLEVELYEAR);
                        var AtSchoolFlag = contactDetails.ATSCHOOLFLAG == true ? "true" : "false";
                        $('[name="AtSchoolFlag"]').val(AtSchoolFlag);
                        $.each($("#PriorEducationID"), function () {
                            $(this).select2('val', contactDetails.PRIOREDUCATIONIDS);
                        });
                        $('[name="LabourForceID"]').val(contactDetails.LABOURFORCEID);
                    }
                }
            } else {
                $.unblockUI();
                alert(data.message);
            }
            return false;
        },
        error: function (data) {
            $.unblockUI();
            alert('Network error');
        }
    });
  }



  </script>

</head>
<body >


  <div class="dashbord">


    <!-- Top Navigation -->
    <nav class="navbar dashbord-navbar" role="navigation" aria-label="main navigation">
      <div class="navbar-brand">
        <a class="navbar-item" href="#">
          <img src="{{ asset('site/images/logo.png')}}">
        </a>

        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
        </a>
      </div>

      <div class="navbar-menu">
        <div class="navbar-start">
          <a class="navbar-item menu-icon" id="side-menu-btn">
            <i class="fas fa-bars"></i>
          </a>
          <a class="navbar-item">
            Course info
          </a>
          <a href="#onsite-training-modal" rel="modal:open" class="navbar-item">
            Onsite Training
          </a>
          <a href="#verify-cretificate-modal" rel="modal:open" class="navbar-item">
            Verify a Cretificate
          </a>
          <a class="navbar-item">
            Contact Us
          </a>
        </div>

        <div class="navbar-end">
          <?php $contact_details =   Session::get('contact_details'); 
         
          ?>
          <p class="navbar-item user-info">Welcom <?php if( Session::get('contact_details')!=NULL){ echo $contact_details->GIVENNAME.'&nbsp;'.$contact_details->SURNAME; }?>  @if( Session::get('contact_details')!=NULL)
            ({{$contact_details->CONTACTID}}) @if($contact_details->CUSTOMFIELD_CLUBID!=null)({{$contact_details->CUSTOMFIELD_CLUBID}})
          @endif
         @endif
       </p>
          <div class="navbar-item">
            <div class="buttons">
              <a href="#help-modal" rel="modal:open" class="button normal-btn small-btn">
                Help
              </a>
              <a href="{{url('/logout')}}" class="button normal-btn small-btn">
                Log out
              </a>
            </div>
          </div>
        </div>
      </div>
    </nav>
<?php $contact = DB::table('contacts')->get();?>
    <div id="help-modal" class="modal">
      <h3 class="title is-3">Contact Us</h3>
      <h4 class="title is-5">For Training Enquiries</h4>
      <ul class="contact-info">
        <li><span class="">Email</span><a href="mailto:{{$contact[0]->training_enquiries_email}}">{{$contact[0]->training_enquiries_email}}</a></li>
        <li><span class="">Phone</span><a href="tel:{{$contact[0]->training_enquiries_phone}}">{{$contact[0]->training_enquiries_phone}}</a></li>
      </ul>
      <h4 class="title is-5">To Enquire About An Onsite Course</h4>
      <ul class="contact-info">
        <li><span class="">Email</span><a href="mailto:{{$contact[0]->enquire_outside_course_email}}">{{$contact[0]->enquire_outside_course_email}}</a></li>
        <li><span class="">Phone</span><a href="tel:{{$contact[0]->enquire_outside_course_phone}}">{{$contact[0]->enquire_outside_course_phone}}</a></li>
      </ul>
    </div>


      <div id="verify-cretificate-modal" class="modal">
      <h3 class="title is-3">VERIFY A CERTIFICATE</h3>
      <h4 class="title is-5">To verify a certificate, testamur or statement of attainment please complete the mandatory fields below.</h4>
        
  <div class="field">
    <label class="label">FULL/LEGAL FIRST NAME</label>
    <div class="control">
      <input class="input" type="text" placeholder="FULL/LEGAL FIRST NAME" name="firstname" id="firstname">
    </div>
  </div>
   <div class="field">
    <label class="label">FULL/LEGAL SURNAME</label>
    <div class="control">
      <input class="input" type="text" placeholder="FULL/LEGAL SURNAME" name="surename" id="surename">
    </div>
  </div>

<div class="field">
    <label class="label">CERTIFICATE ID</label>
    <div class="control">
      <input class="input" type="text" placeholder="CERTIFICATE ID" name="id1" id="id1">-
      <input class="input" type="text" placeholder="CERTIFICATE ID" name="id3" id="id3">
    </div>
  </div>


 
 <p class="txt-primary-blue" id="verify-certificate-details-sucess"></p>
 <p class="txt-support-red" id="verify-certificate-details-error"></p>
 
  <div class="field is-grouped">
    <div class="control">
      <button class="button is-link" id="verify-certificate"> VERIFY</button>
    </div>
    
  </div>     

        
    </div>

    <!---ONSITE TRAINING---->

    <div id="onsite-training-modal" class="modal">
     
      <h1 class="title is-3 center">ONSITE TRAINING</h1>
      <hr>
      <p >To enquire about conducting a group course please complete the following form. LSV deliver courses within Victoria state-wide.</p>
      
      <div class="field">
  <label class="label">ORGANISATION NAME:</label>
  <div class="control">
    <input class="input" type="text"  id="OrganisationName">
  </div>
</div>
<div class="field">
  <label class="label">CONTACT NAME:</label>
  <div class="control">
    <input class="input" type="text" id="ContactName">
  </div>
</div>
<div class="field">
  <label class="label">CONTACT NUMBER:</label>
  <div class="control">
    <input class="input" type="text"  id="ContactNumber">
  </div>
</div>
<div class="field">
  <label class="label">CONTACT EMAIL:</label>
  <div class="control">
    <input class="input" type="email"  id="ContactEmail">
  </div>
</div>
<div class="field">
<div class="select">
  <label class="label">I'D LIKE TO BE CONTACTED WITH INFORMATION AND A QUOTE FOR THE FOLLOWING COURSE/S:</label>
  <div class="control">
  <select multiple size="8" id="Courses">
    <option value="Argentina">Argentina</option>
    <option value="Bolivia">Bolivia</option>
    <option value="Brazil">Brazil</option>
    <option value="Chile">Chile</option>
    <option value="Colombia">Colombia</option>
    <option value="Ecuador">Ecuador</option>
    <option value="Guyana">Guyana</option>
    <option value="Paraguay">Paraguay</option>
    <option value="Peru">Peru</option>
    <option value="Suriname">Suriname</option>
    <option value="Uruguay">Uruguay</option>
    <option value="Venezuela">Venezuela</option>
  </select>
</div>
</div>
</div>
<div class="field">
  <label class="label">TRAINING COURSE VENUE (FACILITY HIRE IS AVAILABLE UPON REQUEST):</label>
    <input class="input" type="text" id="CourseVenue">
  </div>

<div class="field">
  <label class="label">I'D LIKE TO REQUEST THE FOLLOWING DATE/S FOR THE TRAINING SESSION/S:</label>
    <input class="input" type="text" id="Date">
  </div>
  <div class="field">
  <label class="label">ADDITIONAL COMMENTS:</label>
    <input class="input" type="text" id="AdditionalComments">
  </div>
  <div class="field">
  <p class="control">
    <button class="button is-success" id="chkonsite">
      submit
    </button>
  </p>
</div>
<div class="field">
  <p class="control">
    <button class="button is-success">
      close
    </button>
  </p>
</div>
  
</div>


   
    <!---End ONSITE TRAINING-->
    <!-- End Top Navigation -->

    <!-- Admin Panel Main -->
    <div class="admin-panel-body">
      <div class="columns">
        <div class="column left" id="side-menu">
          <div class="inner">
            <ul class="side-menu-itmes">
              <li class="side-menu-item active"><a href="#"><i class="fas fa-home"></i>Home</a></li>
              <li class="side-menu-item"><a href="{{url('my-details')}}"><i class="far fa-file-alt"></i>My Details</a></li>
              <li class="side-menu-item"><a href="#"><i class="far fa-comment-dots"></i>Feedback</a></li>
              <li class="side-menu-item"><a href="#"><i class="fas fa-user-cog"></i>Reset Password</a></li>
              <li class="side-menu-item"><a href="#"><i class="fas fa-user-shield"></i>Administrater</a></li>
              <li class="side-menu-item"><a href="#"><i class="fas fa-exclamation"></i>TAF</a></li>
            </ul>
          </div>
        </div>

        <!-- content -->
        @yield('content')
       <!--end content -->
       </div>
      </div>
    </div>
    <!-- End Admin Panel Main -->

  </div>
</body>
</html>