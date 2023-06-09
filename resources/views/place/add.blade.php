@extends('layouts.app')
@section('content')
    <div class="container col-sm-12 mt-3">
        <h3>添加新的地点 Add New Place</h3>
        <form action="{{ route('place_add') }}" method="POST" enctype="multipart/form-data">
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
                <label for="zone">区 Zone</label>
                 <select name="zone" id="zone" class="form-control @error('zone') is-invalid @enderror"> 
                    @foreach ($zones as $zone)
                        <option value="{{ $zone->id }}">{{ $zone->c_name }} {{$zone->e_name}}</option>
                    @endforeach
                </select>
                @error('zone')
                    <span class="invalid-message" style="color:red;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror
                <label for="placeCnName">中文地点名称 Chinese Place Name</label>
                <input class="form-control  @error('placeCnName') is-invalid @enderror" type="text" id="placeCnName"
                    name="placeCnName" value="{{ old('placeCnName') }}">
                @error('placeCnName')
                    <span class="invalid-message" style="color:red;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror
                <label for="placeEngName">英文地点名称 English Place Name</label>
                <input class="form-control" type="text" id="placeEngName" name="placeEngName"
                    value="{{ old('placeEngName') }}">
                <label for="placeImage">图片 Image</label>
                <input type="file" name="placeImage" id="placeImage" class="form-control" />
                @error('placeImage')
                    <span class="invalid-message" style="color:red;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Add New Place</button>
        </form>
        <div>
        @endsection
