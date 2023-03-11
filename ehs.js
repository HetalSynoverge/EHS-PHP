$.datepicker.setDefaults({
showOn: "button",
buttonImage: "datepicker.png",
buttonText: "Date Picker",
buttonImageOnly: true,
dateFormat: 'dd-mm-yy'  
});


$(function() {
$('#post_at').datepicker({
	dateFormat: "dd-M-yy",
});
$('#post_at_to_date').datepicker({
	dateFormat: "dd-M-yy",
});
$('#post_at_for_date').datepicker({
	dateFormat: "dd-M-yy",
});
});

$('#post_at').datepicker({
	dateFormat: "dd-M-yy",
            onSelect: function(dateText,inst){
				$('#post_at_to_date').datepicker('option','minDate',new Date(dateText));
				$('#post_at_for_date').datepicker('option','minDate',new Date(dateText));
            }
        });