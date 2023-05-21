 @extends('layouts.app')
 @section('content')
     <div class="row">
         <div class="col-sm-3"></div>
         <div class="col-sm-6">
             <br><br>

             <table class="table table-bordered">
                 <thead>
                     <tr>
                         <th>Title id</th>
                         <td>Title name</th>
                         <th>Operate</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($titles as $title)
                         @if ($title->status == 'exist')
                             <tr>
                                 <td>{{ $title->id }}</td>
                                 <td>{{ $title->name }}</td>
                                 <td><a href="{{ route('title_edit', ['id' => $title->id]) }}"
                                         class="btn btn-warning btn-xs">Edit</a>
                                     <a href="{{ route('title_deactivate', ['id' => $title->id]) }}"
                                         class="btn btn-danger btn-xs"
                                         onClick="return confirm('Are you sure to deactivate?')">Deactivate</a>
                                 </td>
                             </tr>
                         @else
                             <tr>
                                 <td>{{ $title->id }}</td>
                                 <td>{{ $title->name }}</td>
                                 <td><a href="{{ route('title_reactivate', ['id' => $title->id]) }}" class="btn btn btn-xs"
                                         style=" background-color:red;"
                                         onClick="return confirm('Are you sure to reactivate?')">Reactivate</a></td>
                             </tr>
                         @endif
                     @endforeach


                 </tbody>
             </table>
         </div>
         <div class="col-sm-3"></div>
     </div>
 @endsection
