<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
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
        return view('teachers.index', [
            'teachers' => Teacher::all(),
            'action' => route('teacher.create')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'teacher_code' => 'required|unique:teachers',
            'teacher_name' => 'required',
            'gender' => 'required',
            'phone_number' => 'nullable|numeric',
            'place_of_birth' => 'nullable',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable',
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
        $teacher = new Teacher();
        $teacher->fill($request->all());
        $teacher->save();

        // Redirect back to the page with a success message
        return redirect()->route('teacher.index')->with('success', 'Teacher added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('teachers.edit', [
            'teacher' => Teacher::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Define validation rules
        $rules = [
            'teacher_code' => 'required|unique:teachers,teacher_code,' . $id,
            'teacher_name' => 'required',
            'gender' => 'required',
            'phone_number' => 'nullable|numeric',
            'place_of_birth' => 'nullable',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable',
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
        $teacher = Teacher::findOrFail($id);
        $teacher->fill($request->all());
        $teacher->save();

        // Redirect back to the page with a success message
        return redirect()->route('teacher.index')->with('success', 'Teacher updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the teacher by ID
        $teacher = Teacher::findOrFail($id);

        // Delete the teacher
        $teacher->delete();

        // Redirect back to the index page with a success message
        return redirect()->route('teacher.index')->with('success', 'Teacher deleted successfully.');
    }
}
