<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(Request $request) 
    {
        $cities = City::latest()->paginate(5);

        if ($request->has('search')) {
            $cities = City::where('name', 'like', "%{$request->search}%")->get();
        }

        return view('cities.index', compact('cities'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create() 
    {
        $countries = Country::all();
        return view('cities.create', compact('countries'));
    }

    public function store(Request $request) 
    {
        $request->validate([
            'name' => 'required',
        ]);

        City::create($request->all());

        return redirect()->route('cities.index')
            ->with('message', 'City Created Successfully');
    }

    public function edit(City $city)
    {
        $countries = Country::all();
        return view('cities.edit', compact('city', 'countries'));
    }

    public function update(Request $request, City $City)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $City->update($request->all());

        return redirect()->route('cities.index')
            ->with('message','City updated successfully');
    }

    public function destroy(City $City)
    {
        $City->delete();
        
        return redirect()->route('cities.index')
            ->with('message', 'City deleted successfully');
    }
}
