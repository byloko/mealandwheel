@extends('backend.layouts.app')
  @section('style')
    <style type="text/css">
      
    </style>
  @endsection 
@section('content')
 <ul class="breadcrumb">
            <li><a href="">Food Sub Menu</a></li>
            <li><a href="">Food Sub Menu List</a></li>
        </ul>
        
        <div class="page-title">                    
            <h2><span class="fa fa-arrow-circle-o-left"></span> Food Sub Menu List</h2>
        </div>

         <div class="page-content-wrap">
            <div class="row">
                <div class="col-md-12">

                    {{-- Search Box start --}}
                      @include('message')

                     <a href="{{ url('admin/food_sub_menu/add') }}" class="btn btn-primary" title="Add New Food Sub Menu"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold">Add New Food Sub Menu</span></a>

                      <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="panel-title">Food Sub Menu Search</h3>
                  </div>

                  <div class="panel-body" style="overflow: auto;">
                    <form action="" method="get">
                        <div class="col-md-3">
                           <label>ID</label>
                           <input type="text" value="{{ Request()->idsss }}" class="form-control" placeholder="ID" name="idsss">
                        </div>
                        <div class="col-md-3">
                           <label>Hotel Name</label>
                           <input type="text" class="form-control" value="{{ Request()->hotel_id }}" placeholder="Hotel Name" name="hotel_id">
                        </div>
                        <div class="col-md-3">
                           <label>Food Menu Name</label>
                           <input type="text" class="form-control" value="{{ Request()->food_menu_id }}" placeholder="Food Menu Name" name="food_menu_id">
                        </div>
                        
                        <div class="col-md-3">
                           <label>Food Sub Menu Name</label>
                           <input type="text" class="form-control" value="{{ Request()->food_sub_menu_name }}" placeholder="Food Sub Menu Name" name="food_sub_menu_name">
                        </div>

                        <div style="clear: both;"></div>
                        <br>
                        <div class="col-md-12">
                           <input type="submit" class="btn btn-primary" value="Search">
                           <a href="{{ url('admin/food_sub_menu') }}" class="btn btn-success">Reset</a>
                        </div>
                     </form>
                  </div>
                  </div>  
                    {{-- Search Box End --}}
                    {{-- Section Start --}}
            <div class="panel panel-default">
                  <div class="panel-heading">
                      <h3 class="panel-title">Food Sub Menu List</h3>
                  </div>
                 

              <div class="panel-body" style="overflow: auto;">
                  <table  class="table table-striped table-bordered table-hover">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>Hotel Name</th>
                              <th>Food Menu Name</th>
                              <th>Food Sub Menu Name</th>
                              <th>Food Image</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                    @forelse($getrecord as $value)
                          <tr>
                              <td>{{ $value->id }}</td>
                              <td>{{ !empty($value->getHotelName->hotel_name) ? $value->getHotelName->hotel_name : '' }}</td>
                              <td>{{ !empty($value->getFoodMenuName->food_menu_name) ? $value->getFoodMenuName->food_menu_name : '' }}</td>
                              <td>{{ $value->food_sub_menu_name }}</td>
                              <td>
                                 @if(!empty($value->food_image))
                                      <img src="{{ url('upload/food/'.$value->food_image) }}" style="height:100px;">
                                  @endif
                              </td>
                              
                              <td>
                              
                                <a href="{{ url('admin/food_sub_menu/edit/'.$value->id) }}" class="btn btn-success btn-rounded btn-sm"><span class="fa fa-pencil"></span></a>

                            {{--     <a onclick="return confirm('Are you sure you want to delete?')"  class="btn btn-danger btn-rounded btn-sm" href="{{ url('admin/food_menu/delete/'.$value->id) }}"><span class="fa fa-trash-o"></span></a>  --}}

     <button class="btn btn-danger btn-rounded btn-sm" onClick="delete_record('{{ url('admin/food_sub_menu/delete/'.$value->id) }}');"><span class="fa fa-trash-o"></span></button>


                               <!-- MESSAGE BOX-->
     
                    <!-- END MESSAGE BOX-->    


                              </td>
                          </tr>
                         @empty
                          <tr>
                              <td colspan="100%">Record not found.</td>

                          </tr>
                          @endforelse
                      </tbody>

                  </table>
                  <div style="float: right">
                        {{ $getrecord->appends(Illuminate\Support\Facades\Input::except('page'))->links() }}
                  </div>
              </div>

              </div>
                    {{-- Section End --}}

                    
                </div>
            </div>
        </div>


   


@endsection
  @section('script')
  <script type="text/javascript">
    

  </script>
@endsection
