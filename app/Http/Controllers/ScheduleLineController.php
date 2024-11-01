<?php

namespace App\Http\Controllers;

use App\Models\ScheduleLine;
use Illuminate\Http\Request;

class ScheduleLineController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ScheduleLine $scheduleLine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ScheduleLine $scheduleLine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ScheduleLine $scheduleLine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ScheduleLine $line)
    {
        $line->application->is_interview = false;
        $line->application->save();

        $line->delete();
        return redirect()->back()->with('success','Schedule line has been deleted successfully.');

    }
}
