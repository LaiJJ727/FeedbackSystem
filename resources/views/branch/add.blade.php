@extends('layouts.app')
@section('content')
    <div class="container col-sm-12   mt-3">
        <h3>Add New Branch</h3>
        <form action="{{ route('branch_add') }}" method="POST" enctype="multipart/form-data">
            @CSRF
            <div class="form-group">
                <label for="branchName">Branch Name</label>
                <input class="form-control" type="text" id="branchName" name="branchName" requiered>


                <label for="branchAddress">Address</label>
                <input class="form-control" type="text" id="branchAddress" name="branchAddress" requiered>


                <label for="branchDescription">Description</label>
                <input class="form-control" type="text" id="branchDescription" name="branchDescription" requiered>

                <label for="branchImage">Image</label>
                <input class="form-control" type="file" id="branchImage" name="branchImage">
            </div>

            <button type="submit" class="btn btn-primary">Add New Branch</button>
        </form>
        <div>
        @endsection
