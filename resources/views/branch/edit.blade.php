@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-12">
            <h3>Edit Branch</h3>
            <form action="{{ route('branch_update') }}" method="POST" enctype="multipart/form-data">
                @CSRF
                @foreach ($branches as $branch)
                    <div class="form-group">
                        <input type="hidden" name="branchId" value="{{ $branch->id }}">
                        <label for="branchName">Branch Name</label>
                        <input class="form-control" type="text" id="branchName" name="branchName"
                            value="{{ $branch->name }}" requiered>

                        <label for="branchAddress">Address</label>
                        <input class="form-control" type="text" id="branchAddress" name="branchAddress"
                            value="{{ $branch->address }}" requiered>

                        <label for="branchDescription">Description</label>
                        <input class="form-control" type="text" id="branchDescription" name="branchDescription"
                            value="{{ $branch->description }}" requiered>
                        <label for="branchImage">Image</label>
                        <input class="form-control" type="file" id="branchImage" name="branchImage">
                    </div>

                    <button type="submit" class="btn btn-primary">Edit Branch</button>
                @endforeach
            </form>
        </div>
    </div>
@endsection
