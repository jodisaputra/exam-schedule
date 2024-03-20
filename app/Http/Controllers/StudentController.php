<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Major;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
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
        return view('students.index', [
            'action' => route('student.create'),
            'students' => Student::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create', [
            'majors' => Major::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'student_id' => 'required|unique:students',
            'student_name' => 'required',
            'major_id' => 'required|exists:majors,id',
            'gender' => 'required|in:male,female',
            'place_of_birth' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string',
            // Add more validation rules as needed
        ];

        // Define custom attributes for validation error messages
        $customAttributes = [
            'major_id' => 'Major', // Change the placeholder for major_id
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        // Set custom attributes for error messages
        $validator->setAttributeNames($customAttributes);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // If validation passes, proceed to insert data into the database
        $student = new Student();
        $student->fill($request->all());
        $student->save();

        // Redirect back to the page with a success message
        return redirect()->route('student.index')->with('success', 'Student added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('students.edit', [
            'student' => Student::findOrFail($id),
            'majors' => Major::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Define validation rules
        $rules = [
            'student_id' => 'required|unique:students,student_id,' . $id,
            'student_name' => 'required',
            'major_id' => 'required|exists:majors,id',
            'gender' => 'required|in:male,female',
            'place_of_birth' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string',
            // Add more validation rules as needed
        ];

        // Define custom attributes for validation error messages
        $customAttributes = [
            'major_id' => 'Major', // Change the placeholder for major_id
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        // Set custom attributes for error messages
        $validator->setAttributeNames($customAttributes);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // If validation passes, proceed to update data in the database
        $student = Student::findOrFail($id);
        $student->fill($request->all());
        $student->save();

        // Redirect back to the page with a success message
        return redirect()->route('student.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the student by ID
        $student = Student::findOrFail($id);

        // Delete the student
        $student->delete();

        // Redirect back to the index page with a success message
        return redirect()->route('student.index')->with('success', 'Student deleted successfully.');
    }
}
