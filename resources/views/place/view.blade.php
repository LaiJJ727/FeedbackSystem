 @extends('layouts.app')
 @section('content')
     <div class="row">
         <div class="col-sm-3"></div>
         <div class="col-sm-6">
             <br><br>
             @foreach ($branches as $branch)
                <h3>{{$branch->name}}</h3>
                 <table class="table table-bordered">
                     <thead>
                         <tr>
                             <th>Place id</th>
                             <td>Place name</th>
                             <td>Branch name</th>
                             <th>Operate</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($branch->places as $place)
                             @if ($place->status == 'exist')
                                 <tr>
                                     <td>{{ $place->id }}</td>
                                     <td>{{ $place->name }}</td>
                                     <td>{{ $place->branches->name }}</td>
                                     <td><a href="{{ route('place_edit', ['id' => $place->id]) }}"
                                             class="btn btn-warning btn-xs">Edit</a>
                                         <a href="{{ route('place_deactivate', ['id' => $place->id]) }}"
                                             class="btn btn-danger btn-xs"
                                             onClick="return confirm('Are you sure to deactivate?')">Deactivate</a>
                                     </td>
                                 </tr>
                             @else
                                 <tr>
                                     <td>{{ $place->id }}</td>
                                     <td>{{ $place->name }}</td>
                                     <td>{{ $place->branches->name }}</td>
                                     <td><a href="{{ route('place_reactivate', ['id' => $place->id]) }}"
                                             class="btn btn btn-xs" style=" background-color:red;"
                                             onClick="return confirm('Are you sure to reactivate?')">Reactivate</a></td>
                                 </tr>
                             @endif
                         @endforeach


                     </tbody>
                 </table>
             @endforeach
         </div>
         <div class="col-sm-3"></div>
     </div>
 @endsection
