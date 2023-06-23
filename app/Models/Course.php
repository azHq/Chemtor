<?php

namespace App\Models;

use App\Models\Batch;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function students()
    {
        return $this->hasMany(Student::class, "course_id");
    }

    public function batches()
    {
        return $this->hasMany(Batch::class, "course_id");
    }

    public function paymentTypes()
    {
        return $this->hasMany(Paymenttype::class, "course_id");
    }
}
