@extends(Config::get('routing.application.modules.dashboard.employee.layout').'.structure.index')

@section('main-content')

<!-- summary -->
<section class="features-area py-5">

  <!-- container -->
	<div class="container">

		<!-- columns -->
		<div class="columns is-multiline is-desktop is-justify-content-center">

			{{-- Panel Sidebar --}}
			@include(Config::get('routing.application.modules.dashboard.employee.layout').'.navigation.panel.index')

			<!-- columns -->
      <div class="column is-8-desktop mb-5 sidebar-home">

				<!-- total user -->
				<div class="columns">

					<div class="column is-full">
						<div class="widget widget-about">
							<h3 class="has-text-left">Total Overall User</h3>

							<div class="columns">

								<div class="column is-half pricing-item">
			            <div class="card shadow-none rounded-0">
			             <h3>Employee</h3>
			             <p</p>
			             <div class="price has-text-center">
			              <h2 class="h1">{{ (($data['employee']['total']['registered']['overall'])?$data['employee']['total']['registered']['overall']->total:0) }}</h2>
			             </div>
			            </div>
			         	</div>

								 <div class="column is-half pricing-item">
			             <div class="card shadow-none rounded-0">
			              <h3>Customer</h3>
			              <div class="price has-text-center">
			               <h2 class="h1">{{ (($data['customer']['total']['registered']['overall'])?$data['customer']['total']['registered']['overall']->total:0) }}</h2>
			              </div>
			             </div>
			          </div>

							</div>

						</div>

						<div class="widget widget-about">
							<h3 class="has-text-left">Total User this Month</h3>

							<div class="columns">

								<div class="column is-half pricing-item">
			            <div class="card shadow-none rounded-0">
			             <h3>Employee</h3>
			             <p</p>
			             <div class="price has-text-center">
			              <h2 class="h1">{{ (($data['employee']['total']['registered']['this_month'])?$data['employee']['total']['registered']['this_month']->total:0) }}</h2>
			             </div>
			            </div>
			         	</div>

								 <div class="column is-half pricing-item">
			             <div class="card shadow-none rounded-0">
			              <h3>Customer</h3>
			              <div class="price has-text-center">
			               <h2 class="h1">{{ (($data['customer']['total']['registered']['this_month'])?$data['customer']['total']['registered']['this_month']->total:0) }}</h2>
			              </div>
			             </div>
			          </div>

							</div>

						</div>

						<div class="widget widget-about">
							<h3 class="has-text-left">Total Booked this Year</h3>

							<div class="columns">

								<div class="column is-full pricing-item">
			            <div class="card shadow-none rounded-0">

			             <p></p>
			             <div class="price has-text-center">
										 <canvas id="chart_report_annual_booked" width="400" height="200"></canvas>
			             </div>
			            </div>
			         	</div>

							</div>

						</div>

						<div class="widget widget-about">
							<h3 class="has-text-left">Total Profit this Year</h3>

							<div class="columns">

								<div class="column is-full pricing-item">
			            <div class="card shadow-none rounded-0">

			             <p></p>
			             <div class="price has-text-center">
										 <canvas id="chart_report_annual_price" width="400" height="200"></canvas>
			             </div>
			            </div>
			         	</div>

							</div>

						</div>
					</div>

				</div>
				<!-- end total user -->

			</div>
			<!-- columns -->

    </div>
		<!-- end columns -->

	</div>
  <!-- end container -->


</section>
<!-- end summary -->



@include(Config::get('routing.application.modules.landing.dcs.layout').'.plugins.chartjs.index')

<script>
// Parse the PHP data passed from the controller
var data_report_annual_booked = @json($data['report']['annual']['booked']);

// Extract months and totals for labels and data
var months_report_annual_booked = data_report_annual_booked.map(function(entry) {
    return entry.months;
});

var totals_report_annual_booked = data_report_annual_booked.map(function(entry) {
    return entry.total;
});

// Create a bar chart
var ctx_report_annual_booked = document.getElementById('chart_report_annual_booked').getContext('2d');
var chart_report_annual_booked = new Chart(ctx_report_annual_booked, {
    type: 'bar',
    data: {
        labels: months_report_annual_booked,
        datasets: [{
            label: 'Total',
            data: totals_report_annual_booked,
            backgroundColor: 'rgba(75, 192, 192, 0.2)', // Set your desired color
            borderColor: 'rgba(75, 192, 192, 1)', // Set your desired border color
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});



var data_report_annual_price = @json($data['report']['annual']['price']);

// Extract months and totals for labels and data
var months_report_annual_price = data_report_annual_price.map(function(entry) {
    return entry.months;
});

var totals_report_annual_price = data_report_annual_price.map(function(entry) {
    return entry.total_price;
});

// Create a bar chart
var ctx_report_annual_price = document.getElementById('chart_report_annual_price').getContext('2d');
var chart_report_annual_price = new Chart(ctx_report_annual_price, {
    type: 'bar',
    data: {
        labels: months_report_annual_price,
        datasets: [{
            label: 'Total',
            data: totals_report_annual_price,
            backgroundColor: 'rgba(75, 192, 192, 0.2)', // Set your desired color
            borderColor: 'rgba(75, 192, 192, 1)', // Set your desired border color
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>


@endsection
