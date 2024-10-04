<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;


class DashboardControllers extends Controller
{
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
    
        // Generate a random alphanumeric string with a custom pattern
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
}
