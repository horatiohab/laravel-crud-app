<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(Request $request) 
    {
        $countries = Country::latest()->paginate(5);

        if ($request->has('search')) {
            $countries = Country::where('name', 'like', "%{$request->search}%")->get();
        }

        return view('countries.index', compact('countries'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create() 
    {
        return view('countries.create');
    }

    public function store(Request $request) 
    {
        $request->validate([
            'name' => 'required',
        ]);

        Country::create($request->all());

        return redirect()->route('countries.index')
            ->with('message', 'Country Created Successfully');
    }

    public function edit(Country $country)
    {
        return view('countries.edit', compact('country'));
    }

    public function update(Request $request, Country $country)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $country->update($request->all());

        return redirect()->route('countries.index')
            ->with('message','Country updated successfully');
    }

    public function destroy(Country $country)
    {
        $country->delete();
        
        return redirect()->route('countries.index')
            ->with('message', 'Country deleted successfully');
    }
}
