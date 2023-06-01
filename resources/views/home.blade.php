@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Welcome</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{-- {{ __('You are logged in!') }} --}}
                        <div class="grid_rows">
                            <div class="grid_rows grid_columns">
                                <a class="btn btn-primary btn-lg" href="{{ route('feedback_select_branch') }}">
                                    <b>新反馈 Add New Feedback</b>
                                </a>
                            </div>
                            <div class="grid_rows grid_columns">
                                <a class="btn btn-primary btn-lg" href="{{ route('my_feedback') }}">
                                    <b>我的反馈 My Feedback</b>
                                </a>
                            </div>
                        </div>
                        <div class="grid_rows">
                            <div class="grid_columns">
                                <a class="btn btn-primary btn-lg" href="{{ route('feedback_index') }}"><b>查看全部 All Feedback</b>
                                </a>
                            </div>
                            <div class="grid_columns">
                                <a class="btn btn-primary btn-lg" href="{{ route('logout.perform') }}"><b>退出 Logout</b>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<style>
    .grid_rows {
        display: flex;
        /* margin: 10px; */
    }

    .grid_columns {
        padding: 10px;
        width: 50%;
        display: flex;
        flex-wrap: wrap;
    }

    .grid_columns a {
        flex: 1;
        display: block;
        text-align: center;
        justify-content: center;
    }

    @media(max-width: 1000px) {
        .grid_rows {
            display: block;
        }

        .grid_columns {
            width: 100%;
        }
    }

    b {
        justify-content: center;

    }
</style>
