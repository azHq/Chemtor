<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paymenttype extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'course_id', 'category', 'payable_amount'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
