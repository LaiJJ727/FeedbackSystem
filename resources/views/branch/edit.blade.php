@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-12">
            <h3>Edit Branch</h3>
            <form action="{{ route('branch_update') }}" method="POST" enctype="multipart/form-data">
                @CSRF
                @foreach ($branches as $branch)
                    <div class="form-group">
                        <label for="branchName">Branch Name</label>
                        <input class="form-control  @error('branchName') is-invalid @enderror" type="text" id="branchName"
                            name="branchName" value="{{ $branch->name}}">
                        @error('branchName')
                            <span class="invalid-message" style="color:red;" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <br>
                        <label for="branchAddress">Address</label>
                        <input class="form-control @error('branchAddress') is-invalid @enderror" type="text"
                            id="branchAddress" name="branchAddress" value="{{ $branch->address }}">
                        @error('branchAddress')
                            <span class="invalid-message" style="color:red;" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <br>
                        <label for="branchDescription">Description</label>
                        <input class="form-control" type="text" id="branchDescription" name="branchDescription" value="{{ $branch->description}}">
                        <br>
                        <label for="branchImage">Image</label>
                        <input class="form-control @error('branchImage') is-invalid @enderror" type="file"
                            id="branchImage" name="branchImage">
                        @error('branchImage')
                            <span class="invalid-message" style="color:red;" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Edit Branch</button>
                @endforeach
            </form>
        </div>
    </div>
@endsection
