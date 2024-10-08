<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;


class DashboardControllers extends Controller
{
    // Main dashboard
    public function index() {
        $brands = \App\Models\Brand::all();
        return view('main-dashboard')
            ->with('brands', $brands);
    }

    public function createBrandIndex() {
        return view('brands.create-brand');
    }

    public function createBrand(Request $request) {
        $request->validate([
            'name' => 'required',
            'country' => 'required',
            'establish_date' => 'required',
        ]);
    
        $idLegal = Str::random(8) . '-' . Str::random(5) . '-' . strtoupper(Str::random(3)) . '-' . strtoupper(Str::random(6)) . rand(1000, 9999);
    
        \App\Models\Brand::create([
            'name' => $request->name,
            'country' => $request->country,
            'id_legal' => $idLegal,
            'establish_date' => $request->establish_date
        ]);

        
    
        return redirect()->intended('dashboard');
    }

    public function deleteBrand($id_brand) {
        $brand = \App\Models\Brand::where('id_brand', $id_brand)->first();
        if (!$brand) {
            return redirect()->back()->with('error', 'Brand not found.');
        }
        $brand->delete();
        return redirect()->intended('dashboard')->with('success', 'Brand deleted successfully.');
    }
    

    public function editBrandIndex(Request $request) {
        $brand = \App\Models\Brand::where('id_brand', $request->id_brand)->first();
        return view('brands.edit-brand')
            ->with('brand', $brand);
    }

    public function editBrand(Request $request) {
        $request->validate([
            'name' => 'required',
            'country' => 'required',
            'establish_date' => 'required',
        ]);
    
        $brand = \App\Models\Brand::where('id_brand', $request->id_brand)->first();
        if (!$brand) {
            return redirect()->back()->with('error', 'Brand not found.');
        }
    
        $brand->update([
            'name' => $request->name,
            'country' => $request->country,
            'establish_date' => $request->establish_date
        ]);
    
        return redirect()->intended('dashboard');
    }

    // Unit dashboard
    public function indexUnit() {
        $units = \App\Models\Unit::select('units.*', 'brands.name as brand_name')->join('brands', 'units.id_brand', '=', 'brands.id_brand')->get();
        return view('units.main-units')
            ->with('units', $units);
    }

    public function createUnitIndex() {
        $brands = \App\Models\Brand::all();
        return view('units.create-unit')
            ->with('brands', $brands);
    }

    public function createUnit(Request $request) {
        $request->validate([
            'id_brand' => 'required',
            'screen_res' => 'required',
            'refresh_rate' => 'required',
            'screen_ratio' => 'required',
            'price' => 'required',
        ]);
    
        \App\Models\Unit::create([
            'id_brand' => $request->id_brand,
            'screen_res' => $request->screen_res,
            'refresh_rate' => $request->refresh_rate,
            'screen_ratio' => $request->screen_ratio,
            'price' => $request->price
        ]);
    
        return redirect()->intended('dashboard-units');
    }

    public function editUnitIndex(Request $request) {
        $unit = \App\Models\Unit::where('id_unit', $request->id_unit)->first();
        $brands = \App\Models\Brand::all();
        return view('units.edit-unit')
            ->with('unit', $unit)
            ->with('brands', $brands);
    }

    public function editUnit(Request $request) {
        $request->validate([
            'id_brand' => 'required',
            'screen_res' => 'required',
            'refresh_rate' => 'required',
            'screen_ratio' => 'required',
            'price' => 'required',
        ]);

        $unit = \App\Models\Unit::where('id_unit', $request->id_unit)->first();
        if (!$unit) {
            return redirect()->back()->with('error', 'Unit not found.');
        }
    
        $unit->update([
            'id_brand' => $request->id_brand,
            'screen_res' => $request->screen_res,
            'refresh_rate' => $request->refresh_rate,
            'screen_ratio' => $request->screen_ratio,
            'price' => $request->price
        ]);
    
        return redirect()->intended('dashboard-units');
    }

    public function deleteUnit($id_unit) {
        $unit = \App\Models\Unit::where('id_unit', $id_unit)->first();
        if (!$unit) {
            return redirect()->back()->with('error', 'Unit not found.');
        }
        $unit->delete();
        return redirect()->intended('dashboard-units');
    }

    //API
    public function getBrandsData(Request $request)
    {
        try {
            $query = \App\Models\Brand::query(); 
            if ($request->has('name')) {
                $query->where('name', 'like', '%' . $request->query('name') . '%');
            }
        
            $brands = $query->get();
            if ($brands->isEmpty()) {
                return response()->json(['message' => 'No brands found'], 404);
            }
        
            return response()->json($brands);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['message' => 'An error occurred while fetching brand data'], 500);
        }
    }
    
    public function getUnitsData(Request $request)
    {
        try {
            $query = \App\Models\Unit::select('units.*', 'brands.name as brand_name')
                ->join('brands', 'units.id_brand', '=', 'brands.id_brand');
        
            if ($request->has('brand_name')) {
                $query->where('brands.name', 'like', '%' . $request->query('brand_name') . '%');
            }
        
            if ($request->has('refresh_rate')) {
                $query->where('units.refresh_rate', 'like', '%' . $request->query('refresh_rate') . '%');
            }
        
            $units = $query->get();
        
            if ($units->isEmpty()) {
                return response()->json(['message' => 'No units found'], 404);
            }
        
            return response()->json($units);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['message' => 'An error occurred while fetching unit data'], 500);
        }
    }
    
    public function getSpecificBrandData($id_brand)
    {
        try {
            $brand = \App\Models\Brand::where('id_brand', $id_brand)->first();
            if (!$brand) {
                return response()->json(['message' => 'Brand not found'], 404);
            }
            return response()->json($brand);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['message' => 'An error occurred while fetching specific brand data'], 500);
        }
    }
    
    public function getSpecificUnitData($id_unit)
    {
        try {
            $unit = \App\Models\Unit::where('id_unit', $id_unit)->first();
        
            if (!$unit) {
                return response()->json(['message' => 'Unit not found'], 404);
            }
        
            return response()->json($unit);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['message' => 'An error occurred while fetching specific unit data'], 500);
        }
    }
    

}
