<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->

        @include('layouts.css')
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
    </head>
    {{-- <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
      <div class="form-group" style="margin:10px;">
        <a href="{{route('show')}}" type="button" class="btn btn-primary">Back</a>
      </div>
</br></br>

        <div class="container">
          <form method="POST" action="product_submit">
            {{ @csrf_field() }}
            <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" class="form-control" id="name" placeholder="Enter Products Name" name="name">
            </div>
            <div class="form-group">
              <label for="price">Price:</label>
              <input type="number" class="form-control" id="price" placeholder="Enter Products Price" name="price">
            </div>
            <div class="form-group">
              <label for="Category">Category:</label>
              <select class="browser-default custom-select form-control">
                <option selected disabled>Plese Choose Product Category</option>
                <option value="Electric">Electric</option>
                <option value="Education">Education</option>
                <option value="Clothing">Clothing</option>
              </select>
           </div>
           <div class="form-group">
            <label for="quantity">Quantity:</label>
              <select class="browser-default custom-select form-control">
                <option selected disabled>Plese Choose Product Quantity</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
              </select>
          </div>

          <div class="form-group">
            <label for="Image">Choose a Product Image:</label>
             <input type="file" class="form-control-file" id="Image" name="image" accept="image/png, image/jpeg">
           </div>
          
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div> --}}
        @section('content')
        
        @show
           
        </div>
        @include('layouts.js')
    </body>  
</html>

        