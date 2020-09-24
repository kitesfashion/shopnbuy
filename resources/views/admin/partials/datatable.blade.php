{{-- Data table --}}
 <script>
        $(document).ready(function() {
            var updateThis ;

            // Switchery
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function() {
                new Switchery($(this)[0], $(this).data());
            });

            var table = $('.datatable').DataTable( {
                "orderable": false,
                "pageLength": 25,
            } );
            table.on( 'order.dt search.dt', function () {
	            table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
	                cell.innerHTML = i+1;
	            } );
	        } ).draw();

        });
                
</script>