@extends('layouts.app')

@section('content')
<style type="text/css">
  .admin-panel-body .right {
    background-color: #efefef;
  }
</style>

<div class="column right" id="dashbord">
  <div class="inner">

    <!-- Dashbord Data Section -->
    <div class="data-section">
      <div class="mydetails-main">
        <form>

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
                        <input class="input" type="text" placeholder="Text input" id="givenName" name="givenName" value="{{$user->GIVENNAME}}" readonly="readonly">
                      </div>
                    </div>
                  </div>

                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Full/legal Surname <span class="required">*</span></label>
                      <div class="control">
                        <input class="input" type="text" placeholder="Text input" name="surname" readonly="readonly" value="{{$user->SURNAME}}">
                      </div>
                    </div>
                  </div>

                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Email <span class="required">*</span></label>
                      <div class="control">
                        <input class="input" type="text" placeholder="Email input" id="emailAddress" name="emailAddress" readonly="readonly" value="{{$user->EMAILADDRESS}}">
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
                            <option @if($user->TITLE=='Mr') selected @endif value="Mr">Mr</option>
                            <option @if($user->TITLE=='Mrs') selected @endif value="Mrs">Mrs</option>
                            <option @if($user->TITLE=='Miss') selected @endif value="Miss">Miss</option>
                            <option @if($user->TITLE=='Ms') selected @endif value="Ms">Ms</option>
                            <option @if($user->TITLE=='Dr') selected @endif value="Dr">Dr</option>
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
                            <option @if($user->SEX=='M') selected @endif value="M">Male</option>
                           <option @if($user->SEX=='F') selected @endif value="F">Female</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Date of birth <span class="required">*</span></label>
                      <div class="control">
                        <input class="input" type="text" placeholder="Text input" id="dob" name="dob" readonly="readonly" value="{{$user->DOB}}">
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
                        <input class="input" type="text" id="buildingName" name="buildingName" value="{{$user->BUILDINGNAME}}" >
                      </div>
                    </div>
                  </div>

                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Unit/flat details</label>
                      <div class="control">
                        <input class="input" type="text"  name="unitNo" id="unitNo" value="{{$user->UNITNO}}">
                      </div>
                    </div>
                  </div>

                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Street number <span class="required">*</span></label>
                      <div class="control">
                        <input class="input" type="text"  id="streetNo" name="streetNo"  value="{{$user->STREETNO}}">
                      </div>
                    </div>
                  </div>

                     <div class="column is-3">
                    <div class="field">
                      <label class="label">Street name <span class="required">*</span></label>
                      <div class="control">
                        <input class="input" type="text"  id="streetNo" name="streetNo"  value="{{$user->STREETNAME}}">
                      </div>
                    </div>
                  </div>

                   <div class="column is-3">
                    <div class="field">
                      <label class="label">City <span class="required">*</span></label>
                      <div class="control">
                        <input class="input" type="text"  id="city" name="city"  value="{{$user->CITY}}">
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
                            <option @if($user->STATE =='VIC') selected @endif value="VIC">VIC</option>
                            <option @if($user->STATE =='NSW') selected @endif value="NSW">NSW</option>
                            <option @if($user->STATE =='QLD') selected @endif value="QLD">QLD</option>
                            <option @if($user->STATE =='WA') selected @endif value="WA">WA</option>
                            <option @if($user->STATE =='SA') selected @endif value="SA">SA</option>
                            <option @if($user->STATE=='NT') selected @endif value="NT">NT</option>
                            <option @if($user->STATE =='TAS') selected @endif value="TAS">TAS</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  

                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Postcode <span class="required">*</span></label>
                      <div class="control">
                        <input class="input" type="text" placeholder="Text input" id="postcode" name="postcode"  value="{{$user->POSTCODE}}">
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
                        <input class="input" type="text" id="POBox" name="POBox" value="{{$user->POBOX}}" >
                      </div>
                    </div>
                  </div>

                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Building/property name</label>
                      <div class="control">
                        <input class="input" type="text"  name="sbuildingName" id="sbuildingName" value="{{$user->SBUILDINGNAME}}">
                      </div>
                    </div>
                  </div>

                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Street number <span class="required">*</span></label>
                      <div class="control">
                        <input class="input" type="text"  id="sstreetNo" name="sstreetNo"  value="{{$user->SSTREETNO}}">
                      </div>
                    </div>
                  </div>

                   <div class="column is-3">
                    <div class="field">
                      <label class="label">Street name <span class="required">*</span></label>
                      <div class="control">
                        <input class="input" type="text"  id="sstreetName" name="sstreetName"  value="{{$user->SSTREETNAME}}">
                      </div>
                    </div>
                  </div>

                   <div class="column is-3">
                    <div class="field">
                      <label class="label">City <span class="required">*</span></label>
                      <div class="control">
                        <input class="input" type="text"  id="scity" name="scity"  value="{{$user->SCITY}}">
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
                            <option @if($user->SSTATE =='VIC') selected @endif value="VIC">VIC</option>
                            <option @if($user->SSTATE =='NSW') selected @endif value="NSW">NSW</option>
                            <option @if($user->SSTATE =='QLD') selected @endif value="QLD">QLD</option>
                            <option @if($user->SSTATE =='WA') selected @endif value="WA">WA</option>
                            <option @if($user->SSTATE =='SA') selected @endif value="SA">SA</option>
                            <option @if($user->SSTATE=='NT') selected @endif value="NT">NT</option>
                            <option @if($user->SSTATE =='TAS') selected @endif value="TAS">TAS</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  

                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Postcode <span class="required">*</span></label>
                      <div class="control">
                        <input class="input" type="text" placeholder="Text input" id="spostcode" name="spostcode"  value="{{$user->SPOSTCODE}}" maxlength="4">
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
                        <input class="input" type="text" id="phone" name="phone" value="{{$user->PHONE}}" >
                      </div>
                    </div>
                  </div>

                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Work phone number</label>
                      <div class="control">
                        <input class="input" type="text"  name="workphone" id="workphone" value="{{$user->WORKPHONE}}">
                      </div>
                    </div>
                  </div>

                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Mobile phone number </label>
                      <div class="control">
                        <input class="input" type="text"  id="mobilephone" name="mobilephone"  value="{{$user->MOBILEPHONE}}">
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
                            <option @if($user->COUNTRYOFBIRTHID == '1101') selected @endif value="1101">Yes</option>
                            <option @if($user->COUNTRYOFBIRTHID == '1101') selected @endif value="No">No</option>
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
                            <option>Select dropdown</option>
                            <option value="1101">srilanka</option>
                            <option value="uk">uk</option>
                            <option value="usa">usa</option>
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
                           <select name="IndigenousStatusID">
                                            <option value="">Please select</option>
                               <option @if($user->INDIGENOUSSTATUSID ==1) selected @endif value="1">Yes, Aboriginal</option>
                               <option @if($user->INDIGENOUSSTATUSID ==2) selected @endif value="2">Yes, Torres Strait Islander</option>
                               <option @if($user->INDIGENOUSSTATUSID ==4) selected @endif value="4">No</option>
                               <option @if($user->INDIGENOUSSTATUSID =='@') selected @endif value="@">I would prefer not to disclose this information</option>
                                            
                                      
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
                                            <option @if($user->MAINLANGUAGEID =='Yes') selected @endif value="Yes">Yes</option>
                                             <option @if($user->MAINLANGUAGEID =='1201') selected @endif value="1201">No</option>
                                            
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
                                            <option value="si">si</option>
                                            <option value="ta">ta</option>
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
                         <select  name="EnglishProficiencyID">
                                            <option value="">Please select</option>
                                            <option @if($user->ENGLISHPROFICIENCYID == 1) selected @endif value="1">Very well</option>
                                            <option @if($user->ENGLISHPROFICIENCYID == 2) selected @endif value="2">Well</option>
                                            <option @if($user->ENGLISHPROFICIENCYID == 3) selected @endif value="3">Not well</option>
                                            <option @if($user->ENGLISHPROFICIENCYID == 4) selected @endif value="4">Not at all</option>
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
                          <select  name="DisabilityFlag">
                                            <option value="">Please select</option>
                                            <option @if($user->DISABILITYFLAG == 1) selected @endif value="1">Yes</option>
                                            <option @if($user->DISABILITYFLAG == 0) selected @endif value="0">No</option>
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
                        <input class="input" type="text" name="customField1">
                      </div>
                    </div>
                  </div>

                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Universal Student Identifier</label>
                      <div class="control">
                        <input class="input" type="text" id="USI" name="USI" value="{{$user->USI}}" >
                      </div>
                    </div>
                  </div>

                  <div class="column is-6">
                    <div class="field">
                      <label class="label">What is your highest school level completed</label>
                      <div class="control">
                        <div class="select">
                          <select  id="HighestSchoolLevelID" name="HighestSchoolLevelID">
                                            <option value="">Please select</option>
                                            <option @if($user->HIGHESTSCHOOLLEVELID == '12') selected @endif value="12">Year 12 or equivalent</option>
                                            <option @if($user->HIGHESTSCHOOLLEVELID == '11') selected @endif value="11">Year 11 or equivalent</option>
                                            <option @if($user->HIGHESTSCHOOLLEVELID == '10') selected @endif value="10">Year 10 or equivalent</option>
                                            <option @if($user->HIGHESTSCHOOLLEVELID == '09') selected @endif value="09">Year 9 or equivalent</option>
                                            <option  @if($user->HIGHESTSCHOOLLEVELID == '08') selected @endif value="08">Year 8 or below</option>
                                            <option @if($user->HIGHESTSCHOOLLEVELID == '02') selected @endif  value="02">Did not go to school</option>
                                        </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="column is-6">
                    <div class="field">
                      <label class="label">In which year did you complete that school level?</label>
                      <div class="control">
                        <input class="input" type="text" id="HighestSchoolLevelYear" name="HighestSchoolLevelYear" value="{{$user->HIGHESTSCHOOLLEVELYEAR}}">
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
                                            <option @if($user->ATSCHOOLFLAG ==true) selected @endif value="true">Yes</option>
                                            <option @if($user->ATSCHOOLFLAG ==false) selected @endif value="">No</option>
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
                                            <option @if($user->LABOURFORCEID == 1) selected @endif value="1">Full-time Employee</option>
                                            <option @if($user->LABOURFORCEID == 3) selected @endif value="3">Self Employed - Not employing others</option>
                                            <option @if($user->LABOURFORCEID == 2) selected @endif  value="2">Part-time Employee</option>
                                            <option @if($user->LABOURFORCEID == 8) selected @endif  value="8">Not Employed - Not seeking work</option>
                                            <option @if($user->LABOURFORCEID == 5) selected @endif value="5">Employed - Unpaid, working in a family business</option>
                                            <option @if($user->LABOURFORCEID == 7) selected @endif value="7">Unemployed - Seeking full-time work</option>
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
            <a class="button small-btn normal-btn">Save</a>
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
        var userID= "<?php echo $user->EMAILADDRESS ;?>";
        getUserDetails(userID,"enrolment");
    });
  </script>


@endsection