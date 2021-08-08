@extends('backend.layouts.app')
	
	@section('style')
	<style type="text/css">
		
	</style>
	@endsection
@section('content')

<ul class="breadcrumb">
            <li><a href="">Order Food</a></li>
            <li><a href="">Order Food List</a></li>
        </ul>
        
        <div class="page-title">                    
            <h2><span class="fa fa-arrow-circle-o-left"></span> Order Food List</h2>
        </div>

         <div class="page-content-wrap">
            <div class="row">
                <div class="col-md-12">
                	{{-- Start --}}

                	 @include('message')

  <a href="{{ url('admin/order_food/add') }}" class="btn btn-primary" title="Add New Order Food"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold">Add New Order Food</span></a>
                     {{-- Section  Search --}}
             
              <div class="panel panel-default">
                  <div class="panel-heading">
                      <h3 class="panel-title">Order Food Search</h3>
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
                           <label>Food Name</label>
                           <input type="text" class="form-control" value="{{ Request()->order_food_name }}" placeholder="Food Menu Name" name="order_food_name">
                        </div>

                        

                        <div style="clear: both;"></div>
                        <br>
                        <div class="col-md-12">
                           <input type="submit" class="btn btn-primary" value="Search">
                           <a href="{{ url('admin/order_food') }}" class="btn btn-success">Reset</a>
                        </div>
                     </form>
                  </div>
               </div>  

                     {{-- Section Search End --}}

                   

                	  <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Order Food List</h3>
                        </div>
                    <div class="panel-body" style="overflow: auto;">
                        <table  class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Hotel Name</th>
                                    <th>Food Menu Name</th>
                                  {{--   <th>Food Image</th> --}}
                                    <th>Food Name</th>
                                    <th>Food Category Name</th>
                                    <th>Food Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                          @forelse($getrecord as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ !empty($value->getHotelName->hotel_name) ? $value->getHotelName->hotel_name : '' }}</td>
                                    <td>{{ !empty($value->getFoodMenuName->food_menu_name) ? $value->getFoodMenuName->food_menu_name : '' }}</td>
                                   {{--  <td>
                                     @if(!empty($value->order_food_image))
                                      <img src="{{ url('upload/food/'.$value->order_food_image) }}" style="height:100px;">
                                     @endif
                                    </td> --}}
                                    <td>{{ $value->order_food_name }}</td>
                                    <td>{{ $value->order_category_name }}</td>
                                    <td>${{ $value->price }}</td>
                                    
                                    <td>
                                    <a href="{{ url('admin/order_food/view/'.$value->id) }}" class="btn btn-primary btn-rounded btn-sm"><span class="fa fa-eye"></span></a>
                              

                                    <a href="{{ url('admin/order_food/edit/'.$value->id) }}" class="btn btn-success btn-rounded btn-sm"><span class="fa fa-pencil"></span></a>

                                   {{--    <a onclick="return confirm('Are you sure you want to delete?')"  class="btn btn-danger btn-rounded btn-sm" href="{{ url('admin/order_food/delete/'.$value->id) }}"><span class="fa fa-trash-o"></span></a>  --}}
                                   <button class="btn btn-danger btn-rounded btn-sm" onClick="delete_record('{{ url('admin/order_food/delete/'.$value->id) }}');"><span class="fa fa-trash-o"></span></button>

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

                	{{-- End --}}
                </div>
            </div>
        </div>

@endsection
  @section('script')
  <script type="text/javascript">
   
  </script>
@endsection

