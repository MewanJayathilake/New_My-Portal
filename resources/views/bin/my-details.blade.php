@extends('layouts.app')

@section('content')
<style type="text/css">
  .admin-panel-body .right {
    background-color: #efefef;
  }
</style>
<?php
$countries = (new \App\Helpers\Common())->countries();
$languages = (new \App\Helpers\Common())->languages();
?>
<div class="column right" id="dashbord">
  <div class="inner">

    <!-- Dashbord Data Section -->
    <div class="data-section">
      <div class="mydetails-main">
        <form id="detail-form">
@csrf
          <!-- Basic Info Section -->
          <div class="info-row">
            <div class="form-sec">
              <div class="platform-icons platform-icons-text primary-blue">
                <span class="icon">
                  <i class="fas fa-pencil-alt"></i>
                </span>
                <span class="i-text">Basic information</span>
              </div>

              <hr>

              <div class="inner">
                <div class="columns is-multiline">
                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Full/legal First Name <span class="required">*</span></label>
                      <div class="control">
                        <input class="input" type="text" placeholder="Text input" id="givenName" name="givenName"  readonly="readonly">
                      </div>
                    </div>
                  </div>

                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Full/legal Surname <span class="required">*</span></label>
                      <div class="control">
                        <input class="input" type="text" id="surname" name="surname" readonly="readonly" >
                      </div>
                    </div>
                  </div>

                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Email <span class="required">*</span></label>
                      <div class="control">
                        <input class="input" type="text" placeholder="Email input" id="emailAddress" name="emailAddress" readonly="readonly" >
                      </div>
                    </div>
                  </div>

                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Title <span class="required">*</span></label>
                      <div class="control">
                        <div class="select">
                          <select name="title" id="title"> 
                            <option value="">Select one</option>
                             <option value="">Please Select</option>
                            <option  value="Mr">Mr</option>
                            <option  value="Mrs">Mrs</option>
                            <option  value="Miss">Miss</option>
                            <option  value="Ms">Ms</option>
                            <option value="Dr">Dr</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Sex <span class="required">*</span></label>
                      <div class="control">
                        <div class="select">
                          <select> 
                            <option value="">Select one</option>
                            <option  value="M">Male</option>
                           <option  value="F">Female</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Date of birth <span class="required">*</span></label>
                      <div class="control">
                        <input class="input" type="text" placeholder="Text input" id="dob" name="dob" readonly="readonly" >
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--End Info Section -->

            <!-- Personal Address Info Section -->
          <div class="info-row">
            <div class="form-sec">
              <div class="platform-icons platform-icons-text primary-blue">
                <span class="icon">
                  <i class="fas fa-pencil-alt"></i>
                </span>
                <span class="i-text">Personal address</span>
              </div>

              <hr>

              <div class="inner">
                <div class="columns is-multiline">
                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Building/property name</label>
                      <div class="control">
                        <input class="input" type="text" id="buildingName" name="buildingName"  >
                      </div>
                    </div>
                  </div>

                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Unit/flat details</label>
                      <div class="control">
                        <input class="input" type="text"  name="unitNo" id="unitNo" >
                      </div>
                    </div>
                  </div>

                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Street number <span class="required">*</span></label>
                      <div class="control">
                        <input class="input" type="text"  id="streetNo" name="streetNo"  >
                      </div>
                    </div>
                  </div>

                     <div class="column is-3">
                    <div class="field">
                      <label class="label">Street name <span class="required">*</span></label>
                      <div class="control">
                        <input class="input" type="text"  id="streetNo" name="streetNo" >
                      </div>
                    </div>
                  </div>

                   <div class="column is-3">
                    <div class="field">
                      <label class="label">City <span class="required">*</span></label>
                      <div class="control">
                        <input class="input" type="text"  id="city" name="city"  >
                      </div>
                    </div>
                  </div>



                  <div class="column is-3">
                    <div class="field">
                      <label class="label">State <span class="required">*</span></label>
                      <div class="control">
                        <div class="select">
                          <select name="state" id="state"> 
                            <option value="">Select one</option>
                            <option   value="VIC">VIC</option>
                            <option  value="NSW">NSW</option>
                            <option  value="QLD">QLD</option>
                            <option value="WA">WA</option>
                            <option  value="SA">SA</option>
                            <option  value="NT">NT</option>
                            <option  value="TAS">TAS</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  

                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Postcode <span class="required">*</span></label>
                      <div class="control">
                        <input class="input" type="text" placeholder="Text input" id="postcode" name="postcode">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--End personal Info Section -->

           <!-- Postal Address Info Section -->
          <div class="info-row">
            <div class="form-sec">
              <div class="platform-icons platform-icons-text primary-blue">
                <span class="icon">
                  <i class="fas fa-pencil-alt"></i>
                </span>
                <span class="i-text">Postal address</span>
              </div>

              <hr>

              <div class="inner">
                <div class="columns is-multiline">
                  <div class="column is-3">
                    <div class="field">
                      <label class="label">PO Box (if applicable)</label>
                      <div class="control">
                        <input class="input" type="text" id="POBox" name="POBox">
                      </div>
                    </div>
                  </div>

                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Building/property name</label>
                      <div class="control">
                        <input class="input" type="text"  name="sbuildingName" id="sbuildingName" >
                      </div>
                    </div>
                  </div>

                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Street number <span class="required">*</span></label>
                      <div class="control">
                        <input class="input" type="text"  id="sstreetNo" name="sstreetNo" >
                      </div>
                    </div>
                  </div>

                   <div class="column is-3">
                    <div class="field">
                      <label class="label">Street name <span class="required">*</span></label>
                      <div class="control">
                        <input class="input" type="text"  id="sstreetName" name="sstreetName" >
                      </div>
                    </div>
                  </div>

                   <div class="column is-3">
                    <div class="field">
                      <label class="label">City <span class="required">*</span></label>
                      <div class="control">
                        <input class="input" type="text"  id="scity" name="scity"  >
                      </div>
                    </div>
                  </div>



                  <div class="column is-3">
                    <div class="field">
                      <label class="label">State <span class="required">*</span></label>
                      <div class="control">
                        <div class="select">
                          <select name="sstate" id="sstate"> 
                            <option value="">Select one</option>
                            <option  value="VIC">VIC</option>
                            <option  value="NSW">NSW</option>
                            <option  value="QLD">QLD</option>
                            <option  value="WA">WA</option>
                            <option  value="SA">SA</option>
                            <option  value="NT">NT</option>
                            <option  value="TAS">TAS</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  

                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Postcode <span class="required">*</span></label>
                      <div class="control">
                        <input class="input" type="text" placeholder="Text input" id="spostcode" name="spostcode" maxlength="4">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--End personal Info Section -->


                 <!-- Contact no Info Section -->
          <div class="info-row">
            <div class="form-sec">
              <div class="platform-icons platform-icons-text primary-blue">
                <span class="icon">
                  <i class="fas fa-pencil-alt"></i>
                </span>
                <span class="i-text">Contact numbers</span>
              </div>

              <hr>

              <div class="inner">
                <div class="columns is-multiline">
                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Home phone number</label>
                      <div class="control">
                        <input class="input" type="text" id="phone" name="phone"  >
                      </div>
                    </div>
                  </div>

                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Work phone number</label>
                      <div class="control">
                        <input class="input" type="text"  name="workphone" id="workphone">
                      </div>
                    </div>
                  </div>

                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Mobile phone number </label>
                      <div class="control">
                        <input class="input" type="text"  id="mobilephone" name="mobilephone">
                      </div>
                    </div>
                  </div>

                   
                </div>
              </div>
            </div>
          </div>
          <!--End Contact no Info Section -->

          <!-- Info Section -->
          <div class="info-row">
            <div class="form-sec">
              <div class="platform-icons platform-icons-text support-red">
                <span class="icon">
                  <i class="fas fa-info"></i>
                </span>
                <span class="i-text">Background information <span class="sub-i-text">(Mandatory for RTO - Registered training organisations)</span></span>
              </div>

              <hr>

              <div class="inner">
                <div class="columns is-multiline">

                  <div class="column is-6">
                    <div class="field">
                      <label class="label">Were you born in Australia?</label>
                      <div class="control">
                        <div class="select">
                          <select name="CountryofBirthID" id="CountryofBirthID"> 
                            <option>Select dropdown</option>
                            <option  value="1101">Yes</option>
                            <option value="No">No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="column is-6">
                    <div class="field">
                      <label class="label">If no please specify</label>
                      <div class="control">
                        <div class="select">
                          <select id="CountryofBirthID2" name="CountryofBirthID"> 
                            <option value="">Select dropdown</option>
                             @foreach($countries as $key => $country)
                                                <option value="<?php echo $key ?>"><?php echo $country ?></option>
                             @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="column is-6">
                    <div class="field">
                      <label class="label">Are you of Aboriginal or Torres Strait Islander origin?</label>
                      <div class="control">
                        <div class="select">
                           <select name="IndigenousStatusID" id="IndigenousStatusID">
                                            <option value="">Please select</option>
                                 <option value="">Please select</option>
                                            <option value="1">Yes, Aboriginal</option>
                                            <option value="2">Yes, Torres Strait Islander</option>
                                            <option value="4">No</option>
                                            <option value="@">I would prefer not to disclose this information</option>
                                            
                                      
                            </select>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="columns is-multiline">

                  <div class="column is-6">
                    <div class="field">
                      <label class="label">Do you speak a language other than English at home?</label>
                      <div class="control">
                        <div class="select">
                           <select id="MainLanguageID"  name="MainLanguageID">
                                            <option value="">Please select</option>
                                             <option value="Yes">Yes</option>
                                            <option value="1201">No, English only</option>
                                            
                                        </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="column is-6">
                    <div class="field">
                      <label class="label">If yes please specify</label>
                      <div class="control">
                       <div class="select">
                           <select id="MainLanguageID2" name="MainLanguageID">
                                            <option value="">Please select</option>
                                         @foreach($languages as $key => $language)
                                                <option value="<?php echo $key ?>"><?php echo $language ?></option>
                                            @endforeach
                                        </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="column is-6">
                    <div class="field">
                      <label class="label">How well do you speak English?</label>
                      <div class="control">
                        <div class="select">
                         <select  name="EnglishProficiencyID" id="EnglishProficiencyID">
                                            <option value="">Please select</option>
                                          <option value="1">Very well</option>
                                            <option value="2">Well</option>
                                            <option value="3">Not well</option>
                                            <option value="4">Not at all</option>
                                        </select>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="columns is-multiline">

                  <div class="column is-6">
                    <div class="field">
                      <label class="label">Do you consider yourself to have a disability?</label>
                      <div class="control">
                        <div class="select">
                          <select  name="DisabilityFlag" id="DisabilityFlag">
                                            <option value="">Please select</option>
                                <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="column is-6">
                    <div class="field">
                      <label class="label">If yes please specify</label>
                      <div class="control">
                       <div class="select">
                        <select id="DisabilityTypeID" name="DisabilityTypeID" multiple="multiple">

                                            <option value="12">Physical</option>
                                            <option value="11">Hearing/Deaf</option>
                                            <option value="13">Intellectual</option>
                                            <option value="16">Acquired Brain Impairment</option>
                                            <option value="15">Mental Illness</option>
                                            <option value="14">Learning</option>
                                            <option value="18">Medical Condition</option>
                                            <option value="19">Other</option>
                                        </select>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

              </div>
            </div>
          </div>
          <!--End Info Section -->

          <!-- Info Section -->
          <div class="info-row">
            <div class="form-sec">
              <div class="platform-icons platform-icons-text support-yellow">
                <span class="icon">
                  <i class="fas fa-briefcase"></i>
                </span>
                <span class="i-text">Education / Work background <span class="sub-i-text">(Mandatory for RTO - Registered training organisations)</span></span>
              </div>

              <hr>

              <div class="inner">
                <div class="columns is-multiline">
                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Student Number</label>
                      <div class="control">
                        <input class="input" type="text" name="customField1" id="customField1">
                      </div>
                    </div>
                  </div>

                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Universal Student Identifier</label>
                      <div class="control">
                        <input class="input" type="text" id="USI" name="USI">
                      </div>
                    </div>
                  </div>

                  <div class="column is-6">
                    <div class="field">
                      <label class="label">What is your highest school level completed</label>
                      <div class="control">
                        <div class="select">
                          <select  id="HighestSchoolLevelID" name="HighestSchoolLevelID">
                                           <option value="12">Year 12 or equivalent</option>
                                            <option value="11">Year 11 or equivalent</option>
                                            <option value="10">Year 10 or equivalent</option>
                                            <option value="09">Year 9 or equivalent</option>
                                            <option value="08">Year 8 or below</option>
                                            <option value="02">Did not go to school</option>
                                        </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="column is-6">
                    <div class="field">
                      <label class="label">In which year did you complete that school level?</label>
                      <div class="control">
                        <input class="input" type="text" id="HighestSchoolLevelYear" name="HighestSchoolLevelYear">
                      </div>
                    </div>
                  </div>

                  <div class="column is-6">
                    <div class="field">
                      <label class="label">Are you still attending secondary school?</label>
                      <div class="control">
                        <div class="select">
                         <select  name="AtSchoolFlag" id="AtSchoolFlag">
                                            <option value="">Please select</option>
                                            <option value="true">Yes</option>
                                            <option value="false">No</option>
                                        </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="column is-6">
                    <div class="field">
                      <label class="label">Have you successfully completed any of the following qualifications?</label>
                      <div class="control">
                        <div class="select">
                                <select name="PriorEducationID" id="PriorEducationID" multiple="multiple">

                                            <option value="008">Bachelor Degree or Higher</option>
                                            <option value="410">Advanced Diploma or Associate Degree</option>
                                            <option value="420">Diploma</option>
                                            <option value="511">Certificate IV</option>
                                            <option value="514">Certificate III</option>
                                            <option value="521">Certificate II</option>
                                            <option value="524">Certificate I</option>
                                            <option value="990">Certificate other than above</option>
                                        </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="column is-12">
                    <div class="field">
                      <label class="label">Of the following categories, which best describes your current employment status?</label>
                      <div class="control">
                        <div class="select">
                           <select name="LabourForceID" id="LabourForceID" >
                                            <option value="">Please select</option>
                                            <option value="1">Full-time Employee</option>
                                            <option value="3">Self Employed - Not employing others</option>
                                            <option value="2">Part-time Employee</option>
                                            <option value="8">Not Employed - Not seeking work</option>
                                            <option value="5">Employed - Unpaid, working in a family business</option>
                                            <option value="7">Unemployed - Seeking full-time work</option>
                                        </select>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <!--End Info Section -->
<input type="hidden" id="contactID" value="<?php echo $user->CONTACTID; ?>"name="contactID"> 
          <div class="btn-main txt-right">
            <input type="submit" value="Save" class="button small-btn normal-btn">
            
            
            <a class="button small-btn delete-btn">Cancel</a>
          </div>

        </form>
      </div>
    </div>
    <!-- End Dashbord Data Section -->

  </div>
</div>

<script>
    $(document).ready(function(){
        //start User Profile
        var contactID= "<?php echo $user->CONTACTID ;?>";
        getUserDetails(contactID,"enrolment");

           $("#detail-form").unbind('submit').bind('submit', function() {
                var formData = $("#detail-form").serialize();
                $.ajax({
                type: "POST",
                url: "{{url('update_mydetails')}}",
                dataType: 'json',
                cache: false,
                data: formData,
                success: function(data) {
                    var result = JSON.stringify(data, undefined, 2);
                    console.log(data);
                    if(data.status == 'success'){
                        $('.response').hide().html('<div class="alert" style="margin-top: 10px; margin-bottom: 0;"><i class="icon-check"></i> ' + data.message + '</div>').fadeIn();
                    } else {
                        $('.response').hide().html('<div class="alert alert-error" style="margin-top: 10px; margin-bottom: 0;"><i class="icon-remove-sign"></i> ' + data.message + '</div>').fadeIn();
                    }
                },
                error: function(data) {
                    $('.response').hide().html('<div class="alert alert-error" style="margin-top: 10px; margin-bottom: 0;"><i class="icon-remove-sign"></i>Network error</div>').fadeIn();
                }
            });
            return false;
            });


          

            
            
    });
  </script>


@endsection