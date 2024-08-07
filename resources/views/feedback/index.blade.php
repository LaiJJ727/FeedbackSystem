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
                        <select id="ddlStatus" class="form-select" onchange="searchFunction()">
                            <option>全部状态 All Status</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status }}">
                                    @switch($status)
                                        @case(0)
                                            新 New
                                        @break

                                        @case(1)
                                            搁置 On Hold
                                        @break

                                        @case(2)
                                            待定 Pending
                                        @break

                                        @default
                                            完成 Complete
                                    @endswitch
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div id="myCard" class="container mt-3" style="background-color:white;">
                <div class="row" id="divEmergency">
                    <h1 style="text-align:center;">紧急 Emergency</h1>
                    @foreach ($feedbacks as $feedback)
                        @if ($feedback->feedback_to == 'Emergency')
                            <div class="col-sm-4 d-flex">
                                <div class="card mb-3">
                                    <section class="card-header">
                                        <img src="{{ asset('images') }}/{{ $feedback->image }}" alt=""
                                            class="img-fluid">
                                    </section>
                                    <div class="card-body">
                                        <p class="my_id">反馈编号 Feedback Id: {{ $feedback->id }}</p>
                                        <p>日期 Date: {{ $feedback->createdAtDiff }}</p>
                                        <p class="my_branch">分行 Branch: {{ $feedback->branches->name }}</p>
                                        <p>区 Zone:
                                            {{ Auth::user()->language == 'Chinese' ? $feedback->zones->c_name : $feedback->zones->e_name }}
                                        </p>
                                        <p class="my_place">地点 Place:
                                            {{ Auth::user()->language == 'Chinese' ? $feedback->places->c_name : $feedback->places->e_name }}
                                        </p>
                                        <p>类别 Category:
                                            {{ Auth::user()->language == 'Chinese' ? $feedback->categories->c_name : $feedback->categories->e_name }}
                                        </p>
                                        <p>标题 Title:
                                            {{ Auth::user()->language == 'Chinese' ? $feedback->titles->c_name : $feedback->titles->e_name }}
                                        </p>
                                        <p class="my_status" style="display:none;">状态 Status:
                                            {{ $feedback->status }}
                                        </p>
                                        <p>状态 Status:
                                            @switch($feedback->status)
                                                @case(0)
                                                    <strong style="border: 5px; color:grey;">新 New</strong>
                                                @break

                                                @case(1)
                                                    <strong style="border: 5px; color:red;">搁置 On Hold</strong>
                                                @break

                                                @case(2)
                                                    <strong style="border: 5px; color:blue"> 待定 Pending</strong>
                                                @break

                                                @default
                                                    <strong style="border: 5px; color:green;">完成 Complete</strong>
                                            @endswitch
                                        </p>
                                        <p>描述 Description: {{ $feedback->description }}</p>
                                        <p>反馈人员 Report Person: {{ $feedback->users->name }}</p>
                                        <p class="my_level" style="display: none;">{{ $feedback->feedback_to }}</p>
                                    </div>
                                    <section class="card-footer">
                                        <a href="{{ route('feedback_index_comment', ['id' => $feedback->id]) }}"><button
                                                class="btn btn-main bottom-radius btn-block">评论 Comment</button></a>
                                    </section>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
                <div class="row" id="divGeneral">
                    <h1 style="text-align:center;">普通 General</h1>
                    @foreach ($feedbacks as $feedback)
                        @if ($feedback->feedback_to == 'General')
                            <div class="col-sm-4 d-flex">
                                <div class="card mb-3">
                                    <section class="card-header">
                                        <img src="{{ asset('images') }}/{{ $feedback->image }}" alt=""
                                            class="img-fluid">
                                    </section>
                                    <div class="card-body">
                                        <p class="my_id">反馈编号 Feedback Id: {{ $feedback->id }}</p>
                                        <p>日期 Date: {{ $feedback->createdAtDiff }}</p>
                                        <p class="my_branch">分行 Branch: {{ $feedback->branches->name }}</p>
                                        <p>区 Zone:
                                            {{ Auth::user()->language == 'Chinese' ? $feedback->zones->c_name : $feedback->zones->e_name }}
                                        </p>
                                        <p>地点 Place:
                                            {{ Auth::user()->language == 'Chinese' ? $feedback->places->c_name : $feedback->places->e_name }}
                                        </p>
                                        <p>类别 Category:
                                            {{ Auth::user()->language == 'Chinese' ? $feedback->categories->c_name : $feedback->categories->e_name }}
                                        </p>
                                        <p>标题 Title:
                                            {{ Auth::user()->language == 'Chinese' ? $feedback->titles->c_name : $feedback->titles->e_name }}
                                        </p>
                                        <p class="my_status" style="display:none;">状态 Status:
                                            {{ $feedback->status }}
                                        </p>
                                        <p>状态 Status:
                                            @switch($feedback->status)
                                                @case(0)
                                                    <strong style="border: 5px; color:grey;">新 New</strong>
                                                @break

                                                @case(1)
                                                    <strong style="border: 5px; color:red;">搁置 On Hold</strong>
                                                @break

                                                @case(2)
                                                    <strong style="border: 5px; color:blue"> 待定 Pending</strong>
                                                @break

                                                @default
                                                    <strong style="border: 5px; color:green;">完成 Complete</strong>
                                            @endswitch
                                        </p>
                                        <p>描述 Description: {{ $feedback->description }}</p>
                                        <p>反馈人员 Report Person: {{ $feedback->users->name }}</p>
                                        <p class="my_level" style="display: none;">{{ $feedback->feedback_to }}</p>
                                    </div>
                                    <section class="card-footer">
                                        <a href="{{ route('feedback_index_comment', ['id' => $feedback->id]) }}"><button
                                                class="btn btn-main bottom-radius btn-block">评论 Comment</button></a>
                                    </section>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="row" id="divHousekeeping">
                    <h1 style="text-align:center;">保洁 Housekeeping</h1>
                    @foreach ($feedbacks as $feedback)
                        @if ($feedback->feedback_to == 'Housekeeping')
                            <div class="col-sm-4 d-flex">
                                <div class="card mb-3">
                                    <section class="card-header">
                                        <img src="{{ asset('images') }}/{{ $feedback->image }}" alt=""
                                            class="img-fluid">
                                    </section>
                                    <div class="card-body">
                                        <p class="my_id">反馈编号 Feedback Id: {{ $feedback->id }}</p>
                                        <p>日期 Date: {{ $feedback->createdAtDiff }}</p>
                                        <p class="my_branch">分行 Branch: {{ $feedback->branches->name }}</p>
                                        <p>区 Zone:
                                            {{ Auth::user()->language == 'Chinese' ? $feedback->zones->c_name : $feedback->zones->e_name }}
                                        </p>
                                        <p class="my_place">地点 Place:
                                            {{ Auth::user()->language == 'Chinese' ? $feedback->places->c_name : $feedback->places->e_name }}
                                        </p>
                                        <p>类别 Category:
                                            {{ Auth::user()->language == 'Chinese' ? $feedback->categories->c_name : $feedback->categories->e_name }}
                                        </p>
                                        <p>标题 Title:
                                            {{ Auth::user()->language == 'Chinese' ? $feedback->titles->c_name : $feedback->titles->e_name }}
                                        </p>
                                        <p class="my_status" style="display:none;">状态 Status:
                                            {{ $feedback->status }}
                                        </p>
                                        <p>状态 Status:
                                            @switch($feedback->status)
                                                @case(0)
                                                    <strong style="border: 5px; color:grey;">新 New</strong>
                                                @break

                                                @case(1)
                                                    <strong style="border: 5px; color:red;">搁置 On Hold</strong>
                                                @break

                                                @case(2)
                                                    <strong style="border: 5px; color:blue"> 待定 Pending</strong>
                                                @break

                                                @default
                                                    <strong style="border: 5px; color:green;">完成 Complete</strong>
                                            @endswitch
                                        </p>
                                        <p>描述 Description: {{ $feedback->description }}</p>
                                        <p>反馈人员 Report Person: {{ $feedback->users->name }}</p>
                                        <p class="my_level" style="display: none;">{{ $feedback->feedback_to }}</p>
                                    </div>
                                    <section class="card-footer">
                                        <a href="{{ route('feedback_index_comment', ['id' => $feedback->id]) }}"><button
                                                class="btn btn-main bottom-radius btn-block">评论 Comment</button></a>
                                    </section>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #47c9a2;" sytle="text-align:center;">
                    <h3><i style="font-size: 1em;" class="fa fa-check-circle"></i> 成功 Successful</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body" style="text-align: center">
                    <p>成功添加新的反馈!
                        <br>Add New Feedback Successfully!
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script>
        @if (Session::has('openModal')) //this line works as expected
            $(document).ready(function() {
                $('#successModal').modal('show');
            });
        @endif

        //declare level
        var all_levels = {!! json_encode($levels) !!};

        function searchFunction() {
            // get values
            var value = $('#searchKey').val().toLowerCase();
            var branch = $('#ddlBranch').val().toLowerCase();
            var level = $('#ddlLevel').val().toLowerCase();
            var status = $('#ddlStatus').val().toLowerCase();
            // start filtering items in div
            $('#myCard div').filter(function() {
                // my_place my_branch
                $(this).toggle($(this).find('.my_id').text().toLowerCase().indexOf(value) > -1 &&
                    (branch === '全部分行 all branches' ? true :
                        $(this).find('.my_branch').text().toLowerCase().indexOf(branch) > -1) &&
                    (level === '全部情况 all situation' ? true :
                        $(this).find('.my_level').text().toLowerCase().indexOf(level) > -1) &&
                    (status === '全部状态 all status' ? true :
                        $(this).find('.my_status').text().toLowerCase().indexOf(status) > -1)
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
