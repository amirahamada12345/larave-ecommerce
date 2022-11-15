<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Notifications\SendEmailNotification;
use Illuminate\Http\Request;
// use Illuminate\Notifications\Notification;
use PDF;
use Notification;

class AdminController extends Controller
{
    function view_category(){
        $data=Category::all();

        return view('admin.category',compact('data'));
    }

    function add_category(Request $request){

        $data=new Category;
        $data->category_name=$request->category;
        $data->save();
        return redirect()->back()->with('message','category added sucessfully');
    }


    function delete_category($id){
        $data=Category::find($id);
        $data->delete();

        return redirect()->back()->with('message','category deleted sucessfully');
    }


    function view_product(){
       
        $category=Category::all();
        
        return view('admin.product',compact('category'));
    }


    function add_product(Request $request){

        $product=new Product();
        $product->title=$request->title;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->quantity=$request->quantity;
        $product->discount_price=$request->discount;
        $product->category=$request->category;

        $image=$request->image;
        $imagename=time().'.'.$image->getClientOriginalExtension();
         $request->image->move('product',$imagename);
         $product->image=$imagename;
         $product->save();
        return redirect()->back()->with('message','product added successfully');
    }

    public function show_product(){
     $products=Product::all();

      return view('admin.show_product',compact('products'));
    }


    public function delete_product($id){
        $product=Product::find($id);
        $product->delete();
   
         return redirect()->back()->with('message','product deleted successfully');
       }


       public function edit_product($id){//to show form
        $product=Product::find($id);
       $category=Category::all();
   
         return view('admin.edit_product',compact('product','category'));
       }

       public function update_product(Request $request,$id){
        $product=Product::find($id);
       
        $product->title=$request->title;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->discount_price=$request->discount;
        $product->category=$request->category;
        $product->quantity=$request->quantity;

        $image=$request->image;
      
        if($image){
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product',$imagename);
            $product->image=$imagename;
        }
       
         $product->save();
   
         return redirect()->back()->with('message','product updated successfully');;
       }

public function order(){

    $order=Order::all();
    return view('admin.order',compact('order'));
}


public function delivered($id){


$order=Order::find($id);
$order->delivery_status='delivered';
$order->payment_status='Paid';
$order->save();
return redirect()->back();
}


public function print_pdf($id){
    $order=Order::find($id);

$pdf=PDF::loadView('admin.pdf',compact('order'));


return $pdf->download('order_details.pdf');

}

public function send_email($id){

    $order=Order::find($id);

return view('admin.email_info',compact('order'));

}

public function send_user_email(Request $request,$id){

$order=Order::find($id);
$details=[
    'greeting'=>$request->greeting,
    'firstline'=>$request->firstline,
    'body'=>$request->body,
    'button'=>$request->button,
    'url'=>$request->url,
    'lastline'=>$request->lastline,

];
Notification::send($order ,new SendEmailNotification($details));
return redirect()->back();

}

public function searchdata(Request $request){
$searchtext=$request->search;
//multi condition or 
$order=Order::where('name','LIKE',"%$searchtext%")->OrWhere('price','LIKE',"%$searchtext%")->OrWhere('delivery_status','LIKE',"%$searchtext%")->get();

return view('admin.order',compact('order'));
}

}
