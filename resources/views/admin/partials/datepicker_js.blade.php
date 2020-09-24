<script>
	$( function() {
		$( ".add_datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd-mm-yy',
		}).datepicker('setDate', 'today');

		$( ".add_birth_datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd-mm-yy',
			yearRange: '1970:'+(new Date).getFullYear(),
		}).datepicker('setDate', 'today');

		$( "edit_birth_datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd-mm-yy',
			yearRange: '1970:'+(new Date).getFullYear(),
		});

		$( ".add_birth_datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd-mm-yy',
			yearRange: '1970:'+(new Date).getFullYear(),
		}).datepicker('setDate', 'today');

		var date = new Date();
		var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
		// var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);

		$("#from_date").datepicker({ dateFormat: 'dd-mm-yy' });
		$("#from_date").datepicker("setDate", firstDay);

		$("#to_date").datepicker({ dateFormat: 'dd-mm-yy' });
		$("#to_date").datepicker("setDate", 'today');

		$(".datepicker").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd-mm-yy',
		});
	} );
</script>