<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        
        $totalSalesUnits = Sale::sum('units_sold');
        $totalSalesValue = Sale::sum(DB::raw('units_sold * unit_price'));
        $numberOfSales   = Sale::count();

        $salesPerMonth = Sale::selectRaw('DATE_FORMAT(sale_date, "%b %Y") as month, SUM(units_sold) as units_sold')
            ->groupBy('month')
            ->orderByRaw('MIN(sale_date) ASC')
            ->get();

        $salesPerRegion = Sale::join('regions', 'sales.region_id', '=', 'regions.id')
            ->select('regions.region_name as region', DB::raw('SUM(sales.units_sold) as total_units'))
            ->groupBy('region')
            ->get();

        

        return view('dashboard', compact(
            'totalSalesUnits',
            'totalSalesValue',
            'numberOfSales',
            'salesPerMonth',
            'salesPerRegion',
        ));
    }
}
