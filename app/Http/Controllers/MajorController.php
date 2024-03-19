<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Major;
use Illuminate\Support\Facades\Validator;

class MajorController extends Controller
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
        return view('majors.index', [
            'majors' => Major::all(),
            'action' => route('major.create')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('majors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'major_code' => 'required|unique:majors',
            'major_name' => 'required',
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
        $major = new Major();
        $major->fill($request->all());
        $major->save();

        // Redirect back to the page with a success message
        return redirect()->route('major.index')->with('success', 'Major added successfully.');
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
        return view('majors.edit', [
            'major' => Major::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Define validation rules
        $rules = [
            'major_code' => 'required|unique:majors,major_code,' . $id,
            'major_name' => 'required',
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
        $major = Major::findOrFail($id);
        $major->fill($request->all());
        $major->save();

        // Redirect back to the page with a success message
        return redirect()->route('major.index')->with('success', 'Major updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the major by ID
        $major = Major::findOrFail($id);

        // Delete the major
        $major->delete();

        // Redirect back to the index page with a success message
        return redirect()->route('major.index')->with('success', 'Major deleted successfully.');
    }
}
