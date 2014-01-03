$(document).ready(function() {
	$('#schedule-date').datepicker({
		format: "yyyy-mm-dd",
		calendarWeeks: true
	});
	
	
	$('.body').on('click', ".del-sub", function(e) {
		$(this).closest(".sub-form").remove();
	});
	
	$('.body').on('click', ".del-res", function(e) {
		$(this).closest(".resource").remove();
	});
});