<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InstituteController extends Controller{
    // Show all institutes
    public function index() {
        return view('institutes.index', [
            // 'insitute' => Institute::latest()->filter(request(['tag', 'search']))->paginate(6)
            'insitutes' => Institute::oldest()->get()
        ]);
    }

    // Store Listing Data
    public function store(Request $request) {
        
        
        $formFields = $request->validate([
            'name' => 'required',
            'type' => 'required'
        ]);


        Institute::create($formFields);
        return redirect(route('institutes'))->with('success', 'Institute created successfully!');
    }


    // Update Listing Data
    public function update(Request $request, Institute $institute) {
        $formFields = $request->validate([
            'name' => 'required',
            'type' => 'required'
        ]);
        $institute->update($formFields);
        return redirect(route('institutes'))->with('success', 'Institute updated successfully!');
        // return back()->with('success', 'Institute updated successfully!');
    }

    // Delete Listing Data
    public function destroy(Request $request, Institute $institute) {
        $institute->delete();
        return back()->with('success', 'Institute deleted successfully!');
    }
}

?>