<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BatchController extends Controller{
    // Show all institutes
    public function index() {
        $batches = Batch::oldest()->get();
        $courses = Course::all();
        return view('batches.index', compact('batches', 'courses'));
    }
    // Store Course Data
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => 'required|unique:batches,name,NULL,id,course_id,'.$request->input('course_id'),
            'course_id' => 'required',
            'capacity' => 'nullable',
            'batch_time' => 'nullable',
            'version' => 'nullable'
        ], [
            'name.unique' => 'The combination of name and class must be unique.'
        ]);
        Batch::create($formFields);
        return redirect(route('batches'))->with('success', 'Batch created successfully!');
    }


    // Update Course Data
    public function update(Request $request, Batch $batch) {
        
        $formFields = $request->validate([
            'name' => 'required',
            'course_id' => 'required',
            'capacity' => 'nullable',
            'batch_time' => 'nullable',
            'version' => 'nullable'
        ]);

        $batch->update($formFields);
        return redirect(route('batches'))->with('success', 'Batch updated successfully!');
    }


    // Store Course Data
    public function destroy(Request $request, Batch $batch) {
        $batch->delete();
        return redirect(route('batches'))->with('success', 'Batch deleted successfully!');
    }
}

?>