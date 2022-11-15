<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Product;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as FacadesSession;
use Session;
use Stripe;

class HomeController extends Controller
{

    public function index()
    {

        $products = Product::paginate(2);
        $comment=Comment::orderby('id','desc')->get();
        $reply=Reply::all();
        return view('home.userpage', compact('products','comment','reply'));
    }

    public function redirect()
    {

        $usertype = Auth::user()->usertype;
        if ($usertype == '1') {

            $total_product=Product::all()->count();
            $total_order=Order::all()->count();
            $total_user=User::all()->count();
            $order=Order::all();
            $total_revenue=0;
            foreach($order as $order ){

                $total_revenue=$total_revenue+$order->price;
            } 
            //how many older delivered so we use count 
            $total_delivered= Order::where('delivery_status','=','delivered')->get()->count();
            $total_processing= Order::where('delivery_status','=','processing')->get()->count();
            return view('admin.home',compact('total_product','total_order','total_user','total_revenue','total_delivered','total_processing'));
        } else {


            $products = Product::paginate(2);
            $comment=Comment::orderby('id','desc')->get();
            $reply=Reply::all();

            return view('home.userpage', compact('products','comment','reply'));
        }
    }


    public function product_details($id)
    {
        $product = Product::find($id);
        return view('home.product_details', compact('product'));
    }


    public function add_cart(Request $request, $id)
    {
        if (Auth::id()) {
            $user = Auth::user();
            $userid=  $user->id;
            $product = Product::find($id);

            $product_esxit_id=Cart::where('product_id','=',$id)->where('user_id','=',$userid)->get('id')->first();

if($product_esxit_id){
    $cart=Cart::find($product_esxit_id)->first();
    $quantity=$cart->quantity;
    $cart->quantity=$quantity+$request->quantity;

    if ($product->discount_price != null) {
        $cart->price = $product->discount_price * $request->quantity;
    } 
    else {
        $cart->price = $product->price * $request->quantity;
    }

    $cart->save();
    return redirect()->back();

}
else{


    $cart = new Cart();
    //from user table
    $cart->name = $user->name;
    $cart->email = $user->email;
    $cart->phone = $user->phone;
    $cart->address = $user->address;
    $cart->user_id = $user->id;
    //from product table
    $cart->product_title = $product->title;


    if ($product->discount_price != null) {
        $cart->price = $product->discount_price * $request->quantity;
    } 
    else {
        $cart->price = $product->price * $request->quantity;
    }

    $cart->image = $product->image;
    $cart->product_id = $product->id;

    // because we get value from url 
    $cart->quantity = $request->quantity;

    $cart->save();
    return redirect()->back();

}

            $cart = new Cart();
            //from user table
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;
            //from product table
            $cart->product_title = $product->title;
            if ($product->discount_price != null) {
                $cart->price = $product->discount_price * $request->quantity;
            } else {
                $cart->price = $product->price * $request->quantity;
            }

            $cart->image = $product->image;
            $cart->product_id = $product->id;

            // because we get value from url 
            $cart->quantity = $request->quantity;

            $cart->save();
            return redirect()->back();
        } 
        
        else {

            return redirect('login');
        }
    }


    public function show_cart()
    {
        if(Auth::id()){

            $id = Auth::user()->id;
            $cart = Cart::where('user_id', '=', $id)->get();
    
            return view('home.showCart', compact('cart'));
        }

        else{

            return redirect('login');
        }
        
    }

    public function remove_cart($id){

        $cart=Cart::find($id);
        $cart->delete();
        return redirect()->back();
    }


public function cash_order(){

$user=Auth::user();//get all user data
$userid=$user->id;
$data=Cart::where('user_id','=',$userid)->get();
foreach($data as $data){

    $order=new Order();
    $order->name=$data->name;
    $order->email=$data->email;
    $order->phone=$data->phone;
    $order->address=$data->address;
    $order->user_id=$data->user_id;

    $order->product_title=$data->product_title;
    $order->price=$data->price;
    $order->quantity=$data->quantity;
    $order->image=$data->image;
    $order->product_id=$data->product_id;
   //two col in order table
   $order->payment_status='cash on delivery';
   $order->delivery_status='processing';
   $order->save();

   //to remove data from cart when store it in order table
   $cart_id=$data->id;
   $cart=Cart::find($cart_id);
   $cart->delete();

}
return redirect()->back()->with('message','your order recived successsfully we will connect with you soon');

}


public function stripe($totalprice){

    return view('home.stripe',compact('totalprice'));
}


public function stripePost(Request $request,$totalprice)
{
    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    Stripe\Charge::create ([
            "amount" =>$totalprice* 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "thanks for payment." 
    ]);

    $user=Auth::user();//get all user data
$userid=$user->id;
$data=Cart::where('user_id','=',$userid)->get();
foreach($data as $data){

    $order=new Order();
    $order->name=$data->name;
    $order->email=$data->email;
    $order->phone=$data->phone;
    $order->address=$data->address;
    $order->user_id=$data->user_id;

    $order->product_title=$data->product_title;
    $order->price=$data->price;
    $order->quantity=$data->quantity;
    $order->image=$data->image;
    $order->product_id=$data->product_id;
   //two col in order table
   $order->payment_status='Paid';
   $order->delivery_status='processing';
   $order->save();

   //to remove data from cart when store it in order table
   $cart_id=$data->id;
   $cart=Cart::find($cart_id);
   $cart->delete();

}
  
Session::flash('success', 'Payment successful!');
          
    return back();
}

public function show_order(){
if(Auth::id()){
    $user=Auth::user();
    $userid=$user->id;
    $order=Order::where('user_id','=', $userid)->get();

    return view('home.order',compact('order'));
}

else{

    return redirect('login');
}

}


public function canecl_order($id){

    $order=Order::find($id);
    $order->delivery_status='you canceled the order';
    $order->save();
    return redirect()->back();

}
public function add_comment(Request $request){
    if(Auth::id()){

        $comment=new Comment();
        $comment->name=Auth::user()->name;
        $comment->user_id=Auth::user()->id;
        $comment->comment=$request->comment;

         $comment->save();

         return redirect()->back();
    }

    else{

        return redirect('login');
    }


}

public function add_reply(Request $request){

if(Auth::id()){
$reply=new Reply();
$reply->name=Auth::user()->name;
$reply->user_id=Auth::user()->id;
$reply->comment_id=$request->commentId;
$reply->reply=$request->reply;
     
 $reply->save();
         return redirect()->back();
    }

    else{

        return redirect('login');
    }


}


 public function product_search(Request $request){

    $comment=Comment::orderby('id','desc')->get();
    $reply=Reply::all();

    $search_text=$request->search;
    $products=Product::where('title','LIKE',"%$search_text%")->orWhere('category','LIKE',"%$search_text%")->paginate(2);
     return view('home.userpage',compact('products','comment','reply'));

 }

   

public function product(){

    $products = Product::paginate(2);
    $comment=Comment::orderby('id','desc')->get();
    $reply=Reply::all();
    return view('home.all_product',compact('products','comment','reply'));
}




public function search_product(Request $request){
    {
        $comment=Comment::orderby('id', 'desc')->get();
        $reply=Reply::all();

        $search_text=$request->search;
        $products=Product::where('title', 'LIKE', "%$search_text%")->orWhere('category', 'LIKE', "%$search_text%")->paginate(2);
        return view('home.all_product', compact('products', 'comment', 'reply'));
    }
}
    






}
        