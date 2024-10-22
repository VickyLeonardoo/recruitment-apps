<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentStoreRequest;
use App\Http\Requests\DepartmentUpdateRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $departments = Department::query(); // Inisialisasi query

        if ($request->has('search')) {
            $query = $request->search;
            // Tambahkan pencarian pada kolom 'code' dan 'name'
            $departments = $departments->where(function ($q) use ($query) {
                $q->where('code', 'like', "%{$query}%")
                ->orWhere('name', 'like', "%{$query}%");
            });
        }

        // Pagination 10 item per halaman
        $departments = $departments->paginate(10);

        return view('backend.department.index', [
            'departments' => $departments,
        ]);

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.department.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentStoreRequest $request)
    {
        $data = $request->validated();

        $department = Department::create($data);

        return redirect()->route('department.index')->with('success','Department created successfully!');
        // return redirect('department.show', $department->id)->with('success','Department created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        return view('backend.department.show', [
            'department' => $department->load('position'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('backend.department.edit', [
            'department' => $department,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentUpdateRequest $request, Department $department)
    {
        $data = $request->validated();

        $department->name = $data['name'];
        $department->code = $data['code'];
        $department->save();

        return redirect()->route('department.show',$department)->with('success','Department updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('department.index')->with('success','Department deleted successfully!');
    }
}
