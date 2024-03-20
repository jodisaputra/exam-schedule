<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classroom;
use Illuminate\Support\Facades\Validator;

class ClassroomController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('classrooms.index', [
            'action' => route('classroom.create'),
            'classrooms' => Classroom::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('classrooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'room_code' => 'required|unique:classrooms',
            'room_name' => 'required',
            'capacity' => 'required|numeric',
            // Add more validation rules as needed
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // If validation passes, proceed to insert data into the database
        $classroom = new Classroom();
        $classroom->fill($request->all());
        $classroom->save();

        // Redirect back to the page with a success message
        return redirect()->route('classroom.index')->with('success', 'Classroom added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('classrooms.edit', [
            'classroom' => Classroom::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Define validation rules
        $rules = [
            'room_code' => 'required|unique:classrooms,room_code,' . $id,
            'room_name' => 'required',
            'capacity' => 'required|numeric',
            // Add more validation rules as needed
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // If validation passes, proceed to update data in the database
        $classroom = Classroom::findOrFail($id);
        $classroom->fill($request->all());
        $classroom->save();

        // Redirect back to the page with a success message
        return redirect()->route('classroom.index')->with('success', 'Classroom updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the classroom by ID
        $classroom = Classroom::findOrFail($id);

        // Delete the classroom
        $classroom->delete();

        // Redirect back to the index page with a success message
        return redirect()->route('classroom.index')->with('success', 'Classroom deleted successfully.');
    }
}
