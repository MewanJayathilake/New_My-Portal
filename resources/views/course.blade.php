@extends('layouts.app')

@section('content')


<div class="column right" id="dashbord">
          <div class="inner">

            <!-- Main Tab Section -->
            <div class="columns main-tabs">
              <div class="column">
                <div class="tab-box active">
                  <!-- set find new corses url -->
                  <a href="{{url('course')}}" >
                    <i class="fas fa-search"></i>
                    Find New Course
                    <i class="fas fa-exclamation-circle info-icon" ></i>
                  </a>
                </div>
              </div>
              <div class="column">
                <div class="tab-box">
                   <!-- set Skills Maintenance url -->
                  <a href="#">
                    <i class="fas fa-sort-amount-up"></i>
                    Skills Maintenance
                    <i class="fas fa-exclamation-circle info-icon"></i>
                  </a>
                </div>
              </div>
              <div class="column">
                <div class="tab-box">
                  <!-- set my training url -->
                  <a href="{{url('my-training')}}">
                    <i class="fas fa-tv"></i>
                    My Training
                    <i class="fas fa-exclamation-circle info-icon"></i>
                  </a>
                </div>
              </div>
              <div class="column">
                <div class="tab-box">
                  <!-- set my result url -->
                  <a href="{{url('my-results')}}">
                    <i class="fas fa-medal"></i>
                    My Results
                    <i class="fas fa-exclamation-circle info-icon"></i>
                  </a>
                </div>
              </div>
            </div>
            <!-- End Main Tab Section -->

            <!-- Dashbord Data Section -->
            <div class="data-section">
             <!--  <form training area> -->
                <div class="columns is-vcentered">
                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Training Area</label>
                      <div class="control">
                        <div class="select">
                          <select> 
                            <option>Select</option>
                            <option>With options</option>
                            <option>With options</option>
                            <option>With options</option>
                          </select>
                        </div>
                      </div> 
                    </div>
                  </div>
                  <div class="column is-3">
                    <div class="field">
                      <label class="label">Training Course</label>
                      <div class="control">
                        <div class="select">
                          <select id="coursetype"> 
                             <!-- foreach for get cousre name  -->
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
                      <label class="label">Course ID</label>
                      <div class="control">
                        <input class="input" type="text" id="courseid" placeholder="Course Id">
                      </div> 
                    </div>
                  </div>
                  <div class="column is-2">
                    <button class="button normal-btn small-btn search-btn" id="ChkSubmit">Search</button>
                    <!-- <a class="button normal-btn small-btn search-btn">Search</a> -->
                  </div>
                </div>
              <!-- </form> -->

<div id="tbl"></div> 
@endsection
