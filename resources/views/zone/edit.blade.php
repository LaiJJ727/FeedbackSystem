@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-12">
            <h3>更改区 Edit Zone</h3>
            <form action="{{ route('zone_update') }}" method="POST" enctype="multipart/form-data">
                @CSRF
                @foreach ($zones as $zone)
                    <div class="form-group">
                        <input type="hidden" name="zoneId" value="{{ $zone->id }}">
                        <div class="form-group">
                            <label for="zoneCnName">中文区名 Chinese Zone Name</label>
                            <input class="form-control  @error('zoneCnName') is-invalid @enderror" type="text"
                                id="zoneCnName" name="zoneCnName"  value="{{ $zone->c_name }}">
                            @error('zoneCnName')
                                <span class="invalid-message" style="color:red;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                <br>
                            @enderror
                            <label for="zoneEngName">英文区名 English Zone Name</label>
                            <input class="form-control" type="text" id="zoneEngName" name="zoneEngName" 
                                value="{{ $zone->e_name }}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">提交 Submit</button>
                @endforeach
            </form>
        </div>
    </div>
@endsection
