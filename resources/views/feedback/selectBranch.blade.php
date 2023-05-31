@extends('layouts.app')
@section('content')
    <div class="container col-sm-12   mt-3">
        <h3 class="text-center">选择分行 Select Branch</h3>
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-touch="false">
            <div class="carousel-inner">
                @foreach ($branches as $key => $branch)
                    @if (Auth::user()->branch_id == 'all')
                        @if ($key == 0)
                            <div class="carousel-item active">
                            @else
                                <div class="carousel-item">
                        @endif
                    @else
                        @if (count($branch) >= 2)
                            @if ($branch[0]['id'] == Auth::user()->branch_id || $branch[1]['id'] == Auth::user()->branch_id)
                                <div class="carousel-item active">
                                @else
                                    <div class="carousel-item">
                            @endif
                        @else
                            @if ($branch[0]['id'] == Auth::user()->branch_id)
                                <div class="carousel-item active">
                                @else
                                    <div class="carousel-item">
                            @endif
                        @endif
                    @endif
                    <div class="row text-center">
                        <div class="col-2">
                        </div>
                        @foreach ($branch as $data)
                        {{-- slides-effect @if ($data['id'] == Auth::user()->branch_id) select @endif --}}
                            <div class="col-4">
                                <a class="slides-effect @if ($data['id'] == Auth::user()->branch_id) select @endif --}}"
                                    href="{{ route('feedback_add_view', ['id' => $data['id']]) }}">
                                        <img class="text-center d-block w-100 h-75"
                                            src="{{ asset('branch_images') }}/{{ $data['image'] ? $data['image'] : 'null.png' }}">
                                        <div class="text-center ">{{ $data['name'] }}</div>
                                </a>
                            </div>
                        @endforeach
                        <div class="col-2">
                        </div>
                    </div>
            </div>
            @endforeach
        </div>
    </div>
    <a class="carousel-control-prev py-2" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon rounded" aria-hidden="true"
            style="background-color:black !important"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next py-2" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon rounded" aria-hidden="true"
            style="background-color:black !important"></span>
        <span class="sr-only">Next</span>
    </a>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            $('.carousel').carousel({
                interval: false,
                wrap: false,
            });
        });
    </script>
@endsection
