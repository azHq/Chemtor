<?php

namespace App\Models;

use App\Models\Student;
use App\Models\Paymenttype;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'paymenttype_id', 'payable_amount', 'amount_payed', 'due_amount', 'payment_status', 'payment_date'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function paymenttype()
    {
        return $this->belongsTo(Paymenttype::class, 'paymenttype_id');
    }
}
