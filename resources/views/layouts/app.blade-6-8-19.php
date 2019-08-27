<!DOCTYPE html>
   <html lang="{{ app()->getLocale() }}">
    <head>
       <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8" />
        <title>App</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

       
    </head>


    <body>

 <style>
  label {
    display: inline-block;
    width: 5em;
  }
  </style>
  
  
      <!-- content-->
      @yield('content')


             <!-- End content-->


        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        &copy; <?php echo date("Y"); ?> Powered by <a href="http://www.230i.com" target="_blank">230 Interactive.</a>
                    </div>
                </div>
            </div>
        </footer> 
        <!-- End Footer -->


     <!-- jQuery  -->
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>


<script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

<script>
    $(document).ready(function() {
        $('#table_id').DataTable();
    } );
</script>



 <script type="text/javascript">

    $( function() {
   
     $( "#startdate" ).datepicker({
       dateFormat: "yy-mm-dd",
        minDate: +1,
       
    });
      });
 </script>
 <script>
  $( function() {
    $( document ).tooltip();
  } );
  </script>

  <script>

$(document).ready(function () {

$("#ChkSubmit").click(function(){

 // set the varibles
    var courseid = $("#courseid").val(); 
    var startdate = $("#startdate").val(); 
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
});
</script>






 
    

  
       
    
      
       
    </body>
    
</html>
