@extends('kerangka.master')
@section('title', 'Dashboard')
@section('content')
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <!-- Temperature Card -->
                <div class="col-6 col-lg-3 col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <div class="stats-icon purple">
                                    <i class="iconly-boldShow"></i>
                                </div>
                            </div>
                            <div>
                                <h6 class="text-muted font-semibold">Temperature</h6>
                                <h6 class="font-extrabold mb-0">
                                    @if ($latestSensorData)
                                        {{ $latestSensorData->temperature . '°C' }}
                                    @else
                                        16 °C
                                    @endif
                                </h6>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 50%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Humidity Card -->
                <div class="col-6 col-lg-3 col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <div class="stats-icon blue">
                                    <i class="iconly-boldProfile"></i>
                                </div>
                            </div>
                            <div>
                                <h6 class="text-muted font-semibold">Humidity</h6>
                                <h6 class="font-extrabold mb-0">
                                    @if ($latestSensorData)
                                        {{ $latestSensorData->humidity . '%' }}
                                    @else
                                        24 %
                                    @endif
                                </h6>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Light Intensity Card -->
                <div class="col-6 col-lg-3 col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <div class="stats-icon yellow">
                                    <i class="iconly-boldAdd-User"></i>
                                </div>
                            </div>
                            <div>
                                <h6 class="text-muted font-semibold">Light Intensity</h6>
                                <h6 class="font-extrabold mb-0">
                                    @if ($latestSensorData)
                                        {{ $latestSensorData->ldrValue . ' lux' }}
                                    @else
                                        28
                                    @endif
                                </h6>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 10%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Heater Status Card -->
                <div class="col-6 col-lg-3 col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <div class="stats-icon purple">
                                    <i class="iconly-boldBookmark"></i>
                                </div>
                            </div>
                            <div>
                                <h6 class="text-muted font-semibold">Heater Status</h6>
                                <h6 class="font-extrabold mb-0">
                                    @if ($controlSettings && isset($controlSettings['heater']['heaterStatus']))
                                        {{ $controlSettings['heater']['heaterStatus'] == 'on' ? 'ON' : 'OFF' }}
                                    @else
                                        ON
                                    @endif
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Lamp Status Card -->
                <div class="col-6 col-lg-3 col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <div class="stats-icon purple">
                                    <i class="iconly-boldBookmark"></i>
                                </div>
                            </div>
                            <div>
                                <h6 class="text-muted font-semibold">Lamp Status</h6>
                                <h6 class="font-extrabold mb-0">
                                    @if ($controlSettings && isset($controlSettings['lamp']['mode']))
                                        {{ $controlSettings['lamp']['mode'] == 'automatic' ? 'Automatic' : 'Manual' }}
                                    @else
                                        ON
                                    @endif
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sensor Statistics -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Sensor Statistics</h4>
                        </div>
                        <div class="card-body">
                            <div id="sensor-chart" class="container mb-4"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Activity Logs -->
            <div class="row mt-4">
                <!-- Heater Activity Log -->
                <div class="col-12 col-xl-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Heater Activity Log</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <tbody>
                                        @if (isset($heaterLogs) && count($heaterLogs) > 0)
                                            @foreach ($heaterLogs as $log)
                                                <tr>
                                                    <td class="col-3">
                                                        <div class="d-flex align-items-center">
                                                            <svg class="bi text-primary" width="10" height="10" fill="blue">
                                                                <use xlink:href="{{ asset('template/images/bootstrap-icons.svg#circle-fill') }}" />
                                                            </svg>
                                                            <p class="font-bold ms-3 mb-0">
                                                                {{ $log->message }} at {{ $log->created_at }}
                                                            </p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="col-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="me-3">
                                                            <svg class="bi text-primary" width="10" height="10" fill="blue">
                                                                <use xlink:href="{{ asset('template/images/bootstrap-icons.svg#circle-fill') }}" />
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <h6 class="font-bold mb-0">ON</h6>
                                                            <span class="text-muted">2°C</span>
                                                            <div id="heater-chart-europe" class="sparkline"></div>
                                                        </div>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Lamp Activity Log -->
                <div class="col-12 col-xl-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Lamp Activity Log</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <tbody>
                                        @if (isset($lampLogs) && count($lampLogs) > 0)
                                            @foreach ($lampLogs as $log)
                                                <tr>
                                                    <td class="col-3">
                                                        <div class="d-flex align-items-center">
                                                            <svg class="bi text-primary" width="10" height="10" fill="blue">
                                                                <use xlink:href="{{ asset('template/images/bootstrap-icons.svg#circle-fill') }}" />
                                                            </svg>
                                                            <p class="font-bold ms-3 mb-0">
                                                                {{ $log->message }} at {{ $log->created_at }}
                                                            </p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="col-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="me-3">
                                                            <svg class="bi text-primary" width="10" height="10" fill="blue">
                                                                <use xlink:href="{{ asset('template/images/bootstrap-icons.svg#circle-fill') }}" />
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <h6 class="font-bold mb-0">ON</h6>
                                                            <span class="text-muted">°C</span>
                                                            <div id="lamp-chart-europe" class="sparkline"></div>
                                                        </div>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Profile Card -->
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-4">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="{{ asset('template/assets/images/faces/bg.jpg') }}" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">Profile</h5>
                            <h6 class="text-muted mb-0">@hasansohib</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script>
<script>
Highcharts.chart('sensor-chart', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Sensor Statistics'
    },
    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Values'
        }
    },
    tooltip: {
        pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b><br/>',
        shared: true
    },
    plotOptions: {
        column: {
            grouping: false,
            shadow: false,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Temperature',
        data: [8, 16, 28, 16, 8, 12, 32, 8, 16, 24, 28, 16],
        pointPadding: 0.3,
        pointPlacement: -0.2
    }, {
        name: 'Humidity',
        data: [14, 20, 16, 10, 4, 24, 32, 10, 12, 20, 30, 24],
        pointPadding: 0.4,
        pointPlacement: -0.2
    }, {
        name: 'Light Intensity',
        data: [18, 26, 14, 18, 14, 22, 28, 14, 24, 26, 32, 28],
        pointPadding: 0.4,
        pointPlacement: 0.2
    }]
});

$(document).ready(function() {
    $('#heater-chart-europe').sparkline([5, 6, 7, 9, 9, 5, 3, 2, 4, 6, 7, 2], {
        type: 'line',
        width: '100%',
        height: '50',
        lineColor: '#f39c12',
        fillColor: '#f39c12',
        spotColor: '#f39c12',
        minSpotColor: '#f39c12',
        maxSpotColor: '#f39c12',
        highlightSpotColor: '#f39c12',
        highlightLineColor: '#f39c12'
    });
    $('#heater-chart-america').sparkline([2, 3, 4, 2, 5, 6, 7, 3, 2, 4, 1, 5], {
        type: 'line',
        width: '100%',
        height: '50',
        lineColor: '#3498db',
        fillColor: '#3498db',
        spotColor: '#3498db',
        minSpotColor: '#3498db',
        maxSpotColor: '#3498db',
        highlightSpotColor: '#3498db',
        highlightLineColor: '#3498db'
    });

    $('#lamp-chart-europe').sparkline([5, 6, 7, 9, 9, 5, 3, 2, 4, 6, 7, 2], {
        type: 'line',
        width: '100%',
        height: '50',
        lineColor: '#f39c12',
        fillColor: '#f39c12',
        spotColor: '#f39c12',
        minSpotColor: '#f39c12',
        maxSpotColor: '#f39c12',
        highlightSpotColor: '#f39c12',
        highlightLineColor: '#f39c12'
    });
    $('#lamp-chart-america').sparkline([2, 3, 4, 2, 5, 6, 7, 3, 2, 4, 1, 5], {
        type: 'line',
        width: '100%',
        height: '50',
        lineColor: '#3498db',
        fillColor: '#3498db',
        spotColor: '#3498db',
        minSpotColor: '#3498db',
        maxSpotColor: '#3498db',
        highlightSpotColor: '#3498db',
        highlightLineColor: '#3498db'
    });
});
</script>
@endsection
