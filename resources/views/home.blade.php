@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">欢迎 Welcome</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{-- {{ __('You are logged in!') }} --}}
                        <div class="grid_rows">
                            <div class="grid_rows grid_columns">
                                <a class="btn btn-main btn-lg" href="{{ route('feedback_add_view') }}">
                                    <b>新反馈 Add New Feedback</b>
                                </a>
                            </div>
                            <div class="grid_rows grid_columns">
                                <a class="btn btn-main btn-lg" href="{{ route('my_feedback') }}">
                                    <b>我的反馈 My Feedback</b>
                                </a>
                            </div>
                        </div>
                        <div class="grid_rows">
                            <div class="grid_columns">
                                <a class="btn btn-main btn-lg" href="{{ route('feedback_index') }}"><b>查看全部 All Feedback</b>
                                </a>
                            </div>
                            <div class="grid_columns">
                                <a class="btn btn-main btn-lg" href="{{ route('logout.perform') }}"><b>退出 Logout</b>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

