@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10 mt-sm-5">
                <div class="table-responsive">
                    <label for="startDate">From Date</label>
                    <input id="startDate" type="date">
                    <label for="endDate">To Date</label>
                    <input id="endDate" type="date">
                    <section class="table_header">
                                <h1 class="table_header_body" style="font-size:30px;"><b>报告 Report</b></h1>
                                <div class="input-group table_header_body">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                                    <input type="text" class="form-control clear-border" id="searchKey"
                                        placeholder="搜索名字 Search by name" onkeyup="searchFunction()"
                                        aria-describedby="basic-addon1">
                                </div>
                    </section>
                    <section class="table_body">
                        <table class="table table-borderless shadow-sm" id="myTable">
                            <thead>
                                <tr>
                                    {{-- 分行<br>区域<br>地方<br>类别<br>标题<br>图片<br>反馈日<br> --}}
                                    <th scope="col">Id</th>
                                    <th scope="col">Branch Name</th>
                                    <th scope="col">Place Zone</th>
                                    <th scope="col">Place Name</th>
                                    <th scope="col">Place Category</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Feeback By</th>
                                    <th scope="col">Feedback Date</th>
                                    <th scope="col">Latest Status</th>
                                    <th scope="col">Last Updated By</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($feedbacks as $key => $feedback)
                                    <tr>
                                        <th scope="row">{{ $feedback->id }}</th>
                                        <td>{{ $feedback->branches->name }}</td>
                                        <td>{{ $feedback->places->zones->c_name.' '.$feedback->places->zones->e_name }}</td>
                                        <td>{{ $feedback->places->c_name.' '.$feedback->places->e_name }}</td>
                                        <td>{{ $feedback->titles->categories->c_name.' '.$feedback->titles->categories->e_name }}</td>
                                        <td>{{ $feedback->titles->c_name.' '.$feedback->titles->e_name }}</td>
                                        <td>{{ $feedback->users->name }}</td>
                                        <td>{{ $feedback->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <?php switch ($feedback->status) {
                                            case '0':
                                                echo 'New';
                                                break;
                                            
                                            default:
                                                echo 'Completed';
                                                break;
                                            } ?>
                                        </td>
                                        <td>{{ $feedback->updated_at->format('d/m/Y') }}</td>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
    <script>
        //for using bootstrap js need to use '$(document).ready(function (){' and above src to call
        $(document).ready(function() {
            //id should be unique so instead of using id it is better to use class
            $('.viewImage').click(function() {

                var image = $(this).data('id');
                $('.image').attr('src', image);
                $('#imageModal').modal('show');
            });
        });

        function searchFunction() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchKey");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
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
