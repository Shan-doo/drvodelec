@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to news.</p>

    <div id="news">
    	@include('admin.partials.news-table')
    </div>
@stop

@section('css')
    <style type="text/css">
    	
    	.deleteNews i {

    		color: #DD4B39;
    	}

    </style>
@stop

@section('js')

    <script>

    	$(document).ready(function(){

    		// attach csrf token to each ajax request
			$.ajaxSetup({

			headers: {
			    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});

	        var $newsTable = $('#news_table').DataTable({
	            ajax: '/admin/news',
	            dataSrc: '',
	            columns: [
	                { data: 'id' },
	                { data: 'title', 'render': function(data, type, full, meta) {
	                	
	                	return '<a href="news/' + full.slug + '">' + data + '</a>';

	                	} 
	            	},
	                { data: 'user_id' },
	                { data: 'created_at' },
	                { data: 'updated_at' },
	                { data: '', 'render': function(data, type, full, meta) {

	                	return '<a class="btn btn-default editNews" href="/admin/news/' + full.slug + '/edit/"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

	                	} 
	            	},
	                { data: '', 'render': function(data, type, full, meta) {

	                	return '<button class="btn btn-default deleteNews" data-news-id="' + full.slug + '" href=""><i class="fa fa-trash-o" aria-hidden="true"></i></button>';

	                	} 
	            	}
	            ]
	        });

	        $newsTable.on('draw', function () {
	            // thank you jquery event namespacing :)
	            $($(this).find('tbody tr td .deleteNews')).off('click.table').bind('click.table', function(e){

	                deleteNews($(this).data('newsId'));

	                $newsTable
				        .row( $(this).parents('tr') )
				        .remove()
				        .draw();
	            });

	        });

	        function deleteNews(id) {

				$.ajax({		
				url: '/admin/news/' + id,
				type: 'DELETE',
				cache: false,
				processData: false, 
				contentType: false,
				})
				.done(function(response) {
					console.log(response)
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					/*console.log("complete");*/
				});

			}

	        /*ajax call to toggle subscription*/

	       
	    });

    </script>

@stop