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

                <div class="div_center">
                    <h2 class="h2_font"> Add Category</h2>

                    <form action="{{url('/add_category')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                          <label  class="form-label">Category Name</label>
                          <input type="text" class="form-control input_color text-info"  placeholder="write category name" name="category">
                        </div>
                      
                        
                        <input type="submit" name="submit"  value="Add Category"  class="btn btn-primary m-3">
                      </form>
                </div>


                <table class="table" style="border: 2px solid rgb(0, 195, 255)">
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Category Name</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $data)
                        
                  
                    <tr>
                      <th scope="row">{{$data->id}}</th>
                      <td>{{$data->category_name}}</td>
                      <td><a  onclick="return confirm('are you sure to delete this')" class="btn btn-danger" href="{{url('delete_category',$data ->id)}}">Deleted</a></td>
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