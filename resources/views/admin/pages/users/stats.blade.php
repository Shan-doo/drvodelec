@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 class="text-center">Korisnici</h1>
@stop

@section('content')

<p class="text-center">Ovde mozete pratiti statistiku korisnika.</p>

<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Korisnici u zadnjih 12 meseci</h3>
    <div class="row">
      <div class="col-md-6">
        <select id="selectYearUsers" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">

        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <a id="refreshChartsData" class="btn">
          <i class="fa fa-repeat"></i> Osveži
        </a>
      </div>
    </div>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>

  </div>
  <div class="box-body">
    <canvas id="barChartUsers" style="height: 323px; width: 647px;" width="647" height="323"></canvas>
  </div>
  <!-- /.box-body -->
</div>

<!-- <div class="box box-primary">

  <div class="box-header with-border">

    <h3 class="box-title">Aktivni i Neaktivni Pretplatnici</h3>

    <div class="box-tools pull-right">

      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>

    </div>

  </div>

  <div class="box-body">

    <canvas id="pieChartSubs" style="height: 323px; width: 647px;" width="647" height="323"></canvas>

  </div>

</div> -->

@stop

@section('css')

@stop

@section('js')



@stop