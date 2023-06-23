<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Message;
use App\Models\Institute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name', 'profile_image', 'email', 'phone_number', 'parents_name', 'parents_number', 'institute_id', 'course_id', 'batch_id', 'gender', 'version', 'blood_group', 'status'];
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class, 'institute_id');
    }
    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }

    public function payment()
    {
        return $this->hasMany(Payment::class, "student_id");
    }

    public function sms()
    {
        return $this->hasMany(Message::class, "student_id");
    }
}
