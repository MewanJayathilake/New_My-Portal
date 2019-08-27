// Side Menu View and Hide
$(document).ready(function(){
	$("#side-menu-btn").click(function(){
		$("#side-menu").toggleClass("close");
	});
});
// End Side Menu View and Hide

// Date Picker
$( function() {
	//$( "#datepicker" ).datepicker();
	 $( "#datepicker" ).datepicker({
       //dateFormat: "yy-mm-dd",
        minDate: +1,
       });
	$( "#anim" ).on( "change", function() {
		$( "#datepicker" ).datepicker( "option", "showAnim", $( this ).val() );
	});
 $( "#start_date" ).datepicker({
       //dateFormat: "yy-mm-dd",
        minDate: +1,
       });
	$( "#anim" ).on( "change", function() {
		$( "#start_date" ).datepicker( "option", "showAnim", $( this ).val() );
	});
	 $( "#start_date_2" ).datepicker({
       //dateFormat: "yy-mm-dd",
        minDate: +1,
       });
	$( "#anim" ).on( "change", function() {
		$( "#start_date_2" ).datepicker( "option", "showAnim", $( this ).val() );
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

// loader
setTimeout(function(){
    $('.page-loder').fadeOut('slow'); 
	$('.pre-back').fadeOut('slow');
}, 2500);
// End loader

//Tooltip
$( function() {
    $( document ).tooltip();
  } );
// End Tooltip

$(function () {
  $('#select').multipleSelect({
    width: 500
  })
});