<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
  @include('admin.css')
  <style type="text/css">

    
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
<h1 class="m-4" style="text-align: center; font-size:25px;">All Orders</h1>

<div  style="padding-left:400px; padding-bottom:30px;">

  <form action="{{url('search')}}" method="get">
	@csrf
    <input type="text" class="text-info m-4  " placeholder="search" name="search">
    <input type="submit" class="text-info btn btn-outline-primary m-4 "  value="search">
  </form>

</div>


<table class="table" style="border: 1px solid rgb(0, 195, 255);  ">
    <thead>
      <tr >
        <th   style="color: white; " >Name</th>
        <th style="color: white; " >Email</th>
        {{-- <th style="color: white; " >Address</th>
        <th style="color: white; ">Phone</th>
        <th style="color:white;">Product title</th> --}}
        {{-- <th style="color: white; ">Quantity</th> --}}
        <th  style="color: white;  ">Price</th>
        <th  style="color: white; ">Payment Status</th>
        <th style="color: white; " >Delivery Status</th>
        <th style="color: white; ">Image</th>
        <th style="color: white; ">Delivered</th>
        <th style="color: white; ">Print Pdf</th>
        <th style="color: white; ">Send EmaiL</th>

     
      </tr>
    </thead>
    <tbody >
       @forelse ($order as $order)
          
      <tr>
        <td  class="text-info" style="color:white; ">{{$order->name}}</th>
        <td style="color: white; ">{{$order->email}}</td>
        {{-- <td style="color: white; ">{{$order->address}}</td>
        <td style="color: white; ">{{$order->phone}}</td>
        <td style="color: white; ">{{$order->product_title}}</td> --}}
        {{-- <td style="color: white; ">{{$order->quantity}}</td> --}}
        <td style=" color: white; ">{{$order->price}}</td>
        <td style="color: white; ">{{$order->payment_status}}</td>
        <td style="color: white; ">{{$order->delivery_status}}</td>
        <td>
            <img src="/product/{{$order->image}}" alt="">
        </td>
        <td > 
            @if($order->delivery_status=='processing')
            
            <a  href="{{url('delivered',$order->id)}}" onclick="return confirm('are you sure this produst is delivered')" class="btn btn-primary">Delivered</a>
        
            @else

            <p style="color: white; ">Delivered</p>
        @endif

        </td>

        <td>
          <a href="{{url('print_pdf',$order->id)}}" class="btn btn-success"> Pr-Pdf</a>
        </td>
      
        <td><a href="{{url('send_email',$order->id)}}" class="btn btn-info"> Send Email</a></td>
      </tr>

	  @empty
		<tr>
			<td style="text-align: center" colspan="16">
				no data found
			</td>
		</tr>
	  
     @endforelse
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