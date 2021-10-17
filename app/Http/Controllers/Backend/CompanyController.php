<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request) 
    {
        $companies = Company::latest()->paginate(5);

        if ($request->has('search')) {
            $companies = Company::where('name', 'like', "%{$request->search}%")->get();
        }

        return view('companies.index', compact('companies'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create() 
    {
        return view('companies.create');
    }

    public function store(Request $request) 
    {
        $request->validate([
            'name' => 'required',
        ]);

        Company::create($request->all());

        return redirect()->route('companies.index')
            ->with('message', 'Company Created Successfully');
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('Company'));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $company->update($request->all());

        return redirect()->route('companies.index')
            ->with('message','Company updated successfully');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        
        return redirect()->route('companies.index')
            ->with('message', 'Company deleted successfully');
    }
}
