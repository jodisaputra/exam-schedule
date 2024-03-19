<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Major;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
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
        return view('courses.index', [
            'action' => route('course.create'),
            'courses' => Course::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courses.create', [
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
            'course_code' => 'required|unique:courses',
            'course_name' => 'required',
            'major_id' => 'required|exists:majors,id',
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
        $course = new Course();
        $course->fill($request->all());
        $course->save();

        // Redirect back to the page with a success message
        return redirect()->route('course.index')->with('success', 'Course added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('courses.edit', [
            'course' => Course::findOrFail($id),
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
            'course_code' => 'required|unique:courses,course_code,' . $id,
            'course_name' => 'required',
            'major_id' => 'required|exists:majors,id',
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
        $course = Course::findOrFail($id);
        $course->fill($request->all());
        $course->save();

        // Redirect back to the page with a success message
        return redirect()->route('course.index')->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the course by ID
        $course = Course::findOrFail($id);

        // Delete the course
        $course->delete();

        // Redirect back to the index page with a success message
        return redirect()->route('course.index')->with('success', 'Course deleted successfully.');
    }
}
