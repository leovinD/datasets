<?php

namespace App\Http\Controllers;

use App\Models\SaleCategory;
use Illuminate\Http\Request;

class SaleCategoryController extends Controller
{
    public function index()
    {
        $categories = SaleCategory::all();
        return view('sale_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('sale_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:sale_categories',
        ]);

        SaleCategory::create([
            'name' => $request->name,
        ]);

        return redirect()->route('sale_categories.index')->with('success', 'Category created successfully');
    }

    public function edit($id)
    {
        $category = SaleCategory::findOrFail($id);
        return view('sale_categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:sale_categories,name,' . $id,
        ]);

        $category = SaleCategory::findOrFail($id);
        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('sale_categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {
        SaleCategory::findOrFail($id)->delete();

        return redirect()->route('sale_categories.index')->with('success', 'Category deleted successfully');
    }
}

