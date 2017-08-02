	@extends('adminlte::page')

	@section('title', 'Dashboard')

	@section('content_header')
	<h1>Dashboard</h1>
	@stop

	@section('content')
	<p>Welcome to users.</p>

		<div id="users">
			
			@include('admin.partials.users-table')

		</div>
	
	@stop

	@section('css')
	<link rel="stylesheet" href="/css/admin_custom.css">
	@stop

	@section('js')
	<script> 

		$(document).ready(function(){

        $('#users_table').DataTable({
            ajax: '/admin/users',
            dataSrc: '',
            columns: [
                { data: 'id' },
                { data: 'username', 'render': function(data, type, full, meta){
                		
                		return '<a href="users/' + data + '">' + data + '</a>'; 
                	} 
            	},
                { data: 'email' },
                { data: 'role_id', 'render': function(data, type, full, meta){

                		return getRole(data);
                } },
                { data: 'last_login' },
                { data: 'created_at' },
                { data: 'updated_at' }
            ]
        });

        function getRole(role_id) {

        	if (role_id == 1) {

				return 'user';
			} 

			if(role_id == 2) {

				return 'admin';
			} 

			if(role_id = 3) {

				return 'superadmin';
			}
        }
    });

	</script>
	@stop