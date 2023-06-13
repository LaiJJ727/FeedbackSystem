@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10 mt-sm-5">
                <div class="table-responsive">
                    <div class="p-2">
                        <form action="{{ route('report_search') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-12 col-sm-3">
                                    <label for="startDate">开始日期 From Date</label>
                                    <input class="form-control" id="startDate" name="startDate" type="date"
                                        value="{{ isset($startDate) ? $startDate : '' }}">
                                </div>
                                <div class="col-12 col-sm-3">
                                    <label for="endDate">结束日期 To Date</label>
                                    <input class="form-control" id="endDate" name="endDate" type="date"
                                        value="{{ isset($endDate) ? $endDate : '' }}">
                                </div>
                                <div class="col-12 col-sm-3">
                                    <br>
                                    <button class="btn btn-main" style="margin-top: 8px;" type="submit"
                                        id="button-addon2">搜索 Search</button>
                                    <a class="btn btn-main"style="margin-top: 8px" onclick="downloadPdf()">下载 Download</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="myReport">
                        <section class="table_header">
                            <h1 class="table_header_body" style="font-size:30px;"><b>报告 Report</b></h1>
                        </section>
                        <section class="table_body">
                            <table class="table table-borderless shadow-sm" id="myTable">
                                <thead>
                                    <tr>
                                        {{-- 分行<br>区域<br>地方<br>类别<br>标题<br>图片<br>反馈日<br> --}}
                                        <th scope="col">分行名字 Branch Name</th>
                                        @foreach ($branches as $branch)
                                            <th scope="col">{{ $branch->name }}</th>
                                        @endforeach
                                        {{-- @foreach ($branches as $branch)
                                            <th scope="col">{{ $branch->name }}</th>
                                        @endforeach

                                        @foreach ($branches as $branch)
                                            <th scope="col">{{ $branch->name }}</th>
                                        @endforeach

                                        @foreach ($branches as $branch)
                                            <th scope="col">{{ $branch->name }}</th>
                                        @endforeach
                                        @foreach ($branches as $branch)
                                            <th scope="col">{{ $branch->name }}</th>
                                        @endforeach
                                        @foreach ($branches as $branch)
                                            <th scope="col">{{ $branch->name }}</th>
                                        @endforeach @foreach ($branches as $branch)
                                            <th scope="col">{{ $branch->name }}</th>
                                        @endforeach --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < 4; $i++)
                                        <tr>
                                            <td>
                                                @switch($i)
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
                                            </td>
                                            @foreach ($branches as $branch)
                                                <td>{{ $feedbacks->where('status', $i)->where('branch_id', $branch->id)->count() }}
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endfor

                                </tbody>
                            </table>
                        </section>
                        <section class="table_header">
                            <h1 class="table_header_body" style="font-size:30px;"><b>报告 Report</b></h1>
                        </section>
                        <section class="table_body">
                            <table class="table table-borderless shadow-sm" id="myTable">
                                <thead>
                                    <tr>
                                        {{-- 分行<br>区域<br>地方<br>类别<br>标题<br>图片<br>反馈日<br> --}}
                                        <th scope="col">Id</th>
                                        <th scope="col">分行名字<br> Branch Name</th>
                                        <th scope="col">区 <br> Zone</th>
                                        <th scope="col">地点 <br> Place</th>
                                        <th scope="col">类别 <br> Category</th>
                                        <th scope="col">标题 <br> Title</th>
                                        <th scope="col">创建人 <br> Feedback By</th>
                                        <th scope="col">日期 <br> Date</th>
                                        <th scope="col">最新状态 <br> Latest Status</th>
                                        <th scope="col">上次更新日期 <br> Last Updated Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($feedbacks as $key => $feedback)
                                        <tr>
                                            <th scope="row">{{ $feedback->id }}</th>
                                            <td>{{ $feedback->branches->name }}</td>
                                            <td>{{ $feedback->places->zones->c_name . ' ' . $feedback->places->zones->e_name }}
                                            </td>
                                            <td>{{ $feedback->places->c_name . ' ' . $feedback->places->e_name }}</td>
                                            <td>{{ $feedback->titles->categories->c_name . ' ' . $feedback->titles->categories->e_name }}
                                            </td>
                                            <td>{{ $feedback->titles->c_name . ' ' . $feedback->titles->e_name }}</td>
                                            <td>{{ $feedback->users->name }}</td>
                                            <td>{{ $feedback->created_at_diff }}</td>
                                            <td>
                                                @switch($feedback->status)
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
                                            </td>
                                            <td>{{ $feedback->update_at_diff }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </section>
                    </div>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
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

        function downloadPdf() {
            // Source HTMLElement or a string containing HTML.
            var element = document.getElementById("myReport");
            var options = {
                filename: 'myReport.pdf',
                margin: [10, 10, 10, 10],
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait'
                }
            };
            html2pdf().set(options).from(element).save();
        }
    </script>
@endsection
