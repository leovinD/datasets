<?php
namespace App\Http\Controllers;

use App\Models\SalesPerson;
use Illuminate\Http\Request;

class SalesPersonController extends Controller
{
    public function index()
    {
        
        return SalesPerson::all();
    }

    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'date' => 'nullable|date',  
            'name' => 'required|string',  
            'region' => 'required|string',  
        ]);

        
        return SalesPerson::create($validated);
    }
}
