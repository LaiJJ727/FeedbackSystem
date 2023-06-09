@extends('layouts.app')
@section('styles')
@endsection

@section('content')
    <div class="container py-2">
        <div class="row" style="background-color:white">
            <div class="card-header">
                <div class="input-group table_header_body">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control clear-border" id="searchKey"
                        placeholder="搜索反馈ID Search by feedback ID" onkeyup="searchFunction()"
                        aria-describedby="basic-addon1">
                </div>
                <div class="row pl-sm-2 pr-sm-2 pl-3 pr-3">
                    <div class="col-12 col-sm-4 p-2 p-sm-3">
                        <select id="ddlBranch" class="form-select" onchange="searchFunction()">
                            <option>全部分行 All Branches</option>
                            @foreach ($branches as $branch)
                                <option> {{ $branch }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-sm-4 p-2 p-sm-3">
                        <select id="ddlLevel" class="form-select" onchange="searchFunction()">
                            <option>全部情况 All Situation</option>
                            @foreach ($levels as $level)
                                <option> {{ $level }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-sm-4 p-2 p-sm-3">
                        <select id="ddlPlace" class="form-select" onchange="searchFunction()">
                            <option>全部地点 All Place</option>
                            @foreach ($place as $place)
                                <option> {{ $place }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div id="myCard" class="container mt-3" style="background-color:white;">
                <div class="row" id="divEmergency">
                    <h1 style="text-align:center;">Emergency</h1>
                    @foreach ($feedbacks as $feedback)
                        @if ($feedback->feedback_to == 'Emergency')
                            <div class="col-sm-4 d-flex">
                                <div class="card mb-3">
                                    <section class="card-header">
                                        <img src="{{ asset('images') }}/{{ $feedback->image }}" alt=""
                                            class="img-fluid">
                                    </section>
                                    <div class="card-body">
                                        <p class="my_id">Feedback Id: {{ $feedback->id }}</p>
                                        <p>Date: {{ $feedback->createdAtDiff }}</p>
                                        <p class="my_branch">Branch: {{ $feedback->branches->name }}</p>
                                        <p>Zone:  {{ Auth::user()->language == "Chinese" ?  $feedback->zones->c_name : $feedback->zones->e_name }}</p>
                                        <p class="my_place">Place: {{ Auth::user()->language == "Chinese" ? $feedback->places->c_name : $feedback->places->e_name }}
                                        </p>
                                        <p>Category: {{ Auth::user()->language == "Chinese" ? $feedback->categories->c_name : $feedback->categories->e_name }}</p>
                                        <p>Title: {{ Auth::user()->language == "Chinese" ? $feedback->titles->c_name : $feedback->titles->e_name }}</p>
                                        <p>Description: {{ $feedback->description }}</p>
                                        <p>Report Person: {{ $feedback->users->name }}</p>
                                        <p class="my_level" style="display: none;">{{ $feedback->feedback_to }}</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="{{ route('feedback_index_comment', ['id' => $feedback->id]) }}"><button
                                                class="btn btn-main bottom-radius btn-block">Comment</button></a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
                <div class="row" id="divGeneral">
                    <h1 style="text-align:center;">General</h1>
                    @foreach ($feedbacks as $feedback)
                        @if ($feedback->feedback_to == 'General')
                            <div class="col-sm-4 d-flex">
                                <div class="card mb-3">
                                    <section class="card-header">
                                        <img src="{{ asset('images') }}/{{ $feedback->image }}" alt=""
                                            class="img-fluid">
                                    </section>
                                    <div class="card-body">
                                        <p class="my_id">Feedback Id: {{ $feedback->id }}</p>
                                        <p>Date: {{ $feedback->createdAtDiff }}</p>
                                        <p class="my_branch">Branch: {{ $feedback->branches->name }}</p>
                                        <p class="my_place">Place: {{ $feedback->places->c_name }}
                                            {{ $feedback->places->e_name }}
                                        </p>
                                        <p>Title: {{ Auth::user()->language == "Chinese" ? $feedback->titles->c_name : $feedback->titles->e_name }}</p>
                                        <p>Description: {{ $feedback->description }}</p>
                                        <p>Report Person: {{ $feedback->users->name }}</p>
                                        <p class="my_level" style="display: none;">{{ $feedback->feedback_to }}</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="{{ route('feedback_index_comment', ['id' => $feedback->id]) }}"><button
                                                class="btn btn-main bottom-radius btn-block">Comment</button></a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="row" id="divHousekeeping">
                    <h1 style="text-align:center;">Housekeeping</h1>
                    @foreach ($feedbacks as $feedback)
                        @if ($feedback->feedback_to == 'Housekeeping')
                            <div class="col-sm-4 d-flex">
                                <div class="card mb-3">
                                    <section class="card-header">
                                        <img src="{{ asset('images') }}/{{ $feedback->image }}" alt=""
                                            class="img-fluid">
                                    </section>
                                    <div class="card-body">
                                        <p class="my_id">Feedback Id: {{ $feedback->id }}</p>
                                        <p>Date: {{ $feedback->createdAtDiff }}</p>
                                        <p class="my_branch">Branch: {{ $feedback->branches->name }}</p>
                                        <p class="my_place">Place: {{ $feedback->places->c_name }}
                                            {{ $feedback->places->e_name }}
                                        </p>
                                        <p>Title: {{ $feedback->titles->c_name }} {{ $feedback->titles->e_name }}</p>
                                        <p>Description: {{ $feedback->description }}</p>
                                        <p>创建人 Created By: {{ $feedback->users->name }}</p>
                                        <p class="my_level" style="display: none;">{{ $feedback->feedback_to }}</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="{{ route('feedback_index_comment', ['id' => $feedback->id]) }}"><button
                                                class="btn btn-main bottom-radius btn-block">Comment</button></a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script>

        //declare level
        var all_levels = {!! json_encode($levels) !!};
        
        function searchFunction() {
            // get values
            var value = $('#searchKey').val().toLowerCase();
            var branch = $('#ddlBranch').val().toLowerCase();
            var level = $('#ddlLevel').val().toLowerCase();
            var place = $('#ddlPlace').val().toLowerCase();
            // start filtering items in div
            $('#myCard div').filter(function() {
                // my_place my_branch
                $(this).toggle($(this).find('.my_id').text().toLowerCase().indexOf(value) > -1 &&
                    (branch === '全部分行 all branches' ? true :
                        $(this).find('.my_branch').text().toLowerCase().indexOf(branch) > -1) &&
                    (level === '全部情况 all situation' ? true :
                        $(this).find('.my_level').text().toLowerCase().indexOf(level) > -1) &&
                    (place === '全部地点 all place' ? true :
                        $(this).find('.my_place').text().toLowerCase().indexOf(status) > -1)
                )
            });
            //hide levels if empty
            all_levels.includes("Emergency") ? '' : $('#divEmergency').hide();
            all_levels.includes("General") ? '' : $('#divGeneral').hide();
            all_levels.includes("Housekeeping") ? '' : $('#divHousekeeping').hide();
        }
        //hide levels if empty
        all_levels.includes("Emergency") ? '' : $('#divEmergency').hide();
        all_levels.includes("General") ? '' : $('#divGeneral').hide();
        all_levels.includes("Housekeeping") ? '' : $('#divHousekeeping').hide();
    </script>
@endsection
