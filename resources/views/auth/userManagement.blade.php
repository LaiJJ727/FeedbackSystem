@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10 mt-sm-5">
                <div class="table-responsive">
                    <section class="table_header">
                        <h1 class="table_header_body" colspan="7"
                            style="font-size:30px;  border-bottom: 2px solid white !important;" scope="col">
                            <b>用户列表 User List</b>
                        </h1>
                        <div class="input-group table_header_body">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                            </div>
                            <input type="text" class="form-control clear-border" id="searchKey"
                                placeholder="搜索名字 Search by name" onkeyup="searchFunction()"
                                aria-describedby="basic-addon1">
                        </div>

                    </section>
                    <section class="table_body">
                        <table class="table  table-borderless shadow-sm" id="myTable">
                            <thead>

                                <tr>
                                    <th>#</th>
                                    <th>用户名 Username</th>
                                    <th>名字 Name</th>
                                    <th>电子邮箱 Email</th>
                                    <th>语言 Language</th>
                                    <th>分行 Branch</th>
                                    <th>操作 Operates</th>
                                    <th>简介 Profile</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    {{-- already ban user account --}}
                                    <tr>
                                        <th>{{ $key + 1 }}</th>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->language }}</td>
                                        <td>{{ $user->branches->name }}</td>
                                        @if (str_contains($user->role, 'ban'))
                                            <td><a href="{{ route('reactivateUser', ['id' => $user->id]) }}"
                                                    class="btn btn-success btn-xs"
                                                    onClick="return confirm('Are you sure to reactivate?')">Reactivate</a>
                                            </td>
                                            <td><a href="{{ route('profile_user_view', ['id' => $user->id]) }}"
                                                    class="btn btn-primary btn-xs">Enter</a></td>
                                        @elseif($user->role != 'Admin')
                                            <td><a href="{{ route('deactivateUser', ['id' => $user->id]) }}"
                                                    class="btn btn-danger btn-xs"
                                                    onClick="return confirm('Are you sure to deactivate?')">Deactivate</a>
                                            </td>
                                            <td><a href="{{ route('profile_user_view', ['id' => $user->id]) }}"
                                                    class="btn btn-main btn-xs">Enter</a></td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
    </div>
    <script>
        function searchFunction() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchKey");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
@endsection
