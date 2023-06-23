<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Institute;
use App\Models\Paymenttype;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PaymenttypeController extends Controller{
    // Show all institutes
    public function index() {

        $paymenttypes = Paymenttype::oldest()->get();

        if(request('course')) {
            $paymenttypes = $paymenttypes->where('course_id', request('course'));
        }

        $courses = Course::all();


        return view('parameters.index', [
            'paymenttypes' => $paymenttypes,
            'courses' => $courses
        ]);
    }

    // Store Listing Data
    public function store(Request $request) {
        
        
        $formFields = $request->validate([
            'name' => 'required',
            'course_id' => 'required',
            'category' => 'required',
            'payable_amount' => 'required'
        ]);


        Paymenttype::create($formFields);
        return redirect(route('parameters'))->with('success', 'Parameter created successfully!');
    }


    // Update Listing Data
    public function update(Request $request, Paymenttype $paymenttype) {
        $formFields = $request->validate([
            'name' => 'required',
            'course_id' => 'required',
            'payable_amount' => 'required'
        ]);
        $paymenttype->update($formFields);
        return redirect(route('parameters'))->with('success', 'Parameter updated successfully!');
        // return back()->with('success', 'Institute updated successfully!');
    }

    // Delete Listing Data
    public function destroy(Request $request, Paymenttype $paymenttype) {
        $paymenttype->delete();
        return back()->with('success', 'Fee deleted successfully!');
    }
}

?>