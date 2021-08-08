@extends('backend.layouts.app')
  @section('style')
    <style type="text/css">
      
    </style>
  @endsection 
@section('content')

        <ul class="breadcrumb">
            <li><a href="">Order Food</a></li>
            <li><a href="">View Order Food</a></li>
        </ul>
        
        <div class="page-title">                    
            <h2><span class="fa fa-arrow-circle-o-left"></span> View Order Food</h2>
        </div>

         <div class="page-content-wrap">
            <div class="row">
                <div class="col-md-12">

                    {{-- start --}}
                     <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
            
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              <h3 class="panel-title">View Order Food</h3>
                           </div>
                           <div class="panel-body">
                              
                              <div class="form-group">
                                 <label class="col-md-3 control-label">
                                 Order Food ID :
                                 </label>
                                 <div class="col-sm-5" style="margin-top: 8px;">
                                    
                                    {{ $getrecord->id }}

                                 </div>
                              </div>

                              <div class="form-group">
                                 <label class="col-md-3 control-label">
                                 Hotel Name :
                                 </label>
                                 <div class="col-sm-5" style="margin-top: 8px;">
                                    
                                  {{ !empty($getrecord->getHotelName->hotel_name) ? $getrecord->getHotelName->hotel_name : '' }}
                                    
                                 </div>
                              </div>

                               <div class="form-group">
                                 <label class="col-md-3 control-label">
                                 Food Menu Name :
                                 </label>
                                 <div class="col-sm-5" style="margin-top: 8px;">
                                 {{ !empty($getrecord->getFoodMenuName->food_menu_name) ? $getrecord->getFoodMenuName->food_menu_name : '' }}
                                 </div>
                              </div>
{{-- 
                                <div class="form-group">
                                 <label class="col-md-3 control-label">
                                 Food Image :
                                 </label>
                                 <div class="col-sm-5" style="margin-top: 8px;">
                                   @if(!empty($getrecord->order_food_image))
                                      <img src="{{ url('upload/food/'.$getrecord->order_food_image) }}" style="height:100px;">
                                     @endif
                                 </div>
                              </div> --}}

                              <div class="form-group">
                                 <label class="col-md-3 control-label">
                                 Food Name :
                                 </label>
                                 <div class="col-sm-5" style="margin-top: 8px;">
                                   {{ $getrecord->order_food_name }}
                                 </div>
                              </div>
                              
                            

                               <div class="form-group">
                                 <label class="col-md-3 control-label">
                                 Food Category Name :
                                 </label>
                                 <div class="col-sm-5" style="margin-top: 8px;">
                                   {{ $getrecord->order_category_name }}
                                 </div>
                              </div>

                               <div class="form-group">
                                 <label class="col-md-3 control-label">
                                 Food Price :
                                 </label>
                                 <div class="col-sm-5" style="margin-top: 8px;">
                                   ${{ $getrecord->price }}
                                 </div>
                              </div>

                             

                           </div>
                           <div class="panel-footer">
                              <a class="btn btn-primary pull-right" href="{{ url('admin/order_food') }}">Back</a>
                           </div>
                        </div>
                   </form>
                    {{-- End --}}
                    
                </div>
            </div>
        </div>
 
@endsection
  @section('script')
  <script type="text/javascript">
   
  </script>
@endsection



