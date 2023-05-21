@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <br><br>
            <table class="table table-bordered" id="myTable">
                <thead>
                    <tr>
                        <th>User id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Operates</th>
                        <th>Profile</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        {{-- already ban user account --}}
                        @if (str_contains($user->role, 'ban'))
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td><a href="{{ route('reactivateUser', ['id' => $user->id]) }}" class="btn btn btn-xs"
                                        style=" background-color:grey;"
                                        onClick="return confirm('Are you sure to reactivate?')">Reactivate</a></td>
                                <td><a href="{{ route('profile_user_view', ['id' => $user->id]) }}"
                                        class="btn btn-primary btn-xs">Enter</a></td>


                            </tr>
                        @elseif($user->role == "Staff" || $user->role == "Agent" || $user->role == "Housekeep")
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td><a href="{{ route('deactivateUser', ['id' => $user->id]) }}" class="btn btn btn-xs"
                                        style=" background-color:red;"
                                        onClick="return confirm('Are you sure to deactivate?')">Deactivate</a></td>
                                <td><a href="{{ route('profile_user_view', ['id' => $user->id]) }}"
                                        class="btn btn-primary btn-xs">Enter</a></td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-sm-3"></div>
    </div>
@endsection
