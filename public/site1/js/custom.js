// Side Menu View and Hide
$(document).ready(function(){
	$("#side-menu-btn").click(function(){
		$("#side-menu").toggleClass("close");
	});

$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});
});
// End Side Menu View and Hide

// Date Picker
$( function() {
	//$( "#datepicker" ).datepicker();
	 $( "#datepicker" ).datepicker({
       dateFormat: "yy-mm-dd",
        minDate: +1,
       
    });
	$( "#anim" ).on( "change", function() {
		$( "#datepicker" ).datepicker( "option", "showAnim", $( this ).val() );
	});
} );
// End Date Picker

// DataTable

// End DataTable

// Collapse
$(document).ready(function(){

	$(".toggle-icon").click(function(){
		$(this).parents(".toggle-main").toggleClass("open");
	});

});
// End Collapse

// Tabs
  $( function() {
    $( "#tabs" ).tabs();
  } );
// End Tabs