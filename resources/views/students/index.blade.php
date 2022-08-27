@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12" style="margin-top:120px;">

        <div class="row">
            <div class="col-sm-4">
                <h4>All students</h4>
            </div>
            <div class="col-sm-8">
                <a style="float:right;" href="{{ route('student.create')}}" class="btn btn-success"> Add student</a>
            </div>
        </div>
        
   
        
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <table class="table table-striped"  style="margin-top:80px;">
            @if(count($students))
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Age</td>
                    <td>Gender</td>
                    <td>Reporting Teacher</td>
                    <td colspan=2>Actions</td>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td>{{$student->id}}</td>
                    <td>{{$student->name}}</td>
                    <td>{{$student->age}}</td>
                    <td>{{ucfirst(substr($student->gender,0, 1))}}</td>
                    <td>{{ucfirst($student->reporting_staff)}}</td>
                    <td>
                        <a href="{{ route('student.edit',$student->id)}}" class="btn btn-info">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('student.destroy', $student->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            @else
            <p style="text-align:center;">No records found</p>

            @endif
        </table>
        <div>
        </div>
        @endsection