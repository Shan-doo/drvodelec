@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 class="text-center">Pretplatnici</h1>
@stop

@section('content')

<p class="text-center">Ovde mozete pratiti statistiku pretplatnika.</p>

<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Pretplatnici u zadnjih 12 meseci</h3>
    <div class="row">
      <div class="col-md-6">
        <select id="selectYearSubs" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">

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
    <div id="barChartLoader" class="overlay" style="display: none;">
      <i class="fa fa-refresh fa-spin"></i>
    </div>
    <canvas id="barChartSubs" style="height: 323px; width: 647px;" width="647" height="323"></canvas>
  </div>
  <!-- /.box-body -->
</div>

<div class="box box-primary">

  <div class="box-header with-border">

    <h3 class="box-title">Aktivni i Neaktivni Pretplatnici</h3>

    <div class="box-tools pull-right">

      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>

    </div>

  </div>

  <div class="box-body pad">

    <div id="pieChartLoader" class="overlay" style="display: none;">
      <i class="fa fa-refresh fa-spin"></i>
    </div>

    <canvas id="pieChartSubs" style="height: 323px; width: 647px;" width="647" height="323"></canvas>

  </div>

</div>

@stop

@section('css')

@stop

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>

<script type="text/javascript">

  $(document).ready(function() {

    // ne radi
    $('#refreshChartsData').click(loadBarChartData);

    /*select2*/
    $('#selectYearSubs').select2();

    loadBarChartData();

    loadPieChartData();

    var selectYears = $('select'),
    responseData,
    bar = document.getElementById("barChartSubs").getContext('2d'),
    pie = document.getElementById("pieChartSubs").getContext('2d'),
    barChartData = {
      type: 'bar',
      data: {

        datasets: [{
          label: '# of Subscribers',

          backgroundColor: [
          '#092360',
          '#1369A2',
          '#0099A9',
          '#009780',
          '#67B784',
          '#CBDF7C',
          '#FFE200',
          '#DB9815',
          '#E57B25',
          '#F0522D',
          '#912E0F',
          '#33004B'
          ],
          borderColor: [
          '#092360',
          '#1369A2',
          '#0099A9',
          '#009780',
          '#67B784',
          '#CBDF7C',
          '#FFE200',
          '#DB9815',
          '#E57B25',
          '#F0522D',
          '#912E0F',
          '#33004B'
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero:true
            }
          }]
        }
      }
    },
    BarChart = new Chart(bar, barChartData);

    function getYears(response) {

      return response.years.filter(function(item, index) {

        return item.year;
      }).map(function(item, index) {

        return item.year;
      })
    }

    function getMonths(response, year) {

      return response.data.filter(function(item, index) {

        if (item.year == year) {

          return item;
        }

      }).map(function(item, index) {

       return item.month;
     });
      
    };

    function getMonthlyData(response, year) {

      return response.data.filter(function(item, index) {

        if (item.year == year) {

          return item;
        }

      }).map(function(item, index) {

       return item.number_of_subscribers;

     });

    };

    function loadBarChartData() {

      $('#barChartLoader').fadeIn();

      $.ajax({

        url: '/admin/subscribers/stats',
        type: 'GET',
        dataType: 'json',
        data: { chart: 'bar' },
      })
      .done(function(response) {

        $('#barChartLoader').fadeOut();

        var years = getYears(response);

        var selectOptions = $('#selectYearSubs > option');

        if (!selectOptions.length) {

          selectYears.empty();

          for (var i = 0; i < years.length; i++) {

            selectYears.append('<option>' + years[i] + '</option>')
          }

        }

        var selectedYear = $('#selectYearSubs > option:selected').text()

        responseData = response;

        buildChart(response, selectedYear);

        $('#selectYearSubs').change(function() {

          buildChart(response, $(this).val());

        });

      })
    };

    function buildChart(response, year) {

      var months = getMonths(response, year);
      var subscribers = getMonthlyData(response, year);

      BarChart.chart.data.datasets[0].data = subscribers
      BarChart.chart.data.labels = months
      BarChart.chart.update();
    }

    function loadPieChartData() {

      $('#pieChartLoader').fadeIn();

      $.ajax({
        url: '/admin/subscribers/stats',
        type: 'GET',
        dataType: 'json',
        data: {chart: 'pie'}
      })
      .done(function(response) {

        $('#pieChartLoader').fadeOut();

        var PieChart = new Chart(pie,{
          type: 'pie',
          data: data = {
            labels: [
            'Subscribed',
            'Unsubscribed',
            ],
            datasets: [{
              data: response,
              backgroundColor: [
              '#092360',
              '#1369A2',
              '#0099A9',
              ],
              borderColor: [
              '#092360',
              '#1369A2',
              '#0099A9',
              ],

            }],
          },
        })

      }).fail(function() {
        console.log("error");

      });

    };


  });



</script>


@stop