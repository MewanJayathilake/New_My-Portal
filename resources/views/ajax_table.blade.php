
   <!-- Data Table Section -->
              <div class="table-main">
                <table id="datatable" class="display table is-bordered is-striped is-narrow is-hoverable">
                  <!-- teble headers -->
                  <thead>
                    <tr>
                      <th>Course Type</th>
                      <th>Start Date</th>
                      <th>Session</th>
                      <th>Location</th>
                      <th>Delivery Method</th>
                      <th>Spaces Available</th>
                      <th>Enrol</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- for loop for get contact details -->
                     @for($i=0; $i< count($get_course_details); $i++)
    <?php 

// find the delivery_type acording to course-type
        switch($get_course_details[$i]->TYPE){
                case "p":
                    $delivery_type = "Face-to-face only";
                break;
                
                case "w":
                    $delivery_type = "Face-to-face only";
                break;
                
                case "el":
                    $delivery_type = 'Online only';
                break;
                
                case "All":
                    $delivery_type = 'Online training + Face-to-face';
                break;
            }
            ?>
                    <tr>
                      <!-- get course name in course details -->
                      <td>{{$get_course_details[$i]->NAME}}</td>                      
                      <!-- get start date in course details -->
                      <td>{{date("d-M-Y ", strtotime($get_course_details[$i]->STARTDATE))}}</td>
                      <!-- foreach loop for get COMPLEXDATES in course details -->
                        <?php 
                        $comdate = array();

                        foreach($get_course_details[$i]->COMPLEXDATES as $list)
                        {
                        $comdate[] = $list->DATE.'=>'.$list->STARTTIME.'=>'.$list->ENDTIME;
                        }

                        $complexdate_array =  implode(" ",$comdate);

                        ?>
                      <td>
                        <!-- display a tooltip complexdate -->
                      <a class="button inactive-btn small-btn" title="{{$complexdate_array}}">
                          <span>More</span>
                          <span class="icon is-small">
                            <i class="fas fa-caret-right"></i>
                          </span>
                        </a>
                      </td>
                    <!-- get location in course details -->
                      <td>{{$get_course_details[$i]->LOCATION}}</td>
                      <!-- get delivery type in course details -->
                      <td>{{$delivery_type}}</td>
                      <!-- get availability(1/20) in course details -->
                      <td>{{$get_course_details[$i]->PARTICIPANTS}}/{{$get_course_details[$i]->MAXPARTICIPANTS}}</td>
                      <td>
                        <!-- get entrolment in course details using INSTANCEID -->
                        <a class="button selected-btn small-btn entrolment" href="#help-modal{{$i}}" rel="modal:open"  id="entrolment{{$i}}" data-bean-id="{{$i}}" typeid = "{{$delivery_type}}"  INSTANCEID="{{$get_course_details[$i]->INSTANCEID}}">
                          <span>Enrol</span>
                          <span class="icon is-small">
                            <i class="fas fa-caret-right"></i>
                          </span>
                        </a>
                      </td>
                    </tr>
                    
            <!-- help modal display in pop up box  -->

    <div id="help-modal{{$i}}" class="modal">
     <div class="response-entrollment"></div>
     </div>
                    @endfor
                  </tbody>
                  <!-- table footer -->
                  <tfoot>
                    <tr>
                      <th>Course Type</th>
                      <th>Start Date</th>
                      <th>Session</th>
                      <th>Location</th>
                      <th>Delivery Method</th>
                      <th>Spaces Available</th>
                      <th>Enrol</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- End Data Table Section -->

            </div>
            <!-- End Dashbord Data Section -->

          </div>


<script type="text/javascript">
    $(document).ready(function() {
    $('#datatable').DataTable();
	
	$('.entrolment').click(function() {
        // Recover data-bean-id tag value
        var beanId = $(this).data('beanId');

        var instanceID = $(this).attr("INSTANCEID");
        var TYPE =$(this).attr("typeid");
        var contactID = 4772088;//Ranga:Contact_Id
		
		 // passing values
        var dataString = {
    
contactID:contactID,instanceID:instanceID,TYPE:TYPE,
};

 // get values to ajax

  $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });
	
	$.ajax({

           type:'POST',

           url:"{{url('course-entrollment')}}",

           data:dataString,

           success:function(data){
// do something 
var obj = JSON.parse(data);
console.log(obj);
if(obj.status == 'success'){
	console.log(obj.message);
  //$("#entrolment-details-sucess").html(obj.message);
  $('.response-entrollment').hide().html('<p class="submit"> ' + obj.message + '</p>').fadeIn();
}else if(obj.status == 'error'){
	console.log(obj.message);
	$('.response-entrollment').hide().html('<p class="error"> ' + obj.message + '</p>').fadeIn();
   //$("#entrolment-details-error").html(obj.message);
}
           

           }

        });

      
      });
} );
</script>
    
               
                
                
                
                
            