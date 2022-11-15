<section class="product_section layout_padding">
    <div class="container">
       <div class="heading_container heading_center">
        
           <div>
            <form action="{{url('search_product')}}" method="get">
               @csrf

               <input type="text" style="width:500px" name="search" placeholder="search for something">
               <input type="submit" name="" value="search">
            </form>
          </div> 

       </div>

       
       @if(session()->has('message'))
       <div class="alert alert-success">
      <button  type="button" class="close" data-dismiss="alert" aria-hidden="true"> x </button>

         {{session()->get('message')}}
       </div>
       @endif
       <div class="row">
          @foreach($products as $product)
          <div class="col-sm-6 col-md-4 col-lg-4">
             <div class="box">
                <div class="option_container">
                   <div class="options">
                      <a href="{{url('product_details',$product->id)}}" class="option1">
                     Product Details
                      </a>

                     <form action="{{url('add_cart',$product->id)}}" method="post">
                        @csrf
                        <div class="row">

                         <div class="col-md-4  mb-3 ">
               
                           <input type="number" class=" input_color text-info" style="width:100px"  min="1" name="quantity" value="1">
                         </div>

                         <div class="mb-3 col-md-4">
                        
                           <input type="submit" value=" Add to Cart " class=" text-info">
                         </div>

                        </div>
                     </form>
                     
                   </div>
                </div>
                <div class="img-box">
                   <img src="product/{{$product->image }}" alt="">
                </div>
                <div class="detail-box">
                   <h5>
                   {{$product->title}}
                   </h5>

                   @if($product->discount_price!=null)
                   <h6 style="color:red">
                     Discount price
                     <br>
                    
                     ${{$product->discount_price}}
                   </h6>


                   <h6 style="text-decoration: line-through">
                     Price
                     <br>
                     ${{$product->price}}
                   </h6>
                   @else
                   <h6>

                     Price
                     <br>
                     ${{$product->price}}
                   </h6>

                   @endif
                   
                  
                  </h6>
                  </h6>
                   </h6>
                </div>
             </div>
          </div>

          @endforeach
         {{!!$products->withQueryString()->links('pagination::bootstrap-5')!!}}
      
    </div>
 </section>