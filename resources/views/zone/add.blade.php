@extends('layouts.app')
@section('content')
    <div class="container col-sm-12   mt-3">
        <h3>加新的区 Add New Zone</h3>
        <form action="{{ route('zone_add') }}" method="POST" enctype="multipart/form-data">
            @CSRF
            <div class="form-group">
                <label for="branch">分行 Branch</label>
                <select name="branch" id="branch" class="form-control @error('branch') is-invalid @enderror">
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
                @error('branch')
                    <span class="invalid-message" style="color:red;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror
                <label for="zoneCnName">中文区名 Chinese Zone Name</label>
                <input class="form-control  @error('zoneCnName') is-invalid @enderror" type="text" id="zoneCnName"
                    name="zoneCnName" value="{{ old('zoneCnName') }}">
                @error('zoneCnName')
                    <span class="invalid-message" style="color:red;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror
                <label for="zoneEngName">英文区名 English Zone Name</label>
                <input class="form-control" type="text" id="zoneEngName" name="v" value="{{ old('zoneEngName') }}">
            </div>
            <button type="submit" class="btn btn-primary">提交 Submit</button>
        </form>
        <div>
        @endsection
