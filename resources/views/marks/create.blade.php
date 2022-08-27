@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-6" style="margin-top:120px;">

        <div class="row">
            <div class="col-sm-6">
                <h4>Add Student Mark Form</h4>
            </div>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
        @endif

        <div style="margin-top:40px;">
            <form method="POST" action="{{ route('mark.store') }}">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="student">Student</label>
                    <select class="form-control" id="student" name="student_id" required>
                        <option value="" selected disabled>Please select a student</option>
                        @foreach($students as $student)
                        <option value="{{$student->id}}">{{$student->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="term">Term</label>
                    <select class="form-control" id="term" name="term" required>
                        <option value="" selected disabled>Please select term</option>
                        @foreach($terms as $term)
                        <option value="{{$term}}">{{$term}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="age">Marks of Maths</label>
                    <input type="number" class="form-control" name="maths" min="0" placeholder="Please enter marks of Maths" required />
                </div>

                <div class="form-group">
                    <label for="age">Marks of Science</label>
                    <input type="number" class="form-control" name="science" min="0" placeholder="Please enter marks of Science " required />
                </div>

                <div class="form-group">
                    <label for="age">Marks of History</label>
                    <input type="number" class="form-control" name="history" min="0" placeholder="Please enter marks of History" required />
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection