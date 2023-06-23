<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'message', 'status_code', 'status'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
