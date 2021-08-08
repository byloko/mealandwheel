@extends('backend.layouts.app')
	
	@section('style')
	<style type="text/css">
		
	</style>
	@endsection
@section('content')

<ul class="breadcrumb">
            <li><a href="">Hotel</a></li>
            <li><a href="">Hotel List</a></li>
        </ul>
        
        <div class="page-title">                    
            <h2><span class="fa fa-arrow-circle-o-left"></span> Hotel List</h2>
        </div>

         <div class="page-content-wrap">
            <div class="row">
                <div class="col-md-12">
                	{{-- Start --}}

                	 @include('message')

  <a href="{{ url('admin/hotel/add') }}" class="btn btn-primary" title="Add New Best Seller"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold">Add New Hotel</span></a>
                     {{-- Section  Search --}}
             
              <div class="panel panel-default">
                  <div class="panel-heading">
                      <h3 class="panel-title">Hotel Search</h3>
                  </div>

                  <div class="panel-body" style="overflow: auto;">
                    <form action="" method="get">
                        <div class="col-md-2">
                           <label>ID</label>
                           <input type="text" value="{{ Request()->idsss }}" class="form-control" placeholder="ID" name="idsss">
                        </div>
                        <div class="col-md-3">
                           <label>Hotel Name</label>
                           <input type="text" class="form-control" value="{{ Request()->hotel_name }}" placeholder="Hotel Name" name="hotel_name">
                        </div>
                        <div style="clear: both;"></div>
                        <br>
                        <div class="col-md-12">
                           <input type="submit" class="btn btn-primary" value="Search">
                           <a href="{{ url('admin/hotel') }}" class="btn btn-success">Reset</a>
                        </div>
                     </form>
                  </div>
               </div>  

                     {{-- Section Search End --}}

                   

                	  <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Hotel List</h3>
                        </div>
                    <div class="panel-body" style="overflow: auto;">
                        <table  class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Hotel Name</th>
                                    <th>Hotel Image</th>
                                    <th>Hotel Description</th>
                                    <th>Hotel Food Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                          @forelse($getrecord as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                       <td>{{ $value->hotel_name }}</td>
                                    <td>
                                     @if(!empty($value->hotel_image))
                                      <img src="{{ url('upload/hotel/'.$value->hotel_image) }}" style="height:100px;">
                                     @endif
                                    </td>

                                    <td>{{ $value->hotel_description }}</td>
                                  <td>
                                      
                                 @foreach($value->getuserRestaurant as $res)
                                        {{ $res->getTag->food_menu_name }}<br />
                                 @endforeach
                                  </td>
                                    
                                    <td>
                               
                                    <a href="{{ url('admin/hotel/edit/'.$value->id) }}" class="btn btn-success btn-rounded btn-sm"><span class="fa fa-pencil"></span></a>

                                   {{--    <a onclick="return confirm('Are you sure you want to delete?')"  class="btn btn-danger btn-rounded btn-sm" href="{{ url('admin/best_seller/delete/'.$value->id) }}"><span class="fa fa-trash-o"></span></a>  --}}
                                   <button class="btn btn-danger btn-rounded btn-sm" onClick="delete_record('{{ url('admin/hotel/delete/'.$value->id) }}');"><span class="fa fa-trash-o"></span></button>

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

