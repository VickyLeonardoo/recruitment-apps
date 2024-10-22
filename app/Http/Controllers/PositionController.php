<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionStoreRequest;
use App\Http\Requests\PositionUpdateRequest;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Department $department)
    {
        return view('backend.position.create', [
            'department' => $department,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PositionStoreRequest $request, Department $department)
    {
        $data = $request->validated();

        $data['department_id'] = $department->id;
        $position = Position::create($data);
        return redirect()->route('department.show',$department)->with('success','Position created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        return view('backend.position.edit',[
            'position' => $position
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PositionUpdateRequest $request, Position $position)
    {
        $data = $request->validated();

        $position->name = $data['name'];
        $position->code = $data['code'];
        $position->save();

        return redirect()->route('department.show',$position->department)->with('success','Position updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        $position->delete();
        return redirect()->back()->with('success','Position deleted successfully!');
    }
}
