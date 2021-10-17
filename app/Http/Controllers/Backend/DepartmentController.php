<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(Request $request) 
    {
        $departments = Department::latest()->paginate(5);

        if ($request->has('search')) {
            $departments = Department::where('name', 'like', "%{$request->search}%")->get();
        }

        return view('departments.index', compact('departments'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create() 
    {
        return view('departments.create');
    }

    public function store(Request $request) 
    {
        $request->validate([
            'name' => 'required',
        ]);

        Department::create($request->all());

        return redirect()->route('departments.index')
            ->with('message', 'Department Created Successfully');
    }

    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, department $department)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $department->update($request->all());

        return redirect()->route('departments.index')
            ->with('message','Department updated successfully');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        
        return redirect()->route('departments.index')
            ->with('message', 'Department deleted successfully');
    }
}
