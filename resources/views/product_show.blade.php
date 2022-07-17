@extends('layouts.layout')

@section('content')

<body class="antialiased">
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">

        <div class="form-group" style="margin:10px;">
            <a href="{{route('create')}}" type="button" class="btn btn-primary">Add New Products</a>
        </div>
<br><br>
{{ session('msg') }}
    <table id="customers">
        <tr>
            <th>SKU</th>
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        @foreach($productarr as $data)
        <tr>
            <td>{{ $data->SKU }}</td>
            <td>{{ $data->Name }}</td>
            <td>{{ $data->Price }}</td>
            <td>{{ $data->Category }}</td>
            <td>{{ $data->Quantity }}</td>
            <td>{{ $data->Image }}</td>               
            <td>
                <a href="{{route('delete',$data->id)}}">Delete</a>
                <a href="{{route('edit',$data->id)}}">Edit</a>
            </td>
        </tr>
        @endforeach
    </table>
       
    </div>
</body>
@endsection

{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Project</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
    </head> --}}
    {{-- <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">

            <div class="form-group" style="margin:10px;">
                <a href="{{route('create')}}" type="button" class="btn btn-primary">Add New Products</a>
            </div>
<br><br>
 {{ session('msg') }}
        <table id="customers">
            <tr>
                <th>SKU</th>
                <th>Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            @foreach($productarr as $data)
            <tr>
                <td>{{ $data->SKU }}</td>
                <td>{{ $data->Name }}</td>
                <td>{{ $data->Price }}</td>
                <td>{{ $data->Category }}</td>
                <td>{{ $data->Quantity }}</td>
                <td>{{ $data->Image }}</td>               
                <td>
                    <a href="todo_delete/{{$data->id}}">Delete</a>
                    <a href="todo_edit/{{$data->id}}">Edit</a>
                </td>
            </tr>
            @endforeach
        </table>
           
        </div>
    </body> --}}
{{-- </html> --}}
