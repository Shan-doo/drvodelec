@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center text-muted">Pretplatnici</h1>
@stop

@section('content')
    <p class="text-center">Ovde možete pregledati i upravljati pretplatnicima.</p>

    <div id="subscribers">

    	@include('admin.partials.subscribers-table')

    </div>
@stop

@section('css')

<style type="text/css">
    
    #subscribers_table tbody tr td {

        cursor: pointer;


    }

    #subscribers_table tbody tr td:hover {

        color: red;
    }

</style>



@stop

@section('js')

    <script>

    $(document).ready(function(){

        var $subscribersTable = $('#subscribers_table').DataTable({
            ajax: '/admin/subscribers',
            dataSrc: '',
            columns: [
                { data: 'id' },
                { data: 'email' },
                { data: 'status', 'render': function(data, type, full, meta){

                        return data == 1 ? 'subscribed' : 'unsubscribed';

                    } 
                },
                { data: 'created_at' },
                { data: 'updated_at' },
                { data: '', 'render': function(data, type, full, meta) {

                    return full.status == 1 ? '<input type="checkbox" checked="checked">' : '<input type="checkbox">';

                    } 
                },
                { data: '', 'render': function() {

                    return '<button class="btn btn-default" href=""><i class="fa fa-trash-o" aria-hidden="true"></i></button>';

                    } 
                }
            ]
        });

        $subscribersTable.on('draw', function () {
            // thank you jquery event namespacing :)
            $($(this).find('tbody tr td')).off('click.table').bind('click.table', function(e){
                /*alert(e.target.innerHTML);*/
            })
        });

        /*ajax call to toggle subscription*/

       
    });

    </script>

@stop