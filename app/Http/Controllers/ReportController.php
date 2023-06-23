<?php

namespace App\Http\Controllers;


use DateTime;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Institute;
use App\Models\Paymenttype;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller{
    
    // Show all students
    public function index(Request $request) {
        // STUDENT COUNT PER COURSE
        $studentsCountPerCourse = DB::table('students')
            ->join('courses', 'students.course_id', '=', 'courses.id')
            ->select('courses.name as course_name', DB::raw('count(*) as total_students'))
            ->groupBy('students.course_id', 'courses.name')
            ->get();

        $student_per_course_labels = [];
        $student_per_course_data = [];
        foreach ($studentsCountPerCourse as $row) {
            $student_per_course_labels[] = $row->course_name;
            $student_per_course_data[] = $row->total_students;
        }


        // STUDENT COUNT PER INSTITUTION
        $studentsCountPerInstitution = DB::table('students')
            ->join('institutes', 'students.institute_id', '=', 'institutes.id')
            ->select('institutes.name as institute_name', DB::raw('count(*) as total_students'))
            ->groupBy('students.institute_id', 'institutes.name')
            ->get();

        // Prepare data for chart
        $student_per_institute_labels = [];
        $student_per_institute_data = [];
        foreach ($studentsCountPerInstitution as $row) {
            $student_per_institute_labels[] = $row->institute_name;
            $student_per_institute_data[] = $row->total_students;
        }


        // Total Students
        $studentCount = Student::count();

        // Total classes
        $courseCount = Course::count();

        $fromMonth = $request->input('fromMonth', date('m'));
        $toMonth = $request->input('toMonth', date('m'));
        $fromYear = $request->input('fromYear', date('Y'));
        $toYear = $request->input('toYear', date('Y'));

        $payments = DB::table('payments')
        ->join('students', 'students.id', '=', 'payments.student_id')
        ->whereMonth('payment_date', '>=', $fromMonth)
        ->whereMonth('payment_date', '<=', $toMonth)
        ->whereYear('payment_date', '>=', $fromYear)
        ->whereYear('payment_date', '<=', $toYear);

        if(request('course')){
            $payments = $payments->where('students.course_id', request('course'));
        }

        
        if (request('institute')) {
            $payments = $payments->where('students.institute_id', request('institute'));
        }
        
        if (request('batch')) {
            $payments = $payments->where('students.batch_id', request('batch'));
        }
        
        if (request('version')) {
            $payments = $payments->where('students.version', request('version'));
        }
        
        if (request('gender')) {
            $payments = $payments->where('students.gender', request('gender'));
        }

        if (request('fee')) {
            $payments = $payments->where('paymenttype_id', request('fee'));
        }
        $totalPayment = $payments->get()->sum('amount_payed');


        

        // ------------ New Calculation 
        
        $students = Student::with(['institute', 'course'])
            ->orderBy('created_at', 'desc')
            ->get();
        
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

        // $totalDuePayment = 0;
        // if(request('fee')){
        //     $currentMonth = date('Y-m');

        //     foreach ($students as $student) {
        //         $paymentType = $student->course->paymentTypes()
        //             ->where('id', request('fee'))
        //             ->first();

        //         $student->due = 0;

        //         if ($paymentType) {
        //             if ($paymentType->category === 'Monthly') {
        //                 $payment = $student->payment()
        //                     ->where('paymenttype_id', $paymentType->id)
        //                     ->whereYear('payment_date', '=', date('Y'))
        //                     ->whereMonth('payment_date', '=', date('m'))
        //                     ->first();

        //                 if (!$payment) {
        //                     $student->due = $paymentType->payable_amount;
        //                     $totalDuePayment += $student->due;
        //                 }
        //             } elseif ($paymentType->category === 'One time') {

        //                 $payment = $student->payment()
        //                     ->where('paymenttype_id', $paymentType->id)
        //                     ->first();

        //                 if (!$payment) {
        //                     $student->due = $paymentType->payable_amount;
        //                     $totalDuePayment += $student->due;
        //                 }
        //             }
        //         }
        //     }
        // }
        // else{
        //     $paymenttypes = Paymenttype::all();

        //     foreach($paymenttypes as $paymentType){

        //         foreach ($students as $student) {
                
        //             $student->due = 0;

        //             if ($paymentType) {
        //                 if ($paymentType->category === 'Monthly') {
        //                     $payment = $student->payment()
        //                         ->where('paymenttype_id', $paymentType->id)
        //                         ->whereYear('payment_date', '=', date('Y'))
        //                         ->whereMonth('payment_date', '=', date('m'))
        //                         ->first();

        //                     if (!$payment) {
        //                         $student->due = $paymentType->payable_amount;
        //                         $totalDuePayment += $student->due;
        //                     }
        //                 } elseif ($paymentType->category === 'One time') {

        //                     $payment = $student->payment()
        //                         ->where('paymenttype_id', $paymentType->id)
        //                         ->first();

        //                     if (!$payment) {
        //                         $student->due = $paymentType->payable_amount;
        //                         $totalDuePayment += $student->due;
        //                     }
        //                 }
        //             }
        //         }
        //     }

        // }

        $totalDuePayment = 0;

        if (request('fee')) {
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
                            $totalDuePayment += $student->due;
                        }
                    } elseif ($paymentType->category === 'One time') {

                        $payment = $student->payment()
                            ->where('paymenttype_id', $paymentType->id)
                            ->first();

                        if (!$payment) {
                            $student->due = $paymentType->payable_amount;
                            $totalDuePayment += $student->due;
                        }
                    }
                }
            }
        } else {
            $paymenttypes = Paymenttype::whereIn('course_id', $students->pluck('course_id'))->get();

            foreach ($students as $student) {
                $student->due = 0;

                foreach ($paymenttypes as $paymentType) {
                    if ($paymentType->category === 'Monthly') {
                        $payment = $student->payment()
                            ->where('paymenttype_id', $paymentType->id)
                            ->whereYear('payment_date', '=', date('Y'))
                            ->whereMonth('payment_date', '=', date('m'))
                            ->first();

                        if (!$payment) {
                            $student->due += $paymentType->payable_amount;
                            $totalDuePayment += $paymentType->payable_amount;
                        }
                    } elseif ($paymentType->category === 'One time') {

                        $payment = $student->payment()
                            ->where('paymenttype_id', $paymentType->id)
                            ->first();

                        if (!$payment) {
                            $student->due += $paymentType->payable_amount;
                            $totalDuePayment += $paymentType->payable_amount;
                        }
                    }
                }
            }
        }


        $studentCount = $students->count();
    
        $courses = Course::all();
        $institutes = Institute::all();
        $batches = Batch::all();

        $paymenttypes = Paymenttype::all();

        return view('Dashboard.index', compact(
            'student_per_institute_labels', 
            'student_per_institute_data', 
            'student_per_course_labels', 
            'student_per_course_data',

            'studentCount',
            'courseCount',
            'totalPayment',
            'totalDuePayment',
            // 'totalMonthyDuePayment',

            // 'payment_per_course_labels',
            // 'payment_per_course_data',
            // 'due_per_course_labels',
            // 'due_per_course_data',

            'courses',
            'institutes',
            'batches',
            'paymenttypes'

        ));
    }
}

?>