<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleCategory;
use App\Models\Product;
use App\Models\Region;
use App\Models\Salesperson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        // Fetching the sales data with relationships
        $sales = Sale::with(['product', 'saleCategory', 'region', 'salesperson'])
                    ->orderBy('date', 'desc')
                    ->paginate(10);

        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        // Loading required data for the create form
        $products = Product::all();
        $saleCategories = SaleCategory::all();
        $regions = Region::all();
        $salespeople = Salesperson::all();

        return view('sales.create', compact('products', 'saleCategories', 'regions', 'salespeople'));
    }

    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'sale_category_id' => 'required|exists:sale_categories,id',
            'region_id' => 'required|exists:regions,id',
            'salesperson_id' => 'required|exists:salespeople,id',
            'units_sold' => 'required|integer',
            'unit_price' => 'required|numeric',
            'total_sales' => 'required|numeric',
            'date' => 'required|date',
        ]);

        // Create new sale
        Sale::create($validated);

        return redirect()->route('sales.index')->with('success', 'Sale created successfully');
    }

    public function edit($id)
    {
        $sale = Sale::findOrFail($id);
        $products = Product::all();
        $saleCategories = SaleCategory::all();
        $regions = Region::all();
        $salespeople = Salesperson::all();

        return view('sales.edit', compact('sale', 'products', 'saleCategories', 'regions', 'salespeople'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'sale_category_id' => 'required|exists:sale_categories,id',
            'region_id' => 'required|exists:regions,id',
            'salesperson_id' => 'required|exists:salespeople,id',
            'units_sold' => 'required|integer',
            'unit_price' => 'required|numeric',
            'total_sales' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $sale = Sale::findOrFail($id);
        $sale->update($validated);

        return redirect()->route('sales.index')->with('success', 'Sale updated successfully');
    }

    public function destroy($id)
    {
        Sale::findOrFail($id)->delete();

        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully');
    }
}
