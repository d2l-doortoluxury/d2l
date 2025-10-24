@extends('layouts.user', ['header' => true, 'nav' => true, 'demo' => true, 'settings' => $settings])

{{-- Custom CSS --}}
@section('css')
<style>
    .visitors-card {
        height: 450px !important;
    }
</style>
@endsection

@section('content')
<div class="page-wrapper">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        {{ __('Overview') }}
                    </div>
                    <h2 class="page-title">
                        {{ __('Dashboard') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page title -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row mb-3">
                <div class="col-sm-12 col-lg-12">
                    <div class="row row-deck row-cards">
                        {{-- Current plan --}}
                        <div class="col-sm-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="subheader">{{ __('Current Plan') }}</div>
                                    </div>
                                    @if ($active_plan->plan_price == 0)
                                    <div class="h1">{{ __($active_plan->plan_name) }}</div>
                                    <p>{{ __('FREE PLAN') }}</p>
                                    @else
                                    <h1 class="text-uppercase"><b>{{ __($active_plan->plan_name) }}</b></h1>
                                    @endif
                                    <a href="{{ route('user.plans') }}">
                                        {{ __('Show details') }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Business cards --}}
                        <div class="col-sm-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="subheader">{{ __('Business Cards') }}</div>
                                    </div>
                                    <div class="h1">{{ $business_card == 999 ? __('Unlimited') : $business_card }}</div>
                                    <a href="{{ route('user.cards') }}">
                                        {{ __('Show details') }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Remaining datas --}}
                        <div class="col-sm-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="subheader">{{ __('Remaining Days') }}</div>
                                    </div>

                                    @if ($active_plan->validity == 9999)
                                    <p class="h1">{{ __('Lifetime') }}</p>
                                    @else
                                    <p class="h1">{{ $remaining_days > 0 ? $remaining_days : __('Plan Expired!') }}</p>
                                    @endif

                                    <a href="{{ route('user.plans') }}">
                                        {{ __('Show details') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-8 col-lg-8 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="subheader mb-2">{{ __('Overview') }}</div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div id="cards"></div>
                                </div>
                                <div class="col-md-auto">
                                    <div class="divide-y divide-y-fill">
                                        <div></div>
                                        <div class="px-3">
                                            <div>
                                                <span class="status-dot bg-orange"></span> {{ __('vCards') }}
                                            </div>
                                            <div class="h2">{{ $totalvCards }}</div>
                                        </div>
                                        <div class="px-3">
                                            <div>
                                                <span class="status-dot bg-green"></span> {{ __('Stores') }}
                                            </div>
                                            <div class="h2">{{ $totalStores }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Platforms --}}
                <div class="col-md-4 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            {{-- Title --}}
                            <div class="d-flex align-items-center mb-3">
                                <div class="subheader mb-2">{{ __('Platforms') }}</div>
                            </div>
                            <div id="platforms"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-5 col-xl-5">
                    <div class="card">
                        <div class="card-header">
                            <div class="subheader">{{ __('This week\'s audience of cards') }}</div>
                        </div>
                        <div class="card-body">
                            <div id="thisWeekAudience"></div>
                        </div>
                    </div>
                </div>
                {{-- Devices --}}
                <div class="col-md-4 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            {{-- Title --}}
                            <div class="d-flex align-items-center mb-3">
                                <div class="subheader mb-2">{{ __('Devices') }}</div>
                            </div>
                            <div id="devices"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-lg-3 mb-2">
                    <div class="card visitors-card">
                        <div class="card-header">
                            <div class="subheader">{{ __('Top 10 Most Viewed Cards') }}</div>
                        </div>
                        <div class="card-table table-responsive">
                            <table class="table table-vcenter">
                                <thead>
                                    <tr>
                                        <th>{{ __('Card name') }}</th>
                                        <th>{{ __('Visitors') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Top 10 Cards --}}
                                    @foreach ($highestCards as $highestCard)
                                    <tr>
                                        <td>
                                            <a href="{{ url($highestCard['card']) }}" target="_blank">
                                                <span
                                                    style="width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: block">/{{
                                                    $highestCard['card'] }}
                                            </a>
                                            </span>
                                        </td>
                                        <td><strong>{{ $highestCard['count'] }}</strong></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('user.includes.footer')
</div>

{{-- Custom JS --}}
@section('scripts')
<script src="{{ asset('backend/js/apexcharts.min.js') }}"></script>
<script>
    // Overview
    // @formatter:off
	document.addEventListener("DOMContentLoaded", function () {
		window.ApexCharts && (new ApexCharts(document.getElementById('cards'), {
			chart: {
				type: "line",
				fontFamily: 'inherit',
				height: 212,
				parentHeightOffset: 0,
				toolbar: {
					show: false,
				},
				animations: {
					enabled: false
				},
			},
			fill: {
				opacity: 1,
			},
			stroke: {
				width: 2,
				lineCap: "round",
				curve: "smooth",
			},
			series: [{
				name: `{{ __("vCards") }}`,
				data: [{{ $vcards }}]
			},{
				name: `{{ __("Stores") }}`,
				data: [{{ $stores }}]
			}],
			tooltip: {
				theme: 'dark'
			},
			grid: {
				padding: {
					top: -20,
					right: 0,
					left: -4,
					bottom: -4
				},
				strokeDashArray: 4,
			},
			xaxis: {
				labels: {
					padding: 0,
				},
				tooltip: {
					enabled: false
				},
				type: 'year',
			},
			yaxis: {
				labels: {
					padding: 4,
				},
			},
			labels: [`{{ __('Jan') }}`, `{{ __('Feb') }}`, `{{ __('Mar') }}`, `{{ __('Apr') }}`, `{{ __('May') }}`, `{{ __('Jun') }}`, `{{ __('July') }}`, `{{ __('Aug') }}`, `{{ __('Sept') }}`, `{{ __('Oct') }}`, `{{ __('Nov') }}`, `{{ __('Dec') }}`],
			colors: ["#F76707", "#2FB344"],
			legend: {
				show: false,
			},
		})).render();
	});
	// @formatter:on

    // Platforms
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function () {
      	window.ApexCharts && (new ApexCharts(document.getElementById('platforms'), {
      		chart: {
      			type: "donut",
      			fontFamily: 'inherit',
      			height: 250,
      			sparkline: {
      				enabled: true
      			},
      			animations: {
      				enabled: false
      			},
      		},
      		fill: {
      			opacity: 1,
      		},
      		series: {!! json_encode($highestPlatforms['count']) !!},
      		labels: {!! json_encode($highestPlatforms['platform']) !!},
      		tooltip: {
      			theme: 'dark'
      		},
      		grid: {
      			strokeDashArray: 4,
      		},
      		colors: ["#4263eb", "#f76707", "#330902", "#1092a3", "#ed023d", "#007a0c", "#db25db"],
      		legend: {
      			show: true,
      			position: 'bottom',
      			offsetY: 12,
      			markers: {
      				width: 10,
      				height: 10,
      				radius: 100,
      			},
      			itemMargin: {
      				horizontal: 8,
      				vertical: 8
      			},
      		},
      		tooltip: {
      			fillSeriesColor: false
      		},
      	})).render();
    });
    // @formatter:on

    // This Week Audience
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function () {
      	window.ApexCharts && (new ApexCharts(document.getElementById('thisWeekAudience'), {
      		chart: {
      			type: "area",
      			fontFamily: 'inherit',
      			height: 355,
      			parentHeightOffset: 0,
      			toolbar: {
      				show: false,
      			},
      			animations: {
      				enabled: false
      			},
      			stacked: true,
      		},
      		dataLabels: {
      			enabled: false,
      		},
      		fill: {
      			opacity: .16,
      			type: 'solid'
      		},
      		stroke: {
      			width: 2,
      			lineCap: "round",
      			curve: "smooth",
      		},
      		series: [{
      			name: "{{ __('vCard') }}",
      			data: {!! json_encode($currentWeekVisitors['vcard']) !!}
      		},{
      			name: "{{ __('Store') }}",
      			data: {!! json_encode($currentWeekVisitors['store']) !!}
      		}],
      		tooltip: {
      			theme: 'dark'
      		},
      		grid: {
      			padding: {
      				top: -20,
      				right: 0,
      				left: -4,
      				bottom: -4
      			},
      			strokeDashArray: 4,
      		},
      		xaxis: {
      			labels: {
      				padding: 0,
      			},
      			tooltip: {
      				enabled: false
      			},
      			axisBorder: {
      				show: false,
      			},
      			categories: [`{{ __('Monday') }}`, `{{ __('Tuesday') }}`, `{{ __('Wednesday') }}`, `{{ __('Thursday') }}`, `{{ __('Friday') }}`, `{{ __('Saturday ') }}`, `{{ __('Sunday') }}`],
      		},
      		yaxis: {
      			labels: {
      				padding: 4
      			},
      		},
      		colors: ["#4263eb", "#f76707"],
      		legend: {
      			show: false,
      		},
      	})).render();
      });
      // @formatter:on

      // Devices
      // @formatter:off
    document.addEventListener("DOMContentLoaded", function () {
      	window.ApexCharts && (new ApexCharts(document.getElementById('devices'), {
      		chart: {
      			type: "donut",
      			fontFamily: 'inherit',
      			height: 410,
      			sparkline: {
      				enabled: true
      			},
      			animations: {
      				enabled: false
      			},
      		},
      		fill: {
      			opacity: 1,
      		},
      		series: {!! json_encode($highestDevices['count']) !!},
      		labels: {!! json_encode($highestDevices['device']) !!},
      		tooltip: {
      			theme: 'dark'
      		},
      		grid: {
      			strokeDashArray: 4,
      		},
      		colors: ["#4263eb", "#f76707", "#330902", "#1092a3", "#ed023d", "#007a0c", "#db25db"],
      		legend: {
      			show: true,
      			position: 'bottom',
      			offsetY: 12,
      			markers: {
      				width: 10,
      				height: 10,
      				radius: 100,
      			},
      			itemMargin: {
      				horizontal: 8,
      				vertical: 8
      			},
      		},
      		tooltip: {
      			fillSeriesColor: false
      		},
      	})).render();
    });
    // @formatter:on
</script>
@endsection
@endsection