@extends('backend.layouts.app')
	
	@section('style')
	<style type="text/css">
		
	</style>
	@endsection
@section('content')

  <ul class="breadcrumb">
            <li><a href="">Order Food</a></li>
            <li><a href="">Edit Order Food</a></li>
        </ul>
        
        <div class="page-title">                    
            <h2><span class="fa fa-arrow-circle-o-left"></span> Edit Order Food</h2>
        </div>

         <div class="page-content-wrap">
            <div class="row">
                <div class="col-md-12">
                    {{-- Section Start --}}

                     <form class="form-horizontal" method="post" action="{{ url('admin/order_food/edit/'.$getrecord->id) }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> Edit Order Food</h3>
                                </div>
                                <div class="panel-body">
                                
                                
                                  <div class="form-group">
                                      <label class="col-md-2 col-xs-12 control-label">Hotel Name <span style="color:red"> *</span></label>
                                        <div class="col-md-8 col-xs-12">
                                            <div class="">
                                               <select class="form-control" name="hotel_id"> 
                                                @foreach($gethotel as $val)
                                                   <option {{ ( $val->id == $getrecord->hotel_id) ? 'selected' : '' }} value="{{ $val->id }}">{{ $val->hotel_name }}</option>
                                                @endforeach
                                               </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Food Menu Name <span style="color:red"> *</span></label>
                                        <div class="col-md-8 col-xs-12">
                                            <div class="">
                                               <select class="form-control" name="food_menu_id">
                                                   @foreach($getfoodmenu as $vals)
                                                    <option {{ ($vals->id == $getrecord->food_menu_id) ? 'selected' : '' }} value="{{ $vals->id }}">{{ $vals->food_menu_name }}</option>
                                                   @endforeach
                                               </select>
                                            </div>
                                        </div>
                                    </div>


                                 {{--     <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Food Image <span style="color:red"> *</span></label>
                                        <div class="col-md-8 col-xs-12">
                                            <div class="">
                                              <input name="order_food_image" type="file" class="form-control" />
                                              @if(!empty($getrecord->order_food_image))
                                                <img src="{{ url('upload/food/'.$getrecord->order_food_image) }}" style="height:100px;">
                                              @endif
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Food Name <span style="color:red"> *</span></label>
                                        <div class="col-md-8 col-xs-12">
                                            <div class="">
                                                <input name="order_food_name" value="{{ old('order_food_name', $getrecord->order_food_name) }}" placeholder="Food Name" type="text" required class="form-control" />
                                                <span style="color:red">{{  $errors->first('order_food_name') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Food Category Name <span style="color:red"> *</span></label>
                                        <div class="col-md-8 col-xs-12">
                                            <div class="">
                                                <input name="order_category_name" value="{{ old('order_category_name', $getrecord->order_category_name) }}" placeholder="Food Category Name" type="text" required class="form-control" />
                                                <span style="color:red">{{  $errors->first('order_category_name') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Price <span style="color:red"> *</span></label>
                                        <div class="col-md-8 col-xs-12">
                                            <div class="">
                                                <input name="price" value="{{ old('price', $getrecord->price) }}" placeholder="Price" type="number" required class="form-control" />
                                                <span style="color:red">{{  $errors->first('price') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    
                                </div>
                                <div class="panel-footer">
                                    <button class="btn btn-primary pull-right">Submit</button>
                                </div>
                            </div>
                        </form>

                    {{-- Section End --}}
                </div>
            </div>
        </div>

@endsection
  @section('script')
  <script type="text/javascript">
   
  </script>
@endsection

