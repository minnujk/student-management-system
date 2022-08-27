@extends('layouts.main')
@section('content')
<div class="row">
<div class="col-sm-6" style="margin-top:120px;">

        <div class="row">
            <div class="col-sm-6">
                <h4>Edit Student Form</h4>
            </div>
        </div>

        <div style="margin-top:40px;">
            <form method="post" action="{{ route('student.update',$student->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name of the student</label>
                    <input type="text" class="form-control" name="name"  value="{{ $student->name}}" placeholder="Please enter name of the student" required />
                </div>

                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="number" class="form-control" name="age"  value="{{ $student->age}}" min="6" max="20" placeholder="Please enter age of the student" required />
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="" selected disabled>Please select Gender</option>
                        <option {{  $student->gender == "male" ? 'selected' : '' }} value="male">Male</option>
                        <option {{  $student->gender == "female" ? 'selected' : '' }} value="female">Female</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="reporting_staff">Reporting Teacher:</label>
                    <select class="form-control" id="reporting_staff"  name="reporting_staff" required>
                        <option value="" selected disabled>Please select repoting teacher</option>
                        @foreach($staffs as $staff)
                        <option  {{  $student->reporting_staff == $staff ? 'selected' : '' }} value="{{$staff}}">{{ucfirst($staff)}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection