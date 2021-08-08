@extends('backend.layouts.app')
	
	@section('style')
	<style type="text/css">
		
	</style>
	@endsection
@section('content')

  <ul class="breadcrumb">
            <li><a href="">Best Seller</a></li>
            <li><a href="">Add Best Seller</a></li>
        </ul>
        
        <div class="page-title">                    
            <h2><span class="fa fa-arrow-circle-o-left"></span> Add Best Seller</h2>
        </div>

         <div class="page-content-wrap">
            <div class="row">
                <div class="col-md-12">
                    {{-- Section Start --}}
                       <form class="form-horizontal" method="post" action="{{ url('admin/best_seller/add') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> Add Best Seller</h3>
                                </div>
                                <div class="panel-body">
                                
                                    <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Westway Food Name <span style="color:red"> *</span></label>
                                        <div class="col-md-8 col-xs-12">
                                            <div class="">
                                            	<select class="form-control" name="westway_food_menu_id" required>
                                            		<option value="">Select Westway Food Name</option>
                                            		@foreach($getwestwayfoodmenu as $val)
                                            		<option value="{{ $val->id }}">{{ $val->westway_food_menu_name }}</option>
                                            		@endforeach
                                            	</select>
                                            
                                                <span style="color:red">{{  $errors->first('food_name') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Food Image <span style="color:red"> *</span></label>
                                        <div class="col-md-8 col-xs-12">
                                            <div class="">
                                                <input name="food_image" type="file" required class="form-control" />
                                                <span style="color:red">{{  $errors->first('food_image') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Food Name <span style="color:red"> *</span></label>
                                        <div class="col-md-8 col-xs-12">
                                            <div class="">
                                                <input name="food_name" value="{{ old('food_name') }}" placeholder="Food Name" type="text" required class="form-control" />
                                                <span style="color:red">{{  $errors->first('food_name') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                   	 <label class="col-md-2 col-xs-12 control-label">Category Name <span style="color:red"> *</span></label>
                                        <div class="col-md-8 col-xs-12">
                                            <div class="">
                                                <input name="category_name" value="{{ old('category_name') }}" placeholder="Category Name" type="text" required class="form-control" />
                                                <span style="color:red">{{  $errors->first('category_name') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                   	 <label class="col-md-2 col-xs-12 control-label">Price <span style="color:red"> *</span></label>
                                        <div class="col-md-8 col-xs-12">
                                            <div class="">
                                                <input name="price" value="{{ old('price') }}" placeholder="Price" type="number" required class="form-control" />
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

