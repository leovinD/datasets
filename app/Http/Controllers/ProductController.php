<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SaleCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
       
        $products = Product::with('saleCategory') 
            ->get();

        $categories = SaleCategory::all(); 

        return view('products.index', compact('products', 'categories'));
    }

    public function create()
    {
        
        $categories = SaleCategory::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products,product_name',
            'sale_category_id' => 'required|exists:sale_categories,id',
        ]);

        Product::create([
            'product_name' => $request->name,
            'sale_category_id' => $request->sale_category_id,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = SaleCategory::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products,product_name,' . $id,
            'sale_category_id' => 'required|exists:sale_categories,id',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'product_name' => $request->name,
            'sale_category_id' => $request->sale_category_id,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}



// namespace App\Http\Controllers;
// use App\Models\Product;
// use App\Models\SaleCategory;
// use App\Models\Region;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

// class ProductController extends Controller
// {
//     public function index(Request $request)
//     {
//         $regionId = $request->query('region');
//         $regions = Region::all();

//         $products = Product::when($regionId, function ($query, $regionId) {
//             return $query->where('region_id', $regionId);
//         })->get();

//         $productsPerRegion = DB::table('products')
//             ->join('regions', 'products.region_id', '=', 'regions.id')
//             ->select('regions.region_name as region', DB::raw('count(*) as product_count'))
//             ->groupBy('regions.region_name')
//             ->get();

//         return view('products.index', compact('products', 'regions', 'regionId', 'productsPerRegion'));
//     }

//     public function create()
//     {
//         $categories = SaleCategory::all();
//         $regions = Region::all();
//         return view('products.create', compact('categories', 'regions'));
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'name' => 'required|string|max:255|unique:products,product_name',
//             'sale_category_id' => 'required|exists:sale_categories,id',
//             'region_id' => 'required|exists:regions,id',
//         ]);

//         Product::create([
//             'product_name' => $request->name,
//             'sale_category_id' => $request->sale_category_id,
//             'region_id' => $request->region_id,
//         ]);

//         return redirect()->route('products.index')->with('success', 'Product created successfully');
//     }

//     public function edit($id)
//     {
//         $product = Product::findOrFail($id);
//         $categories = SaleCategory::all();
//         $regions = Region::all();
//         return view('products.edit', compact('product', 'categories', 'regions'));
//     }

//     public function update(Request $request, $id)
//     {
//         $request->validate([
//             'name' => 'required|string|max:255|unique:products,product_name,' . $id,
//             'sale_category_id' => 'required|exists:sale_categories,id',
//             'region_id' => 'required|exists:regions,id',
//         ]);

//         $product = Product::findOrFail($id);
//         $product->update([
//             'product_name' => $request->name,
//             'sale_category_id' => $request->sale_category_id,
//             'region_id' => $request->region_id,
//         ]);

//         return redirect()->route('products.index')->with('success', 'Product updated successfully');
//     }

//     public function destroy($id)
//     {
//         Product::findOrFail($id)->delete();
//         return redirect()->route('products.index')->with('success', 'Product deleted successfully');
//     }
// }
