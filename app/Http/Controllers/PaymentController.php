<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Paymenttype;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;
use App\Services\MessageService;


Builder::macro('whereLike', function(string $column, string $search) {
   return $this->orWhere($column, 'LIKE', '%'.$search.'%');
});

class PaymentController extends Controller{
    protected $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    // Show all institutes
    public function index(Request $request) {
        $payments = [];

        if(request('search')) {
            $searchValue = '%' . request('search') . '%';
            // dd($searchValue);
            $payments = Payment::where('payment_status', 'LIKE', $searchValue)
                    ->orWhereHas('student', function ($query) use ($searchValue) {
                        $query->where('name', 'LIKE', $searchValue)
                            ->orWhere('phone_number', 'LIKE', $searchValue)
                            ->orWhere('id', 'LIKE', $searchValue)
                            ->orWhereHas('course', function ($query) use ($searchValue) {
                                $query->where('name', 'LIKE', $searchValue);
                            });
                    })
                    ->get();
        }
        else{
            $payments = Payment::with(['student', 'paymenttype'])
                            ->orderBy('created_at', 'desc')
                            ->get();
        }


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

        return view('payments.index', [
            'payments' => $payments,
            'paymenttypes' => Paymenttype::oldest()->get(),
            'students' => Student::get()
        ]);
    }

    // Store Listing Data
    public function store(Request $request) {
        
        $formFields = $request->validate([
            'student_id' => 'required',
            'paymenttype_id' => 'required',
            'payable_amount' => 'required|numeric',
            'amount_payed' => 'required|numeric',
            'due_amount' => 'required|numeric',
            'payment_date' => 'required',
            'payment_status' => 'required|in:Paid,Unpaid,Partial'
        ]);

        Payment::create($formFields);

        // Message
        $student = Student::find($request['student_id']);
        $message = 'Dear ' . $student->name . ', Your payment of ' . $request['amount_payed'] . '/- for ' . $request['payment_date'] . ' has been received. Due amount ' . $request['due_amount'] . '/- . Thank you, Chemtor.';
        $status = $this->messageService->send_message($message, $request['student_id']);

        return back()->with('success', 'Payment submitted successfully!')->withErrors($formFields);
    }

    // Update Course Data
    public function update(Request $request, Payment $payment) {
        // dd($request);
        
        $formFields = $request->validate([
            'student_id' => 'required',
            'paymenttype_id' => 'required',
            'payable_amount' => 'required|numeric',
            'amount_payed' => 'required|numeric',
            'due_amount' => 'required|numeric',
            'payment_date' => 'required',
            'payment_status' => 'required|in:Paid,Unpaid,Partial'
        ]);


        $payment->update($formFields);

        // Message
        $student = Student::find($request['student_id']);
        $message = 'Dear ' . $student->name . ', Your payment of ' . $request['amount_payed'] . '/- for ' . $request['payment_date'] . ' has been adjusted. Due amount ' . $request['due_amount'] . '/- . Thank you, Chemtor.';
        $status = $this->messageService->send_message($message, $request['student_id']);


        return back()->with('success', 'Payment updated successfully!')->withErrors($formFields);
    }
}

?>