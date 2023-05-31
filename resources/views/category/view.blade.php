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
                             <b>类别 Category</b>
                         </h1>
                         <div class="input-group table_header_body">
                             <div class="input-group-prepend">
                                 <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                             </div>
                             <input type="text" class="form-control clear-border" id="searchKey"
                                 placeholder="搜索中文名字 Search by chinese name" onkeyup="searchFunction()"
                                 aria-describedby="basic-addon1">
                         </div>

                     </section>
                     <section class="table_body">
                         <table class="table  table-borderless shadow-sm" id="myTable">
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>中文名称 Chinese Name</th>
                                     <th>英文名称 English Name</th>
                                     <th class="text-center" colspan="2">操作 Operate</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($categories as $key => $category)
                                     <tr>
                                         <th>{{ $key + 1 }}</th>
                                         <td>{{ $category->c_name }}</td>
                                         <td>{{ $category->e_name }}</td>
                                         <td>
                                             <a href="{{ route('category_edit', ['id' => $category->id]) }}"
                                                 class="btn btn-warning btn-xs">Edit</a>
                                         </td>
                                         @if ($category->status == 'exist')
                                             <td>
                                                 <a href="{{ route('category_deactivate', ['id' => $category->id]) }}"
                                                     class="btn btn-danger btn-xs"
                                                     onClick="return confirm('Are you sure to deactivate?')">Deactivate</a>
                                             </td>
                                     </tr>
                                 @else
                                     <td><a href="{{ route('category_reactivate', ['id' => $category->id]) }}"
                                             class="btn btn-success btn-xs"
                                             onClick="return confirm('Are you sure to reactivate?')">Reactivate</a></td>
                                     </tr>
                                 @endif
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
