@extends('administration')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="m-0 text-primary">Estadísticas de Productos por Marca</h1>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle me-2"></i> Volver
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body text-center">
            <div id="piechart_3d" style="width: 100%; height: 500px;"></div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Marca', 'Cantidad de Productos'],
            @foreach($chartData as $item)
                ['{{ $item[0] }}', {{ $item[1] }}],
            @endforeach
        ]);

        var options = {
            title: 'Distribución de Productos por Marca',
            is3D: true,
            backgroundColor: '#f8f9fa',
            titleTextStyle: { color: '#0d6efd', fontSize: 20, bold: true },
            legend: { position: 'right', textStyle: { fontSize: 13 } },
            chartArea: { width: '80%', height: '80%' }
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
    }
</script>
@endsection
