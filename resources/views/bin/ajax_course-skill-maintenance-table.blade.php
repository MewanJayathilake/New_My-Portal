
   <!-- Data Table Section -->
              <div class="table-main">
                <table id="datatable" class="display table is-bordered is-striped is-narrow is-hoverable" style="width:100%">
                  <thead>
                    <tr>
                      <th>Instance ID</th>
                      <th>Course Type</th>
                        <th>Audience</th>
                        <th>Location</th>
                      <th>Start Date</th>
                     <th>Entrolments / Available</th>
                      <th>Actions</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @for($i=0; $i < count($get_course_details); $i++)
                 <tr>
                  <th>{{$get_course_details[$i]->INSTANCEID}}</th>
                      <th>{{$get_course_details[$i]->NAME}}</th>
                        <th>Audience</th>
                        <th>{{$get_course_details[$i]->LOCATION}}</th>
                      <th>{{date("d-M-Y ", strtotime($get_course_details[$i]->STARTDATE))}}</th>
                     <th>Entrolments / Available</th>
                      <th>Actions</th>
                      <th>Status</th>
                  </tr>
                  @endfor
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Instance ID</th>
                      <th>Course Type</th>
                        <th>Audience</th>
                        <th>Location</th>
                      <th>Start Date</th>
                     <th>Entrolments / Available</th>
                      <th>Actions</th>
                      <th>Status</th>
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

        var INSTANCEID = $(this).attr("INSTANCEID");
        var type =$(this).attr("typeid");
        var contactID = 4772088;
      
      });
    
} );
</script>
    
               
                
                
                
                
            