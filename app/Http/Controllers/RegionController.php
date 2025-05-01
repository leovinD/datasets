<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::all();
        return view('regions.index', compact('regions'));
    }

    public function create()
    {
        return view('regions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:regions',
        ]);

        Region::create([
            'name' => $request->name,
        ]);

        return redirect()->route('regions.index')->with('success', 'Region created successfully');
    }

    public function edit($id)
    {
        $region = Region::findOrFail($id);
        return view('regions.edit', compact('region'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:regions,name,' . $id,
        ]);

        $region = Region::findOrFail($id);
        $region->update([
            'name' => $request->name,
        ]);

        return redirect()->route('regions.index')->with('success', 'Region updated successfully');
    }

    public function destroy($id)
    {
        Region::findOrFail($id)->delete();

        return redirect()->route('regions.index')->with('success', 'Region deleted successfully');
    }
}
