@extends('backend.layouts.app')
	
	@section('style')
	<style type="text/css">
		
	</style>
	@endsection
@section('content')

  <ul class="breadcrumb">
            <li><a href="">Food Sub Menu</a></li>
            <li><a href="">Add Food Sub Menu</a></li>
        </ul>
        
        <div class="page-title">                    
            <h2><span class="fa fa-arrow-circle-o-left"></span> Add Food Sub Menu</h2>
        </div>

         <div class="page-content-wrap">
            <div class="row">
                <div class="col-md-12">
                    {{-- Section Start --}}
                       <form class="form-horizontal" method="post" action="{{ url('admin/food_sub_menu/add') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> Add Food Sub Menu</h3>
                                </div>
                                <div class="panel-body">

                                    <div class="form-group">
                                        <label class="col-md-2 col-xs-12 control-label">Hotel Name<span style="color:red"> *</span></label>
                                        <div class="col-md-8 col-xs-12">
                                            <div class="">
                                                <select class="form-control" name="hotel_id" required>
                                                    <option value="">Select Hotel Name</option>
                                                      @foreach($getRecordHotelName as $valu)
                                                        <option value="{{ $valu->id }}">{{ $valu->hotel_name }}</option>
                                                      @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Food Menu Name <span style="color:red"> *</span></label>
                                        <div class="col-md-8 col-xs-12">
                                            <div class="">
                                                <select class="form-control" name="food_menu_id" required>
                                                    <option value="">Select Food Menu Name</option>
                                                    @foreach($getRecordFoodMenuName as $valu)
                                                      <option value="{{ $valu->id }}">{{ $valu->food_menu_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                   

                                    <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Food Sub Menu Name <span style="color:red"> *</span></label>
                                        <div class="col-md-8 col-xs-12">
                                            <div class="">
                                                <input name="food_sub_menu_name" value="{{ old('food_sub_menu_name') }}" placeholder="Food Sub Menu Name" type="text" required class="form-control" />
                                                <span style="color:red">{{  $errors->first('food_sub_menu_name') }}</span>
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

