@extends('layouts.app')
@section('content')
    <div class="container col-sm-12  mt-3">
        <h3>Add New Title</h3>
        <form action="{{ route('title_add') }}" method="POST" enctype="multipart/form-data">
            @CSRF
            <div class="form-group">
                <label for="titleName">Title Name</label>
                <input class="form-control" type="text" id="titleName" name="titleName">
            </div>

            <button type="submit" class="btn btn-primary">Add New Title</button>
        </form>
        <div>
@endsection
