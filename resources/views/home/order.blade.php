<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
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
        
        .image-size{
           width: 100px;
        }
        
        
              </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
      @include('home.header')
      <div>
        <table class="table center" style="border: 2px solid rgb(0, 195, 255);background-color:black">
            <thead   >
              <tr>
                <th  style="background-color: rgb(97, 232, 250) " scope="col">Product Title</th>
                <th  style="background-color: rgb(97, 232, 250)"scope="col">  Product Quantity</th>
                <th style="background-color: rgb(97, 232, 250)"scope="col">Price</th>
                <th style="background-color: rgb(97, 232, 250)" scope="col">Payment status</th>
                <th style="background-color: rgb(97, 232, 250)"scope="col">Delivery Status</th>
                <th style="background-color: rgb(97, 232, 250)" scope="col">Image</th>
                <th style="background-color: rgb(97, 232, 250)" scope="col">Cancel Order</th>

                                     
              </tr>
            </thead>
            <tbody>
              
             @foreach($order as $order)
              <tr>
                
                <td class="text-white" style="text-align: center">{{ $order->product_title}}</td>
                
                <td class="text-white"style="text-align: center" >{{ $order->quantity}}</td>
              
                <td class="text-white" style="text-align: center">${{ $order->price}}</td>
                <td class="text-white" style="text-align: center">${{ $order->payment_status}}</td>
                <td class="text-white" style="text-align: center">{{ $order->delivery_status}}</td>
          
                <td style="text-align: center"><img src="/product/{{ $order->image}}" style="text-align:center;" class="image-size"></td>
                
               <td>
                @if($order->delivery_status=='processing')
                <a onclick="return confirm('are you sure to cancel this order')" href="{{url('cancel_order',$order->id)}}" class="btn btn-danger"> Cancel Order</a>
              @else
              <p style="color: blue">not allowed</p>
            @endif
            </td>
    
              </tr>
    
             @endforeach 
           
            </tbody>
          </table>
      </div>
         <!-- end header section -->
         <!-- slider section -->
         
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