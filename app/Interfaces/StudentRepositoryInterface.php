<?php

namespace App\Interfaces;

interface StudentRepositoryInterface 
{
    public function getAllStudents();
    public function createStudent(array $studentDetails);
    public function getStudentById($studentId);
    public function updateStudent($studentId, array $newDetails);
    public function deleteStudent($studentId);
}