<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <base href="/public">
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
<h1 style="text-align:center;font-size:25px">Send Email to {{$order->email}}</h1>
<form  action="{{url('send_user_email' ,$order->id)}}" method="POST">

    @csrf

    <div class="mb-3">
        <label  class="form-label">Email Greeting</label>
        <input type="text" class="form-control input_color text-info b-4"   name="greeting">
      </div>

      <div class="mb-3">
        <label  class="form-label">Email Firstline</label>
        <input type="text" class="form-control input_color text-info b-4" name="firstline">
      </div>

      <div class="mb-3">
        <label  class="form-label">Email Body</label>
        <input type="text" class="form-control input_color text-info b-4" name="body">
      </div>


      <div class="mb-3">
        <label  class="form-label">Email Button Name</label>
        <input type="text" class="form-control input_color text-info b-4" name="button">
      </div>

      <div class="mb-3">
        <label  class="form-label">Email URL</label>
        <input type="text" class="form-control input_color text-info b-4" name="url">
      </div>
      <div class="mb-3">
        <label  class="form-label">Email LastLine</label>
        <input type="text" class="form-control input_color text-info b-4" name="lastline">
      </div>

      <div class="mb-3">
        
        <input type="submit" class="form-control input_color text-info b-4 btn btn-info" value="Send Email">
      </div>

     
    </form>

            </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
 @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>