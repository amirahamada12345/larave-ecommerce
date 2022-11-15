<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <base href="/public">
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
      <style class="text/css">
.center{
    margin:200px;
    
}
.image_size{
   width: 150px;
}


      </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
      @include('home.header')


      @if(session()->has('message'))
      <div class="alert alert-success">
     <button  type="button" class="close" data-dismiss="alert" aria-hidden="true"> x </button>

        {{session()->get('message')}}
      </div>
      @endif
        
       

<div class="center">
    <table class="table  " style="border: 2px solid rgb(0, 195, 255); background-color:black">
        <thead   >
          <tr>
            <th  style="font-size: 20px; background-color: rgb(97, 232, 250) " scope="col">Product Title</th>
            <th  style="font-size: 20px; background-color: rgb(97, 232, 250)"scope="col">  Product Quantity</th>
            <th style="font-size: 20px; background-color: rgb(97, 232, 250)"scope="col">Price</th>
            <th style="font-size: 20px; background-color: rgb(97, 232, 250)"scope="col">Image</th>
            <th style="font-size: 20px; background-color: rgb(97, 232, 250)" scope="col">Action</th>
                                 
          </tr>
        </thead>
        <tbody>
           <?php
            $totalprice=0;
            
            ?>
        @foreach($cart as $cart)
          <tr>
            
            <td class="text-white" style="text-align: center">{{ $cart->product_title}}</td>
            
            <td class="text-white"style="text-align: center" >{{ $cart->quantity}}</td>
          
            <td class="text-white" style="text-align: center">${{ $cart->price}}</td>
      
            <td style="text-align: center"><img src="/product/{{ $cart->image}}" style="text-align:center" class="image_size" alt=""></td>
            
            <td class="text-white" style="text-align: center"><a  onclick="return confirm('are you sure to remove this product')" class="btn btn-danger" href="{{url('remove_cart',$cart->id)}}">Remove Product</a></td>

          </tr>

          <?php
          $totalprice=$totalprice+$cart->price;
          
          ?>
         @endforeach 
      
        </tbody>
      </table>
      <div class="m-4">
        <h1>Total Price: ${{$totalprice}}</h1> 
      </div>
      <div>
         <h1 class="m-3">Proceed to Order</h1>
         <a    href="{{url('cash_order')}}" class="btn btn-danger "> Cash On Delivery</a>
         <a   href="{{url('stripe',$totalprice)}}" class="btn btn-danger "> Pay using Card </a>
      </div>


</div>




      
     
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>