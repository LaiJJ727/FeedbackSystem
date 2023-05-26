@extends('layouts.app')
@section('content')
    <div class="container col-sm-12   mt-3">
        <h3>Profile</h3>
        <form action="{{ route('profile_update') }}" method="POST" enctype="multipart/form-data">
            @CSRF
            <div class="form-group">

                <input class="form-control" type="hidden" id="id" name="id" value="{{ $profile->id }}">
                <label for="username">Username</label>
                <input class="form-control" type="text" id="username" name="username" value="{{ $profile->username }}"
                    required>
                <label for="name">Name</label>
                <input class="form-control" type="text" id="name" name="name" value="{{ $profile->name }}"
                    required>
                <label for="role">Employee Type</label>
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
                    <label for="language">Language</label>

                    <select name="language" id="language"class="form-control" required>
                        @if ($profile->language == 'Chinese')
                            <option value="Chinese" selected>Chinese</option>
                            <option value="English">English</option>
                        @else
                            <option value="Chinese">Chinese</option>
                            <option value="English" selected>English</option>
                        @endif
                    </select>

                    <label for="branch_id">Branch</label>
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
                <label for="email">Email</label>
                <input class="form-control" type="text" id="email" name="email" value="{{ $profile->email }}"
                    disabled>
                <label for="phone">Phone Number</label>
                <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror"
                    name="phone" value="{{ $profile->phone }}" required autocomplete="phone">
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        <div>
        @endsection
