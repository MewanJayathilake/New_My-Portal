
   <!-- Data Table Section -->
              <div class="table-main">
                <table id="datatable" class="display table is-bordered is-striped is-narrow is-hoverable" style="width:100%">
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
                     @for($i=0; $i< count($get_course_details); $i++)
    <?php 

$data_array['contactID'] = 6536706;
$data_array['instanceID'] = $get_course_details[$i]->INSTANCEID;
$data_array['TYPE'] = $get_course_details[$i]->TYPE;

 try {
        // posting request value to api
   $enrolment = $client->request('PUT', 'course/enrolment',[
       'form_params' => $data_array,
       'headers' => ['apitoken' => $AXL_api_token,
       'wstoken' => $AXL_ws_token,]
        ]);

    // encode the results 
        $get_enrolment_details = json_decode($enrolment->getBody());
        $msg = $get_enrolment_details['MSG']; 

}
// error response
catch (\Exception $ex) {
   $response = $ex->getResponse();   
$responseBodyAsString = json_decode($response->getBody()->getContents(), true);
$msg = $responseBodyAsString['MESSAGES'];


}


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
                      <td>{{$get_course_details[$i]->NAME}}</td>
                      <td>{{date("d-M-Y ", strtotime($get_course_details[$i]->STARTDATE))}}</td>
                        <?php 
                        $comdate = array();

                        foreach($get_course_details[$i]->COMPLEXDATES as $list)
                        {
                        $comdate[] = $list->DATE.'=>'.$list->STARTTIME.'=>'.$list->ENDTIME;
                        }

                        $complexdate_array =  implode(" ",$comdate);

                        ?>
                      <td>
                        <a class="button inactive-btn small-btn" title="{{$complexdate_array}}">
                          <span>More</span>
                          <span class="icon is-small">
                            <i class="fas fa-caret-right"></i>
                          </span>
                        </a>
                      </td>
                      <td>{{$get_course_details[$i]->LOCATION}}</td>
                      <td>{{$delivery_type}}</td>
                      <td>{{$get_course_details[$i]->PARTICIPANTS}}/{{$get_course_details[$i]->MAXPARTICIPANTS}}</td>
                      <td>
                        <a class="button selected-btn small-btn entrolment" href="#help-modal{{$i}}" rel="modal:open" data-bean-id="{{$i}}" typeid = {{$delivery_type}} INSTANCEID="{{$get_course_details[$i]->INSTANCEID}}">
                          <span>Enrol</span>
                          <span class="icon is-small">
                            <i class="fas fa-caret-right"></i>
                          </span>
                        </a>
                      </td>
                    </tr>

    <div id="help-modal{{$i}}" class="modal">
      <p class="txt-center">{{$msg}}</p>
     </div>
                    @endfor
                  </tbody>
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

        var INSTANCEID = $(this).attr("INSTANCEID");
        var type =$(this).attr("typeid");
        var contactID = 4772088;
      
      });
    
} );
</script>
    
               
                
                
                
                
            