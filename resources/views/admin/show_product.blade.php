<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <style class="text/css">
     .h2_font{
 text-align: center;
font-size: 35px;
padding-bottom: 40px;

    }
    .image_size{

     border-radius: 70%;
    }
    </style>
  @include('admin.css')
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

              <h2 class="h2_font ">All Products</h2>
                <table class="table" style="border: 2px solid rgb(0, 195, 255)">
                    <thead   >
                      <tr>
                        <th class="text-white" style="font-size: 20px " scope="col">Product Title</th>
                        <th class="text-white" style="font-size: 20px"  scope="col">Description</th>
                        <th  class="text-white" style="font-size: 20px"scope="col">Quantity</th>
                        <th class="text-white" style="font-size: 20px" scope="col">Category</th>
                        <th  class="text-white" style="font-size: 20px"scope="col">Price</th>
                        <th class="text-white" style="font-size: 20px" scope="col">Discount Price</th>
                        <th  class="text-white" style="font-size: 20px"scope="col">Product Image</th>
                        <th  class="text-white" style="font-size: 20px"scope="col">Delete</th>
                        <th  class="text-white" style="font-size: 20px"scope="col">Edit</th>                      
                      </tr>
                    </thead>
                    <tbody>
                   @foreach($products as $product)
                      <tr>
                        
                        <td class="text-white" style="text-align: center">{{$product->title}}</td>
                        <td class="text-white" style="text-align: center">{{$product->description}}</td>
                        <td class="text-white"style="text-align: center" >{{$product->quantity}}</td>
                        <td class="text-white" style="text-align: center">{{$product->category}}</td>
                        <td class="text-white" style="text-align: center">{{$product->price}}</td>
                        <td class="text-white" style="text-align: center">{{$product->discount_price}}</td>
                        <td style="text-align: center"><img src="/product/{{$product->image}}" style="text-align:center" class="image_size" alt=""></td>
                        
                        <td class="text-white" style="text-align: center"><a  onclick="return confirm('are you sure to delete this')" class="btn btn-danger" href="{{url('delete_product',$product->id)}}">Delete</a></td>
                        
                        <td class="text-white" style="text-align: center"><a class="btn btn-success" href="{{url('edit_product',$product->id)}}">Edit</a></td>
                      </tr>
                     @endforeach
               
                    </tbody>
                  </table>

                </div>
            </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
 @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>