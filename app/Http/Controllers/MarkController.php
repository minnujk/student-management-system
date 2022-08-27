<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MarkRepository;
use App\Repositories\StudentRepository;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;


class MarkController extends Controller
{


    private  $markRepo;
    private  $studentRepo;

    const TERMS = ['one', 'two', 'three'];

    public function __construct(MarkRepository $markRepo, StudentRepository  $studentRepo)
    {
        $this->markRepo = $markRepo;
        $this->studentRepo = $studentRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marks = $this->markRepo->getAllmarks();
        return view('marks.index', compact('marks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = $this->studentRepo->getAllstudents();
        $terms = self::TERMS;
        return view('marks.create', compact('students', 'terms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validatedData = $request->validate(
            [
                'student_id' => [
                    'required', Rule::unique('marks')
                        ->where('term', $request->get('term'))
                ],
                'maths' => 'required|integer|min:0',
                'science' => 'required|integer|min:0',
                'history' => 'required|integer|min:0',
                'term' => 'required'
            ],
            [
                'student_id.unique' => 'Student mark for the selected term exist',
            ]
        );


        $studentMarkDetails = [
            'student_id' => $request->get('student_id'),
            'term' => $request->get('term'),
            'maths' => $request->get('maths'),
            'science' => $request->get('science'),
            'history' => $request->get('history')
        ];

        $reponse =  $this->markRepo->createMark($studentMarkDetails);
        return redirect('/marks')->with('success', 'Mark added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mark = $this->markRepo->getMarkById($id);
        $students = $this->studentRepo->getAllstudents();
        $terms = self::TERMS;
        return view('marks.edit', compact('mark', 'students', 'terms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate(
            [
                'student_id' => [
                    'required', Rule::unique('marks')->ignore($id)->where('term',  $request->get('term'))
                ],
                'term' => 'required',
                'maths' => 'required|integer|min:0',
                'science' => 'required|integer|min:0',
                'history' => 'required|integer|min:0',
            ],
            [
                'student_id.unique' => 'Student mark for the selected term exist',
            ]
        );
        $updateDetails = [
            'student_id' => $request->get('student_id'),
            'term' => $request->get('term'),
            'maths' => $request->get('maths'),
            'science' => $request->get('science'),
            'history' => $request->get('history')
        ];
        $reponse =  $this->markRepo->updatemark($id, $updateDetails);
        return redirect('/marks')->with('success', 'Mark record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->markRepo->deletemark($id);
        return redirect('/marks')->with('success', 'Mark deleted successfully');
    }
}
