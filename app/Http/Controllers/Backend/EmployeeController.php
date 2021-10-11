<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\City;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request) 
    {
        $employees = Employee::latest()->paginate(5);

        if ($request->has('search')) {
            $employees = Employee::where('name', 'like', "%{$request->search}%")->get();
        }

        return view('employees.index', compact('employees'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create() 
    {
        $cities = City::all();
        return view('employees.create', compact('cities'));
    }

    public function store(Request $request) 
    {
        $request->validate([
            'name' => 'required',
        ]);

        Employee::create($request->all());

        return redirect()->route('employees.index')
            ->with('message', 'Employee Created Successfully');
    }
}
