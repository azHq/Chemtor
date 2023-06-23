<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseController extends Controller{
    // Show all institutes
    public function index() {
        return view('courses.index', [
            // 'insitute' => Institute::latest()->filter(request(['tag', 'search']))->paginate(6)
            'courses' => Course::oldest()->get()
        ]);
    }
    // Store Course Data
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => 'required'
        ]);
        Course::create($formFields);
        return redirect(route('courses'))->with('success', 'Class created successfully!');
    }


    // Update Course Data
    public function update(Request $request, Course $course) {
        
        $formFields = $request->validate([
            'name' => 'required'
        ]);

        $course->update($formFields);
        return redirect(route('courses'))->with('success', 'Class updated successfully!');
    }

    // Store Course Data
    public function destroy(Request $request, Course $course) {
        $course->delete();
        return redirect(route('courses'))->with('success', 'Class deleted successfully!');
    }
}

?>