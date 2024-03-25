<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Modelo de ventas
use App\Models\Sale;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sales = Sale::paginate();

        // Filtrar ventas registradas hoy
        $todaySales = Sale::whereDate('created_at', now()->toDateString())->get();

        // Información para gráfico 1
        $firstChartData = [
            'labels' => ['Producto 1', 'Producto 2', 'Producto 3', 'Producto 4', 'Producto 5', 'Producto 6'],
            'data' => [10, 12, 30, 20, 22, 18]
        ];

        // Información para gráfico 2
        $secondChartData = [
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            'data' => [65, 59, 80, 81, 56, 55, 40]
        ];

        // Información para gráfico 3
        $thirdChartData = [
            'labels' => ['Semana 1', 'Semana 2', 'Semana 3', 'Semana 4'],
            'data' => [65, 59, 80, 81, 56, 55, 40]
        ];

        // Información para gráfico 4
        $fourthChartData = [
            'labels' => ['Categoría 1', 'Categoría 2', 'Categoría 3', 'Categoría 4', 'Categoría 5'],
            'data' => [20, 12, 18, 12, 16, 15, 14]
        ];

        return view('home', compact('sales', 'todaySales', 'firstChartData', 'secondChartData', 'thirdChartData', 'fourthChartData'))
            ->with('i', (request()->input('page', 1) - 1) * $sales->perPage());
    }
}
