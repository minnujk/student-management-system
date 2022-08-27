<?php

namespace App\Repositories;

use App\Models\Student;

class StudentRepository
{
    public function getAllstudents() 
    {
        return Student::all();
    }

    public function getStudentById($studentId) 
    {
        return Student::findOrFail($studentId);
    }

    public function deletestudent($studentId) 
    {
        $student = Student::find($studentId);
        return $student->delete();
    }

    public function createstudent(array $studentDetails) 
    {
        $student = new Student($studentDetails);
        return $student->save();
    }

    public function updatestudent($studentId, array $newDetails) 
    {
        return Student::whereId($studentId)->update($newDetails);
    }

}