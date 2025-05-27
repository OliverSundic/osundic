@extends('layouts.app')


<div class="card shadow mb-4" style="padding: 0 2rem; padding-top: 6rem; ">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Average Price by Ship</h5>
    </div>
    <div class="card-body">
        <div id="priceChart" style="height: 400px;"></div>
    </div>
</div>




@section('content')
<div class="container-fluid py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Shipping Schedules</h4>
        </div>

        <div class="card-body">
            <table id="schedules-table" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Ship</th>
                        <th>Departure Port</th>
                        <th>Arrival Port</th>
                        <th>Departure Time</th>
                        <th>Arrival Time</th>
                        <th>Price (USD)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    $('#schedules-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('schedules.datatable') }}",
            type: 'GET'
        },
        columns: [
            { data: 'ship.name', name: 'ship.name' },
            { data: 'departure_port.name', name: 'departurePort.name' },
            { data: 'arrival_port.name', name: 'arrivalPort.name' },
            { 
                data: 'departure_time', 
                name: 'departure_time',
                render: function(data) {
                    return data ? new Date(data).toLocaleString() : 'N/A';
                }
            },
            { 
                data: 'arrival_time', 
                name: 'arrival_time',
                render: function(data) {
                    return data ? new Date(data).toLocaleString() : 'N/A';
                }
            },
            { 
                data: 'price', 
                name: 'price',
                render: function(data) {
                    return data ? '$' + parseFloat(data).toFixed(2) : 'Not set';
                }
            },
            { 
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false
            }
        ],
        language: {
            emptyTable: "No shipping schedules found",
            zeroRecords: "No matching schedules found"
        }
    });

    function htmlDecode(input) {
        var doc = new DOMParser().parseFromString(input, "text/html");
        return doc.documentElement.textContent;
    }
});
</script>
@endpush

@push('scripts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    // Load Google Charts
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        // Prepare chart data
        const chartData = [
            ['Ship', 'Average Price (USD)'],
            @foreach($chartData as $data)
                ['{{ $data['name'] }}', {{ $data['price'] }}],
            @endforeach
        ];

        // Create data table
        const data = google.visualization.arrayToDataTable(chartData);

        // Set chart options
        const options = {
            title: 'Average Shipping Prices by Vessel',
            titleTextStyle: {
                fontSize: 18,
                bold: true
            },
            colors: ['#0466c8'],
            hAxis: {
                title: 'Ship Name',
                titleTextStyle: {
                    bold: true,
                    italic: false
                }
            },
            vAxis: {
                title: 'Price (USD)',
                format: 'currency',
                minValue: 0,
                titleTextStyle: {
                    bold: true,
                    italic: false
                }
            },
            chartArea: {
                width: '85%',
                height: '70%'
            },
            legend: {
                position: 'none'
            },
            animation: {
                duration: 1000,
                easing: 'out',
                startup: true
            }
        };

        // Draw chart
        const chart = new google.visualization.ColumnChart(document.getElementById('priceChart'));
        chart.draw(data, options);

        // Redraw on window resize
        window.addEventListener('resize', function() {
            chart.draw(data, options);
        });
    }
</script>
@endpush