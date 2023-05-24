@extends('layouts.app')
@section('content')
    <div class="container col-sm-12   mt-3">
        <h3>Add New Branch</h3>
        <form action="{{ route('branch_add') }}" method="POST" enctype="multipart/form-data">
            @CSRF
            <div class="form-group">
                <label for="branchName">Branch Name</label>
                <input class="form-control  @error('branchName') is-invalid @enderror" type="text" id="branchName"
                    name="branchName" value="{{ old('branchName') }}">
                @error('branchName')
                    <span class="invalid-message" style="color:red;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror
                <label for="branchAddress">Address</label>
                <input class="form-control @error('branchAddress') is-invalid @enderror" type="text" id="branchAddress"
                    name="branchAddress" value="{{ old('branchAddress') }}">
                @error('branchAddress')
                    <span class="invalid-message" style="color:red;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror
                <br>
                <label for="branchDescription">Description</label>
                <input class="form-control" type="text" id="branchDescription" name="branchDescription">
                <br>
                <label for="branchImage">Image</label>
                <input class="form-control @error('branchImage') is-invalid @enderror" type="file" id="branchImage"
                    name="branchImage">
                @error('branchImage')
                    <span class="invalid-message" style="color:red;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Add New Branch</button>
        </form>
        <div>
        @endsection
