@extends('layouts.main')
@section('content')
<div class="row">
<div class="col-sm-6" style="margin-top:120px;">

        <div class="row">
            <div class="col-sm-6">
                <h4>Add Student Form</h4>
            </div>
        </div>

        <div style="margin-top:40px;">
            <form method="POST" action="{{ route('student.store') }}">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="name">Name of the student</label>
                    <input type="text" class="form-control" name="name" placeholder="Please enter name of the student" required />
                </div>

                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="number" class="form-control" name="age" min="6" placeholder="Please enter age of the student" required />
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="" selected disabled>Please select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="reporting_staff">Reporting Teacher:</label>
                    <select class="form-control" id="reporting_staff"  name="reporting_staff" required>
                        <option value="" selected disabled>Please select repoting teacher</option>
                        @foreach($staffs as $staff)
                        <option value="{{$staff}}">{{ucfirst($staff)}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection