@extends('layouts.layout')

@section('content')

<body class="antialiased">
  <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
<div class="form-group" style="margin:10px;">
  <a href="{{route('show')}}" type="button" class="btn btn-primary">Back</a>
</div>
</br></br>

  <div class="container">
    <form method="POST" action="{{route('update',$MyProduct->id)}}" enctype="multipart/form-data">
       @csrf
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" name="name" value="{{$MyProduct->Name}}" placeholder="Enter Products Name">
      </div>
      <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" class="form-control" name="price" value="{{$MyProduct->Price}}" placeholder="Enter Products Price">
      </div>
      <div class="form-group">
        <label for="Category">Category:</label>
        <select class="browser-default custom-select form-control" name="Category">
          {{-- <option selected disabled>Plese Choose Product Category</option> --}}
          <option value="Electric {{$MyProduct->Category == 'Electric' ? 'selected' : ''}}">Electric</option>
          <option value="Education {{$MyProduct->Category == 'Education' ? 'selected' : ''}}">Education</option>
          <option value="Clothing {{$MyProduct->Category == 'Clothing'  ? 'selected' : ''}}">Clothing</option>
        </select>
     </div>
     <div class="form-group">
      <label>Quantity:</label>
        <select class="browser-default custom-select form-control" name="quantity" value="">
          {{-- <option selected disabled>Plese Choose Product Quantity</option> --}}
          <option value="1 {{$MyProduct->quantity == 1  ? 'selected' : ''}}">1</option>
          <option value="2 {{$MyProduct->quantity == 2  ? 'selected' : ''}}">2</option>
          <option value="3 {{$MyProduct->quantity == 3  ? 'selected' : ''}}">3</option>
        </select>
    </div>

    <div class="form-group">
      <label for="Image">Choose a Product Image:</label>
       <input type="file" class="form-control-file" id="Image" name="image" accept="image/png, image/jpeg">
     </div>
    
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>

@endsection
