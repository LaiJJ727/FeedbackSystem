@extends('layouts.app')
@section('content')
    <div class="container col-sm-12   mt-3">
        <h3>简介 Profile</h3>
        <form action="{{ route('profile_update') }}" method="POST" enctype="multipart/form-data">
            @CSRF
            <div class="form-group">

                <input class="form-control" type="hidden" id="id" name="id" value="{{ $profile->id }}">
                <label for="username">用户名字 Username</label>
                <input class="form-control" type="text" id="username" name="username" value="{{ $profile->username }}"
                    required>
                <label for="name">名字 Name</label>
                <input class="form-control" type="text" id="name" name="name" value="{{ $profile->name }}"
                    required>
                <label for="role">员工类型 Employee Type</label>
                @if ($profile->role == 'Staff')
                    <input class="form-control" type="text" id="role" name="role" value="Staff" disabled>
                @elseif($profile->role == 'Agent')
                    <input class="form-control" type="text" id="role" name="role" value="Agent" disabled>
                @elseif($profile->role == 'Housekeep')
                    <input class="form-control" type="text" id="role" name="role" value="Housekeep" disabled>
                @else
                    <input class="form-control" type="text" id="role" name="role" value="Admin" disabled>
                @endif
                @if ($profile->role != 'Admin')
                    <label for="language">语言 Language</label>

                    <select name="language" id="language"class="form-control" required>
                        @if ($profile->language == 'Chinese')
                            <option value="Chinese" selected>中文 Chinese</option>
                            <option value="English">英文 English</option>
                        @else
                            <option value="Chinese">Chinese</option>
                            <option value="English" selected>English</option>
                        @endif
                    </select>

                    <label for="branch_id">分行 Branch</label>
                    <select name="branch_id" id="branch_id" class="form-control" required>
                        @foreach ($branches as $branch)
                            @if ($branch->id == $profile->branch_id)
                                <option value="{{ $branch->id }}" selected>{{ $branch->name }}</option>
                            @else
                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endif
                        @endforeach
                    </select>
                @endif
                <label for="email">电子邮箱 Email</label>
                <input class="form-control" type="text" id="email" name="email" value="{{ $profile->email }}"
                    disabled>
                <label for="phone">电话号码 Phone Number</label>
                <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror"
                    name="phone" value="{{ $profile->phone }}" required autocomplete="phone">
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <label for="password">密码 Password</label>
                <input class="form-control @error('password') is-invalid @enderror" type="text" id="password" name="password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <label for="confirmPassword">确认密码 Confirm Password</label>
                <input class="form-control @error('confirmPassword') is-invalid @enderror" type="text" id="confirmPassword" name="confirmPassword">
                @error('confirmPassword')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">更新 Update</button>
        </form>
        <div>
        @endsection
