@extends('layouts.app')

@section('content')
<!-- Dashbord Data Section -->
<style type="text/css">
  .my-details-row {
    background-color: white;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 6px;
    box-shadow: 0 2px 7px -5px rgba(0, 0, 0, 0.5);
    border: 1px solid #f5f5f5;
}
</style>
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
<!--  Basic Information -->

    <div class="my-details-row">
      <div class="columns is-mobile is-multiline">

        <div class="column is-3">
          <div class="field">
            <label class="label">Full/legal First Name</label>
            <div class="control">
              <input class="input" type="text"  id="givenName" name="givenName" value="{{$user->GIVENNAME}}" readonly="readonly">
            </div>
          </div>
        </div>

         <div class="column is-3">
          <div class="field">
        <label class="label">Full/legal Surname</label>
        <div class="control">
          <input class="input" type="text" id="surname" name="surname" readonly="readonly" value="{{$user->SURNAME}}">
        </div>
      </div>
    </div>

        <div class="column is-3">
         <div class="field">
        <label class="label">Email</label>
        <div class="control">
          <input class="input" type="text" id="emailAddress" name="emailAddress" readonly="readonly" value="{{$user->EMAILADDRESS}}">
        </div>
      </div>
        </div>

        <div class="column is-3">
         <div class="field">
        <label class="label">Title</label>
        <div class="control">
          <div class="select">
            <select name="title" id="title"> 
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
        <label class="label">Sex</label>
        <div class="control">
          <div class="select">
            <select name="sex" id="sex"> 
              <option value="">Please Select</option>
              <option @if($user->SEX=='M') selected @endif value="M">Male</option>
              <option @if($user->SEX=='F') selected @endif value="F">Female</option>

            </select>
          </div>

        </div>
      </div>
        </div>

        <div class="column is-3">
         <div class="field">
        <label class="label">DATE OF Birth</label>
        <div class="control">
          <input class="input" type="text" id="dob" name="dob" readonly="readonly" value="{{$user->DOB}}">
        </div>
      </div>
        </div>

      </div>
    </div>

<!-- End Basic Information -->
<!-- Personal Address -->
    
   <div class="my-details-row">
      <div class="columns is-mobile is-multiline">

        <div class="column is-3">
          <div class="field">
            <label class="label">Building/property name</label>
            <div class="control">
              <input class="input" type="text"  id="buildingName" name="buildingName" >
            </div>
          </div>
        </div>

         <div class="column is-3">
          <div class="field">
        <label class="label">Unit/flat details</label>
        <div class="control">
          <input class="input" type="text" id="unitNo" name="unitNo" >
        </div>
      </div>
    </div>

        <div class="column is-3">
         <div class="field">
        <label class="label">Street number</label>
        <div class="control">
          <input class="input" type="text" name="streetNo" id="streetNo">
        </div>
      </div>
        </div>

       

         <div class="column is-3">
         <div class="field">
        <label class="label">Street name</label>
        <div class="control">
          <input class="input" type="text" name="streetName" id="streetName">
        </div>
      </div>
        </div>

         <div class="column is-3">
         <div class="field">
        <label class="label">City</label>
        <div class="control">
          <input class="input" type="text" id="city" name="city">
        </div>
      </div>
        </div>

        <div class="column is-3">
         <div class="field">
        <label class="label">State</label>
        <div class="control">
          <div class="select">
            <select name="title" id="title"> 
              <option  value="">Select One</option>
            <option  value="VIC">VIC</option>
                                            <option value="NSW">NSW</option>
                                            <option value="QLD">QLD</option>
                                            <option value="WA">WA</option>
                                            <option value="SA">SA</option>
                                            <option value="NT">NT</option>
                                            <option value="TAS">TAS</option>
            </select>
          </div>
        </div> 
      </div>
        </div>

       

        <div class="column is-3">
         <div class="field">
        <label class="label">Postcode</label>
        <div class="control">
          <input class="input" type="text" id="postcode" name="postcode" maxlength="4">
        </div>
      </div>
        </div>

      </div>
    </div>
<!-- End  Personal Address -->

    <!-- Postal Address -->  
<div class="my-details-row">
      <div class="columns is-mobile is-multiline">

        <div class="column is-3">
          <div class="field">
            <label class="label">PO Box (if applicable)</label>
            <div class="control">
              <input class="input" type="text"  id="POBox" name="POBox" >
            </div>
          </div>
        </div>

         <div class="column is-3">
          <div class="field">
        <label class="label">Building/property name</label>
        <div class="control">
          <input class="input" type="text" id="sbuildingName" name="sbuildingName" >
        </div>
      </div>
    </div>

    <div class="column is-3">
         <div class="field">
        <label class="label">Street number</label>
        <div class="control">
          <input class="input" type="text" name="sstreetNo" id="sstreetNo">
        </div>
      </div>
        </div>

        <div class="column is-3">
         <div class="field">
        <label class="label">Street name</label>
        <div class="control">
          <input class="input" type="text" name="sstreetName" id="sstreetName">
        </div>
      </div>
        </div>

       

         <div class="column is-3">
         <div class="field">
        <label class="label">City</label>
        <div class="control">
          <input class="input" type="text" name="scity" id="scity">
        </div>
      </div>
        </div>

         

        <div class="column is-3">
         <div class="field">
        <label class="label">State</label>
        <div class="control">
          <div class="select">
            <select name="sstate" id="sstate"> 
              <option  value="">Select One</option>
            <option  value="VIC">VIC</option>
                                            <option value="NSW">NSW</option>
                                            <option value="QLD">QLD</option>
                                            <option value="WA">WA</option>
                                            <option value="SA">SA</option>
                                            <option value="NT">NT</option>
                                            <option value="TAS">TAS</option>
            </select>
          </div>
        </div> 
      </div>
        </div>

       

        <div class="column is-3">
         <div class="field">
        <label class="label">Postcode</label>
        <div class="control">
          <input class="input" type="text" id="spostcode" name="spostcode" maxlength="4">
        </div>
      </div>
        </div>

      </div>
    </div>
      <!-- End Postal Address -->  
 <!-- Contact numbers -->
 <div class="my-details-row">
      <div class="columns is-mobile is-multiline">

        <div class="column is-3">
          <div class="field">
            <label class="label">Home phone number</label>
            <div class="control">
              <input class="input" type="text"  id="phone" name="phone" >
            </div>
          </div>
        </div>

         <div class="column is-3">
          <div class="field">
        <label class="label">Work phone number</label>
        <div class="control">
          <input class="input" type="text" id="workphone" name="workphone" >
        </div>
      </div>
    </div>

    <div class="column is-3">
         <div class="field">
        <label class="label">Mobile phone number</label>
        <div class="control">
          <input class="input" type="text" name="mobilephone" id="mobilephone">
        </div>
      </div>
        </div>

    

      </div>
    </div>
  <!--End Contact numbers -->

            <!-- Background information -->

<div class="my-details-row">
      <div class="columns is-mobile is-multiline">

         <div class="column is-3">
         <div class="field">
        <label class="label">Were you born in Australia?</label>
        <div class="control">
          <div class="select">
            <select name="CountryofBirthID" id="CountryofBirthID"> 
               <option value="">Please select</option>
                                            <option value="1101">Yes</option>
                                            <option value="No">No</option>
            </select>
          </div>
        </div> 
      </div>
        </div>

         <div class="column is-3">
         <div class="field">
        <label class="label">If no please specify</label>
        <div class="control">
          <div class="select">
            <select name="CountryofBirthID" id="CountryofBirthID"> 
               <option value="">Please select</option>
                                            <option value="1101">Yes</option>
                                            <option value="No">No</option>
            </select>
          </div>
        </div> 
      </div>
        </div>

    <div class="column is-3">
         <div class="field">
        <label class="label">Mobile phone number</label>
        <div class="control">
          <input class="input" type="text" name="mobilephone" id="mobilephone">
        </div>
      </div>
        </div>

    

      </div>
    </div>




                  <!-- End Background information -->

      <div class="field is-grouped">
        <div class="control">
          <button class="button is-link">Submit</button>
        </div>
        <div class="control">
          <button class="button is-text">Cancel</button>
        </div>
      </div>     
   


    <!--end tbl -->


  </div>
</div>
<!-- End Dashbord Data Section -->
@endsection