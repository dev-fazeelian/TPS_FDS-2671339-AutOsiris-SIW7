{{-- Inclusión de encabezado --}}
@include("layouts.headerAdmin")

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administrador | Inicio</title>

    {{-- Estilos para tabla de ventas diarias --}}
    <link rel="stylesheet" href="{{ asset("assets/css/Admin/modules/Sales/diary-sales.css") }}">

    {{-- Estilos para reportes gráficos --}}
    <link rel="stylesheet" href="{{ asset("assets/css/Admin/modules/Statistics/statistics-styles.css") }}">

    {{-- CDN Chart Js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- Contenido página -->
    <section class="contenido-pag">
        <!-- Bienvenida -->
        <div class="bienvenida">
            <h1>¡Bienvenido {{ Auth::user()->name }}!</h1>
            <p>Aquí encontrarás las novedades con respecto a tu negocio y su administración</p>
        </div>

        <br><br><br>

        <!-- Titulo de ventana -->
        <div class="titulo-ventana">
            <h1 class="titulo">Ventas Diarias:</h1>
        </div>

        <table class="tabla-ventas-diarias">
            <!-- Columnas características de Venta -->
            <tr class="columnas-caract-venta">
                <td class="item-columna num-venta">No</td>
                <td class="item-columna total-venta">Total</td>
                <td class="item-columna opciones-venta-tabla">Opciones</td>
            </tr>

            <!-- Filas Datos de Venta -->
            @forelse ($todaySales as $sale)
                <tr class="filas-datos">
                    <td class="item-fila num-venta-dato"> <h2>{{ $sale->id }}</h2></td>
                    <td class="item-fila total-venta-dato"> <h2>{{ $sale->total }} $ </h2></td>
                    <td class="opciones-venta-tabla-dato">
                        <a href="{{ route('sales.show', $sale->id) }}"><button class="btn-venta btn-ver"><a href="{{ route('sales.show', $sale->id) }}" class="link-op-venta">Ver</a><a href="{{ route('sales.show', $sale->id) }}"><img src="{{ asset("assets/img/Admin/modules/ver-factura-icono.png") }}" alt="Ver Icono" class="icono-op-venta"></button></a>
                        <a href="{{ route('sales.edit', $sale->id) }}"><button class="btn-venta btn-editar"><a href="{{ route('sales.edit', $sale->id) }}" class="link-op-venta">Editar</a><a href="{{ route('sales.edit', $sale->id) }}"><img src="{{ asset("assets/img/Admin/modules/editar-icono.png") }}" alt="Editar Icono"></a></button></a>
                        <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" class="btn-eliminar">
                            @csrf
                            @method('DELETE')
                            <button class="btn-venta eliminar-venta" onclick="return confirm('¿Estás seguro de que deseas eliminar esta venta?')"> Eliminar
                                <img src="{{ asset("assets/img/Admin/modules/eliminar-icono.png") }}" alt="Eliminar Icono">
                            </button>
                        </form>
                    </td>
                </tr>

            @empty
                <tr class="filas-datos">
                    <td class="no-records item-fila"><h2>Aún no hay registrado una venta hoy</h2></td>
                </tr>
            @endforelse
        </table>

        <br><br>
        {{-- Reportes gráficos --}}
        {{-- Título --}}
        <div class="titulo-ventana">
            <h1 class="titulo">Reportes gráficos:</h1>
        </div>

        {{-- Gráficos --}}
        <div class="sect-graphic-reports">
            <div class="row-graphics">
                <div class="cont-graph cont-width-small">
                    <h2>Productos más vendidos este mes: Enero</h2>

                    <canvas id="circularChart1" class="chart-35"></canvas>
                </div>
                <div class="cont-graph cont-width-big">
                    <h2>Productos más vendidos este mes: Enero</h2>

                    <canvas id="Chart2" class="chart-35"></canvas>
                </div>
            </div>
        </div>
            <div class="row-graphics">
                {{-- Gráfico: Cantidad de ventas esta semana --}}
                <div class="cont-graph cont-width-big">
                    <h2>Total de ventas este mes:</h2>

                    <canvas id="Chart3" class="chart-62"></canvas>
                </div>
                <div class="cont-graph cont-width-small">
                    <h2>Productos más vendidos este mes: Enero</h2>

                    <canvas id="Chart4" class="chart-35"></canvas>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Gráfico 1: Productos más vendidos este mes
        var ctx = document.getElementById('circularChart1').getContext('2d');
        var circularChart1 = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($firstChartData['labels']) !!},
                datasets: [{
                    data: {!! json_encode($firstChartData['data']) !!},
                    backgroundColor: [
                        'rgb(99, 255, 159)',
                        'rgb(213, 255, 99)',
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                        'rgb(255, 86, 199)',
                    ],
                    borderWidth: 1,
                    hoverOffset: 4
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

        // Gráfico 2: Cantidad de ventas esta semana
        var ctx = document.getElementById('Chart2').getContext('2d');
        var Chart2 = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($firstChartData['labels']) !!},
                datasets: [{
                    label: 'Número de ventas',
                    data: {!! json_encode($firstChartData['data']) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(14, 39, 90, 0.2)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(65, 93, 151)'
                    ],
                    borderWidth: 1,
                    hoverOffset: 4
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

        // Gráfico 3: Total ventas este mes
        var ctx = document.getElementById('Chart3').getContext('2d');
        var Chart3 = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($thirdChartData['labels']) !!},
                datasets: [{
                    label: 'Chart Example',
                    data: {!! json_encode($thirdChartData['data']) !!},
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    hoverOffset: 4
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

        // Gráfico 4: Cantidad de ventas por categoría
        var ctx = document.getElementById('Chart4').getContext('2d');
        var Chart4 = new Chart(ctx, {
            type: 'polarArea',
            data: {
                labels: {!! json_encode($fourthChartData['labels']) !!},
                datasets: [{
                    data: {!! json_encode($fourthChartData['data']) !!},
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(75, 192, 192)',
                    'rgb(255, 205, 86)',
                    'rgb(201, 203, 207)',
                    'rgb(54, 162, 235)'
                ],
                borderWidth: 1
                }]
            },

            options: {
                scales: {
                y: {
                    beginAtZero: true
                }
                }
            },
        });
    </script>
</body>
</html>
