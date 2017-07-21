@extends('admin.index')

@section('admin-page')
	
	<div class="container">
		
		<div class="row">
			
			<div class="col-md-12">
				
				<div id="newsAjax">
		
					

				</div>

			</div>

		</div>

	</div>

	<script src="/js/admin.js"></script>

	<script type="text/javascript">
		
		$(document).ready(function() {

			$('#account').click(toggleNavDropdown);

			$('html').click(hideDropdown);
		

		});

	</script>

@endsection