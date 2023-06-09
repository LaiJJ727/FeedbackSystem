@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-12">
            <h3>更改地点 Edit Place</h3>
            <form action="{{ route('place_update') }}" method="POST" enctype="multipart/form-data">
                @CSRF
                @foreach ($places as $place)
                    <div class="form-group">
                        <input type="hidden" name="placeId" value="{{ $place->id }}">
                        <label for="branch">分行 Branch</label>
                        <select name="branch" id="branch" class="form-control @error('branch') is-invalid @enderror"
                            value="{{ $place->branch_id }}">
                            @foreach ($branches as $branch)
                                @if ($place->branch_id == $branch->id)
                                    <option value="{{ $branch->id }}"selected>{{ $branch->name }}</option>
                                @else
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('branch')
                            <span class="invalid-message" style="color:red;" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            <br>
                        @enderror
                        <label for="zone">区 Zone</label>
                        <select name="zone" id="zone" class="form-control @error('zone') is-invalid @enderror"
                            value="{{ $place->zone_id }}">
                            @foreach ($zones as $zone)
                                @if ($place->zone_id == $zone->id)
                                    <option value="{{ $zone->id }}" selected>{{ $zone->c_name }} {{ $zone->e_name }}
                                    </option>
                                @else
                                    <option value="{{ $zone->id }}">{{ $zone->c_name }} {{ $zone->e_name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('zone')
                            <span class="invalid-message" style="color:red;" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            <br>
                        @enderror
                        <label for="placeCnName">中文地点名称 Chinese Place Name</label>
                        <input class="form-control @error('placeCnName') is-invalid @enderror" type="text"
                            id="placeCnName" name="placeCnName" value="{{ $place->c_name }}" required>
                        @error('placeCnName')
                            <span class="invalid-message" style="color:red;" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            <br>
                        @enderror
                        <label for="placeEngName">英文地点名称 English Place Name</label>
                        <input class="form-control @error('placeEngName') is-invalid @enderror" type="text"
                            id="placeEngName" name="placeEngName" value="{{ $place->e_name }}">
                        @error('placeEngName')
                            <span class="invalid-message" style="color:red;" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            <br>
                        @enderror
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
                @endforeach
            </form>
        </div>
    </div>
@endsection
