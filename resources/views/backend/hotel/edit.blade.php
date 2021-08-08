@extends('backend.layouts.app')
	
	@section('style')
	<style type="text/css">
		
	</style>
	@endsection
@section('content')

  <ul class="breadcrumb">
            <li><a href="">Hotel</a></li>
            <li><a href="">Edit Hotel</a></li>
        </ul>
        
        <div class="page-title">                    
            <h2><span class="fa fa-arrow-circle-o-left"></span> Edit Hotel</h2>
        </div>

         <div class="page-content-wrap">
            <div class="row">
                <div class="col-md-12">
                    {{-- Section Start --}}

                     <form class="form-horizontal" method="post" action="{{ url('admin/hotel/edit/'.$getrecord->id) }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> Edit Hotel</h3>
                                </div>
                                <div class="panel-body">
                                
                                
                                  <div class="form-group">
                                      <label class="col-md-2 col-xs-12 control-label">Hotel Name <span style="color:red"> *</span></label>
                                        <div class="col-md-8 col-xs-12">
                                            <div class="">
                                                <input name="hotel_name" value="{{ old('hotel_name', $getrecord->hotel_name) }}" placeholder="Hotel Name" type="text" required class="form-control" />
                                                <span style="color:red">{{  $errors->first('hotel_name') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Food Image <span style="color:red"> *</span></label>
                                        <div class="col-md-8 col-xs-12">
                                            <div class="">
                                              <input name="hotel_image" type="file" class="form-control" />
                                              @if(!empty($getrecord->hotel_image))
                                                <img src="{{ url('upload/hotel/'.$getrecord->hotel_image) }}" style="height:100px;">
                                              @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="col-md-2 col-xs-12 control-label">Hotel Description <span style="color:red"> *</span></label>
                                        <div class="col-md-8 col-xs-12">
                                            <div class="">
                                                <input name="hotel_description" value="{{ old('hotel_description', $getrecord->hotel_description) }}" placeholder="Hotel Description" type="text" required class="form-control" />
                                                <span style="color:red">{{  $errors->first('hotel_description') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Food Menu Name <span style="color:red"> *</span></label>
                                        <div class="col-md-8 col-xs-12">
                                            <div class="">
                                               <select class="form-control" name="food_menu_id[]" required="" multiple="">
                                               

                                            @foreach($getfoodmenu as $value)

                                             @php
                                               $selected = '';
                                               @endphp
                                               @if(!empty($getrecord))
                                               @foreach($getHotelFoodMenuOption as $options)
                                                   @if($options->food_menu_id == $value->id)
                                                   @php
                                                   $selected = 'selected';
                                                   @endphp
                                                   @endif
                                               @endforeach
                                               @endif

                                            <option {{ $selected }} value="{{ $value->id }}">{{ $value->food_menu_name }}</option>
                                            @endforeach


                                               </select>
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

