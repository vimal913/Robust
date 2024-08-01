<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Student::all();
        return view('home',compact('student'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'mark' => 'required|integer|min:0|max:100',
        ]);

        $subject = new Student;
        $subject->user_id = Auth::user()->id;
        $subject->studentName = $request->name;
        $subject->subject = $request->subject;
        $subject->mark = $request->mark;
        $subject->save();

        return response()->json(['message' => 'Student Record created successfully.'], 200);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'subject' => 'required|string',
            'mark' => 'required|numeric',
        ]);
        $student = Student::where('id',$id)->first();
        if($student){
            $student->user_id = Auth::user()->id;
            $student->studentName = $request->name;
            $student->subject = $request->subject;
            $student->mark = $request->mark;
            $student->save();

            return response()->json(['message' => 'Changes saved successfully!']);
        }else{
            return response()->json(['message' => 'Student not found'], 404);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $record = Student::findOrFail($id);
        $record->delete();

        return response()->json(['message' => 'Record deleted successfully']);
    }
}
