@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-12">
            <h3>更改分行 Edit Branch</h3>
            <form action="{{ route('branch_update') }}" method="POST" enctype="multipart/form-data">
                @CSRF
                @foreach ($branches as $branch)
                    <div class="form-group">
                        <input type="hidden" name="branchId" value="{{ $branch->id }}">
                        <label for="branchName">分行名称 Branch Name</label>
                        <input class="form-control  @error('branchName') is-invalid @enderror" type="text"
                            id="branchName" name="branchName" value="{{ $branch->name }}">
                        @error('branchName')
                            <span class="invalid-message" style="color:red;" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            <br>
                        @enderror
                        <label for="branchAddress">地址 Address</label>
                        <input class="form-control @error('branchAddress') is-invalid @enderror" type="text"
                            id="branchAddress" name="branchAddress" value="{{ $branch->address }}">
                        @error('branchAddress')
                            <span class="invalid-message" style="color:red;" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            <br>
                        @enderror
                        <label for="branchDescription">描述 Description</label>
                        <input class="form-control" type="text" id="branchDescription" name="branchDescription"
                            value="{{ $branch->description }}">
                        <br>
                        <label for="branchImage">图片 Image</label>
                        <input class="form-control @error('branchImage') is-invalid @enderror" type="file"
                            id="branchImage" name="branchImage">
                        @error('branchImage')
                            <span class="invalid-message" style="color:red;" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">提交 Submit</button>
                @endforeach
            </form>
        </div>
    </div>
@endsection
