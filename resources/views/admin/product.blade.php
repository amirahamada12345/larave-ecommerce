<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
  @include('admin.css')

  <style type="text/css">

    .div_center{

        text-align: center;
        padding-top: 40px;
    }
    .h2_font{

font-size: 40px;
padding-bottom: 40px;

    }
   
</style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      <!-- partial:partials/_navbar.html -->
      @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">

                @if(session()->has('message'))
              <div class="alert alert-success">
             <button  type="button" class="close" data-dismiss="alert" aria-hidden="true"> x </button>

                {{session()->get('message')}}
              </div>
              @endif
<div class='div_center'>
    <h2 class="h2_font"> Add Product</h2>
<form action="{{url('/add_product')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label  class="form-label">Product Title</label>
        <input type="text" class="form-control input_color text-info b-4"  required placeholder="write product title" name="title">
      </div>

      <div class="mb-3">
        <label  class="form-label">Product Description</label>
        <input type="text" class="form-control input_color text-info b-4" required  placeholder="write product description" name="description">
      </div>
      <div class="mb-3">
        <label  class="form-label">Product Price</label>
        <input type="number" class="form-control input_color text-info b-4"  required placeholder="write product price" name="price">
      </div>

      <div class="mb-3">
        <label  class="form-label">Discount Price</label>
        <input type="number" class="form-control input_color text-info b-4"   placeholder="write product discount" name="discount">
      </div>

      <div class="mb-3">
        <label  class="form-label">Product Quantity</label>
        <input type="number" min="0" class="form-control input_color text-info b-4"  required placeholder="write product quantity" name="quantity">
      </div>
     
      <div class="mb-3">
        <label  class="form-label">Product Category</label>
        <select class="form-select text-info" aria-label="Default select example" required name="category">
            <option selected>Add acategory here</option>
            @foreach($category as $category)
            <option value="{{$category->category_name}}">{{$category->category_name}}</option>
            @endforeach
          </select>
      </div>

      <div class="mb-3">
        <label  class="form-label">Product Image</label>
        <input type="file" class="form-control input_color text-info "  required placeholder="choose product image" name="image">
      </div>


      <div class="mb-3">
        <input type="submit" name="submit"  value="Add Product"  class="btn btn-primary">
      </div>
    </form>
  </div>

            </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
 @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>