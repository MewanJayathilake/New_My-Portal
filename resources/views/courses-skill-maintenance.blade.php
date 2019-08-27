@extends('layouts.app')

@section('content')


<div class="column right" id="dashbord">
          <div class="inner">

            <!-- Main Tab Section -->
            <div class="columns main-tabs">
              <div class="column">
                <div class="tab-box active">
                  <a href="#">
                    <i class="fas fa-search"></i>
                    Create new courses or Skill Maintenance
                    <i class="fas fa-exclamation-circle info-icon"></i>
                  </a>
                </div>
              </div>
              <div class="column">
                <div class="tab-box">
                  <a href="#">
                    <i class="fas fa-sort-amount-up"></i>
                    Reports
                    <i class="fas fa-exclamation-circle info-icon"></i>
                  </a>
                </div>
              </div>
              
              
            </div>
            <!-- End Main Tab Section -->

            <!-- Dashbord Data Section -->
            <div class="data-section">
             <!--  <form> -->
                <div class="columns is-vcentered">
                  
                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Training Course</label>
                      <div class="control">
                        <div class="select">
                          <select id="coursetype"> 
                            <!-- foreach for get course type in course details  -->
                            <option value="">Select</option>
                           @foreach($get_course_details as $course_type)
                            <option value="{{$course_type->c_id}}">{{$course_type->c_name}}</option>
                           @endforeach
                          </select>
                        </div>
                      </div> 
                    </div>
                  </div>
                  <div class="column is-2">
                    <label class="label">Date From</label>
                    <div class="control">
                      <input class="input" type="text" id="datepicker" placeholder="Date">
                    </div>
                  </div>
                  <div class="column is-2">
                    <div class="field">
                      <label class="label">Location</label>
                      <div class="control">
                         <div class="select">
                          <select id="location"> 
                            <option value="">Select</option>
             <!-- foreach for get loction -->
                      @foreach($locations as $location)      
        <option value="{{$location}}">{{$location}}</option>
             @endforeach
                        
                          </select>
                        </div> 
                       
                      </div> 
                    </div>
                  </div>
                  <div class="column is-2">
                    <button class="button normal-btn small-btn search-btn" id="ChkSubmit-skill-course">Search</button>
                    <!-- <a class="button normal-btn small-btn search-btn">Search</a> -->
                  </div>
                </div>
              <!-- </form> -->

<div id="tbl"></div> 
@endsection
