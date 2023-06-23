<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Student;
use App\Models\Institute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Batch extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'course_id', 'capacity', 'batch_time', 'version'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function student()
    {
        return $this->hasMany(Student::class, "batch_id");
    }
}
