<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Institute extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'type'];

    public function students()
    {
        return $this->hasMany(Student::class, 'institute_id');
    }
}
