@extends('layouts.app')

@section('content')

@include('includes/navigation')
<div class="container">
  <h2>Dashboard</h2>
    <div class="row">
   
    <div class="col-col-sm-4">
       <div class="form-group">
      <label for="email">Training Course:</label>
      <select class="form-control" name="coursetype" id="coursetype">
        <option value="">Select One</option>
        @for($z=0; $z < count($get_course_details); $z++)
        <option value="{{$get_course_details[$z]->NAME}}">{{$get_course_details[$z]->NAME}}</option>
        @endfor
     </select>
     
    </div>
    </div>


    <div class="col-col-sm-4">
       <div class="form-group">
      <label for="email">Course ID:</label>
      <select class="form-control" name="courseid" id="courseid">
        <option value="">Select One</option>
        @for($i=0; $i < count($get_course_details); $i++)
        <option value="{{$get_course_details[$i]->ID}}">{{$get_course_details[$i]->ID}}</option>
        @endfor
      </select>
     
    </div>
    </div>
    <div class="col-col-sm-4">
       <div class="form-group">
      <label for="email">Date From:</label>
      <input type="text" name="startdate" id="startdate" class="form-control">
     
     
    </div>
    </div>
       <div class="form-group">
        <input type="submit" name="btn" value="search" id="ChkSubmit">
       </div>
       
  </div> 

<div id="tbl"></div> 

</div>


@endsection
