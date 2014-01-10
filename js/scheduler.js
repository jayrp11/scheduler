$(document).ready(function() {
	$('#schedule-date input, #schedule-date input-group-addon').datepicker({
		format: "yyyy-mm-dd",
		autoclose: true,
	});
	
	$('.body').on('click', ".del-sub", function(e) {
		$(this).closest(".sub-form").remove();
	});
	
	$('.body').on('click', ".del-res", function(e) {
		$(this).closest(".resource").remove();
	});
});