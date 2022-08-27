<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\StudentRepository;


class StudentController extends Controller
{

    const STAFFS = ['Kaite', 'Max'];
    private  $studentRepo;

    public function __construct(StudentRepository $studentRepo) 
    {
        $this->studentRepo= $studentRepo;
    }
    


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = $this->studentRepo->getAllstudents();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staffs = self::STAFFS;
        return view('students.create', compact('staffs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name'=>'required',
            'age'=>'required|integer|min:6',
            'gender'=>'required',
            'reporting_staff'=>'required'
        ]);
        
        $studentDetails = [
            'name' => $request->get('name'),
            'age' => $request->get('age'),
            'gender' => $request->get('gender'),
            'reporting_staff' => $request->get('reporting_staff')
        ];

        $reponse =  $this->studentRepo->createStudent($studentDetails);
        return redirect('/students')->with('success', 'Student added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = $this->studentRepo->getStudentById($id);
        $staffs= self::STAFFS;
        return view('students.edit', compact('student','staffs'));    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $updateDetails = [
            'name' => $request->get('name'),
            'age' => $request->get('age'),
            'gender' => $request->get('gender'),
            'reporting_staff' => $request->get('reporting_staff')
        ];
        $reponse =  $this->studentRepo->updatestudent($id,$updateDetails);
        return redirect('/students')->with('success', 'Student record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->studentRepo->deletestudent($id);
        return redirect('/students')->with('success', 'Student deleted!');
    }
}
