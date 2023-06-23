<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Course;
use App\Models\Message;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Institute;
use App\Models\Paymenttype;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Services\MessageService;
use Illuminate\Database\Eloquent\Builder;

Builder::macro('whereLike', function(string $column, string $search) {
   return $this->orWhere($column, 'LIKE', '%'.$search.'%');
});

class StudentController extends Controller{
    protected $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }


    // Show all students
    public function index(Request $request) {
        $students = [];

        if(request('search')) {
            $searchValue = '%' . request('search') . '%';
            $students = Student::whereLike('name', $searchValue)
                                ->whereLike('email', $searchValue)
                                ->whereLike('id', $searchValue)
                                ->whereLike('phone_number', $searchValue)
                                ->get();
        }
        else {
            $students = Student::with(['institute', 'course'])
            ->orderBy('created_at', 'desc')
            ->get();
        }

        if(request('course')) {
            $students = $students->where('course_id', request('course'));
        }

        if(request('institute')) {
            $students = $students->where('institute_id', request('institute'));
        }

        if(request('batch')) {
            $students = $students->where('batch_id', request('batch'));
        }

        if(request('version')) {
            $students = $students->where('version', request('version'));
        }

        if(request('gender')) {
            $students = $students->where('gender', request('gender'));
        }

        // foreach ($students as $student) {
        //     $student->monthly_cleared = $this->isMonthlyPaymentCleared($student->id);
        //     $student->monthly_due = $this->getMonthlyDueAmount($student->id);
        //     $student->one_time_due = $this->getOneTimeDueAmount($student->id);

        // }

        // if(request('due')) {
        //     $due = request('due');
        //     if ($due === "Due") {
        //         $students = $students->filter(function ($student) {
        //             return !$student->monthly_cleared;
        //         });
        //     } elseif ($due === "OneTimeDue") {
        //         $students = $students->filter(function ($student) {
        //             return $student->one_time_due > 0;
        //         });
        //     } elseif ($due === "Cleared") {
        //         $students = $students->filter(function ($student) {
        //             return $student->monthly_cleared && $student->one_time_due == 0;
        //         });
        //     }
        // }

        if(request('fee')){
            $currentMonth = date('Y-m');

            foreach ($students as $student) {
                $paymentType = $student->course->paymentTypes()
                    ->where('id', request('fee'))
                    ->first();

                $student->due = 0;

                if ($paymentType) {
                    if ($paymentType->category === 'Monthly') {
                        $payment = $student->payment()
                            ->where('paymenttype_id', $paymentType->id)
                            ->whereYear('payment_date', '=', date('Y'))
                            ->whereMonth('payment_date', '=', date('m'))
                            ->first();

                        if (!$payment) {
                            $student->due = $paymentType->payable_amount;
                        }
                    } elseif ($paymentType->category === 'One time') {

                        $payment = $student->payment()
                            ->where('paymenttype_id', $paymentType->id)
                            ->first();

                        if (!$payment) {
                            $student->due = $paymentType->payable_amount;
                        }
                    }
                }
            }
        }

        $courses = Course::all();
        $institutes = Institute::all();
        $batches = Batch::all();

        $paymenttypes = Paymenttype::all();
        $totalStudent = $students->count();


        return view('students.index', compact('students', 'courses', 'institutes', 'batches', 'paymenttypes', 'totalStudent'));
    }

    // Check if monthly payment cleared
    public function isMonthlyPaymentCleared($student_id)
    {
        // Check Monthly Payment
        // Get the current month
        $current_month = date('F');

        $monthly_paymenttype = PaymentType::where('category', 'Monthly')
            ->where('payable_amount', '>', 0)
            ->whereHas('course.students', function ($query) use ($student_id) {
                $query->where('students.id', $student_id);
            })
            ->first();
        
        $is_cleared = false;
        if (!$monthly_paymenttype) {
            // Student is not involved in any class that has a monthly paymenttype
            $is_cleared = true;
        }
        else{

            $monthly_payments = Payment::where('student_id', $student_id)
                ->where('paymenttype_id', $monthly_paymenttype->id)
                ->where(function ($query) use ($current_month) {
                    $query->where('payment_status', 'Paid')
                        ->orWhere(function ($query) use ($current_month) {
                            $query->where('payment_status', 'Partial')
                                ->whereMonth('payment_date', date('m'))
                                ->whereYear('payment_date', date('Y'));
                        });
                })
                ->exists();

            $is_cleared = $monthly_payments;
        }

        return $is_cleared;
    }
    
    // Monthly Due of student
    public function getMonthlyDueAmount($student_id)
    {
        // Check Monthly Payment
        // Get the current month and year
        $current_month = date('m');
        $current_year = date('Y');

        // Get the monthly paymenttype for the student's course
        $monthly_paymenttype = PaymentType::where('category', 'Monthly')
            ->where('payable_amount', '>', 0)
            ->whereHas('course.students', function ($query) use ($student_id) {
                $query->where('students.id', $student_id);
            })
            ->first();

        $monthly_due_amount = 0;

        if ($monthly_paymenttype) {
            $paid_amount = Payment::where('student_id', $student_id)
                ->where('paymenttype_id', $monthly_paymenttype->id)
                ->whereIn('payment_status', ['Paid', 'Partial'])
                ->sum('amount_payed');
        
            $monthly_due_amount = $monthly_paymenttype->payable_amount - $paid_amount;
        }

        return $monthly_due_amount;
    }

    // One Time Due of student
    public function getOneTimeDueAmount($student_id)
    {
        $total_due_amount = 0;

        // Get all the payment types for the student's course
        $payment_types = PaymentType::where('category', 'One Time')
            ->whereHas('course.students', function ($query) use ($student_id) {
                $query->where('students.id', $student_id);
            })
            ->get();

        // Loop through each payment type and calculate the due amount
        foreach ($payment_types as $payment_type) {
            $total_payable_amount = $payment_type->payable_amount;

            // Check if any payment is made for the payment type
            $payment = Payment::where('student_id', $student_id)
                ->where('paymenttype_id', $payment_type->id)
                ->first();

            if ($payment) {
                $total_payable_amount -= $payment->amount_payed;
            }

            // Add the due amount for the payment type to the total due amount
            $total_due_amount += max(0, $total_payable_amount);
        }

        return $total_due_amount;
    }



    // Show single student
    public function show(Request $request, Student $student) {

        $monthly_cleared = $this->isMonthlyPaymentCleared($student->id);
        $monthly_due = $this->getMonthlyDueAmount($student->id);
        $one_time_due = $this->getOneTimeDueAmount($student->id);

        $payments = $student->payment;
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        if ($start_date) {
            $payments = $payments->where('payment_date', '>=', $start_date);
        }
        if ($end_date) {
            $payments = $payments->where('payment_date', '<=', $end_date);
        }

        $payment_status = $request->input('status');
        if(!empty($payment_status)){
            $payment_status = strtolower($payment_status);
            $payments = $payments->filter(function ($payment) use ($payment_status) {
                $paymentStatusInCollection = strtolower($payment->payment_status);
                return strpos($paymentStatusInCollection, $payment_status) !== false;
            });
        }
        $studentCourses = $student->course()->pluck('id');
        $paymenttypes = Paymenttype::whereIn('course_id', $studentCourses)->get();

        return view('students.show', [
            'student' => $student,
            // 'courses' => Course::oldest()->get(),
            'courses' => $student->course(),
            'institutes' => Institute::oldest()->get(),
            'batches' => Batch::all(),
            'payments' => $payments,
            'messages' => $student->sms->sortByDesc('id'),
            // 'paymenttypes' => Paymenttype::all(),
            'paymenttypes' => $paymenttypes,
            'monthly_cleared' => $monthly_cleared,
            'monthly_due' => $monthly_due,
            'one_time_due' => $one_time_due
        ]);
    }

    

    // Create Student View
    public function create(){
        return view('students.create', [
            'courses' => Course::oldest()->get(),
            'institutes' => Institute::oldest()->get()
        ]);
    }

    // Generate student id
    public function generate_id($gender__, $course__id, $institute__id){
        // Construct ID
        $classId = str_pad($course__id, 2, '0', STR_PAD_LEFT);
        $instituteId = str_pad($institute__id, 2, '0', STR_PAD_LEFT);
        $gender = 1; // Male
        if($gender__ == "Female") $gender = 2;

        // Generate the serial number based on classId, instituteId, and gender
        $serialNumber = Student::where('course_id', $classId)
            ->where('institute_id', $instituteId)
            ->where('gender', $gender__)
            ->count() + 1;

        $serialNumber = str_pad($serialNumber, 4, '0', STR_PAD_LEFT);
        
        // Construct the ID
        $id = "{$gender}{$classId}{$instituteId}{$serialNumber}";
        $id = intval($id);

        return $id;
    }

    // import student
    public function import(Request $request){

        $csvFile = fopen($request->file('csv_file')->getPathname(), 'r');
        
        $count = $payment_count = 0;

        // Read the CSV file row by row
        while (($data = fgetcsv($csvFile)) !== false) {
            // Skip the header row
            if ($data[0] == 'Name') {
                continue;
            }

            // Check if phone number already exists
            $phone_number = $data[1];
            if (Student::where('phone_number', $phone_number)->exists()) {
                continue;
            }

            // Find the class
            $class = Course::where('name', $data[6])->first();
            if (!$class) {
                continue;
            }

            // Find the institution
            $institution = Institute::where('name', $data[5])->first();
            if (!$institution) {
                continue;
            }

            // Find the batch
            $batch = Batch::where('name', $data[7])->first();
            if (!$batch) {
                $batch = null;
            }
            else{
                $batch = $batch->id;
            }

            // Create the student
            $student = new Student();
            $student->name = $data[0];
            $student->phone_number = $phone_number;
            $student->email = $data[2] ?? null;
            $student->parents_name = $data[3] ?? null;
            $student->parents_number = $data[4] ?? null;
            $student->institute_id = $institution->id;
            $student->course_id = $class->id;
            $student->batch_id = $batch;
            $student->gender = $data[8];
            $student->version = $data[9] ?? null;
            $student->blood_group = $data[10] ?? null;
            $student->status = 'Active';

            $student->id = $this->generate_id($data[8], $class->id, $institution->id);

            $student->save();
            $count++;
            // SEND MESSAGE
            $message = "Congratulations, {$student->name}. Welcome to world of  chemistry, Chemtor. Your ID is {$student->id}.";
            // $this->messageService->send_message($message, $student->id );

            // _------------_ Payment Section _--------------_
            $payment_type = Paymenttype::where('name', $data[11])->first();

            // dd($payment_type);
            if(!$payment_type){
                continue;
            }

            
            $amount_paid = $data[12];
            if(!is_numeric($amount_paid)){
                continue;
            }
            $amount_paid = (double) $amount_paid;
            
            $payment = new Payment();
            $payment->student_id = $student->id;
            $payment->paymenttype_id = $payment_type->id;
            $payment->payable_amount = $payment_type->payable_amount;
            $payment->amount_payed = $amount_paid;
            $payment->due_amount = $payment_type->payable_amount - $amount_paid;
            $payment->payment_date = now()->toDateString();

            if($payment_type->payable_amount == $amount_paid){
                $payment->payment_status = 'Paid';
            }
            else if ($amount_paid == 0){
                $payment->payment_status = 'Due';
            }
            else{
                $payment->payment_status = 'Partial';
            }
            $payment->save();
            $payment_count++;
            $message = 'Dear ' . $student->name . ', Your payment of ' . $amount_paid . '/- for ' . now()->toDateString() . ' has been adjusted. Due amount ' . $payment->due_amount . '/- . Thank you, Chemtor.';
            // $status = $this->messageService->send_message($message, $request['student_id']);
        }

        return redirect(route('students'))->with('success', $count. ' students imported! '.$payment_count.' payments processed!');

    }


    // Store Student Data
    public function store(Request $request) {

        $formFields = $request->validate([
            'name' => 'required',
            'phone_number' => 'required|unique:students,phone_number',
            'email' => 'nullable',
            'institute_id' => 'required',
            'course_id' => 'required',
            'batch_id' => 'nullable',
            'parents_name' => 'nullable',
            'parents_number' => 'nullable',
            'gender' => 'required',
            'version' => 'required',
            'blood_group' => 'nullable',
            'status' => 'required',
        ]);

        if($request->hasFile('profile_image')) {
            $formFields['profile_image'] = $request->file('profile_image')->store('profile_images', 'public');
        }

        // Set the ID in the form fields
        $id = $this->generate_id($request->input("gender"), $request->input('course_id'), $request->input('institute_id')); 
        $formFields['id'] = $id;

        Student::create($formFields);

        // SEND MESSAGE
        $message = "Congratulations, {$request->input("name")}. Welcome to world of  chemistry, Chemtor. Your ID is {$id}.";
        $this->messageService->send_message($message, $id);
        
        if($request->input('new_payment') !== "true"){
            unset($_SESSION['new_payment']);
            return redirect(route('students'))->with([
                'success' => 'Student saved successfully!',
                'studentId' => $id,
                'courseId' => $formFields['course_id']
            ]);
        }
        else{
            return redirect(route('students'))->with([
                'success' => 'Student created successfully!',
                'studentId' => $id,
                'courseId' => $formFields['course_id'],
                'new_payment' => $request->input('new_payment')
            ]);
        }

        
    }


    // Delete Course Data
    public function destroy(Request $request, Student $student) {
        $student->delete();
        return redirect(route('students'))->with('success', 'Student deleted successfully!');
    }


    // Edit Course View
    public function edit(Request $request, Student $student) {
        return view('students.edit', [
            'student' => $student,
            'courses' => Course::oldest()->get(),
            'institutes' => Institute::oldest()->get()
        ]);
    }

    // Update Student Data
    public function update(Request $request, Student $student) {
        $formFields = $request->validate([
            'name' => 'required',
            'email' => 'nullable',
            'institute_id' => 'required',
            'course_id' => 'required',
            'batch_id' => 'nullable',
            'parents_name' => 'nullable',
            'parents_number' => 'nullable',
            'gender' => 'required',
            'version' => 'required',
            'blood_group' => 'nullable',
            'status' => 'required',
        ]);

        if($request->hasFile('profile_image')) {
            $formFields['profile_image'] = $request->file('profile_image')->store('profile_images', 'public');
        }

        // dd($formFields);

        $student->update($formFields);
        return redirect(route('students'))->with('success', 'Student updated successfully!');
    }


    // Message Student
    public function message(Request $request, Student $student){
        $message = $request->input('message');
        $status = $this->messageService->send_message($message, $student['id']);
        return back()->with('success', $status);
    }


    // Message Students
    public function messages(Request $request){
        $message = $request->input('message');
        $status = $this->messageService->send_message($message, $request->input('id'));
        return back()->with('success', $status);
    }


    // Search Student
    public function search(Request $request)
    {
        $query = $request->get('q');
        $students = Student::where('id', 'LIKE', "%$query%")
                        ->orWhere('name', 'LIKE', "%$query%")
                        ->orWhere('phone_number', 'LIKE', "%$query%")
                        ->get();

        $options = $students->map(function($student) {
            return [
                'id' => $student->id,
                'text' => $student->name . ' | ' . $student->id,
                'course' => $student->course_id
            ];
        });

        return response()->json(['results' => $options]);
    }
}

?>