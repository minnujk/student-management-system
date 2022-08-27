@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12" style="margin-top:120px;">

        <div class="row">
            <div class="col-sm-4">
                <h4>Mark List</h4>
            </div>
            <div class="col-sm-8">
                <a style="float:right;" href="{{ route('mark.create')}}" class="btn btn-success"> Add mark</a>
            </div>
        </div>

        @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div>
  @endif  
        
   
        
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <table class="table table-striped"  style="margin-top:80px;">
            @if(count($marks))
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Maths</td>
                    <td>Science</td>
                    <td>History</td>
                    <td>Term</td>
                    <td>Total Marks</td>
                    <td>Created on</td>
                    <td colspan=2>Actions</td>
                </tr>
            </thead>
            <tbody>
                @foreach($marks as $mark)
                <tr>
                    <td>{{$mark->id}}</td>
                    <td>{{$mark->student->name }}</td>
                    <td>{{$mark->maths}}</td>
                    <td>{{$mark->science}}</td>
                    <td>{{$mark->history}}</td>
                    <td>{{ucfirst($mark->term)}}</td>
                    <td>{{$mark->maths+$mark->science+$mark->history}}</td>
                    <td>{{   date_format($mark->created_at,"M d, Y H:i A")}}</td>
                    <td>
                        <a href="{{ route('mark.edit',$mark->id)}}" class="btn btn-info">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('mark.destroy', $mark->id)}}" method="post">
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