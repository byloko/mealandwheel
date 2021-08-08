{{-- Section Start --}}
 
    
 <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
    {{ csrf_field() }}

        <div class="panel-body">
        
            <div class="form-group">
            <label class="col-md-2 col-xs-12 control-label">Food Menu Name<span style="color:red"> *</span></label>
                <div class="col-md-8 col-xs-12">
                    <div class="">
                        <input name="food_menu_name" value="{{ old('food_menu_name', !empty($getrecord) ? $getrecord->food_menu_name : '') }}" placeholder="Food Menu Name" type="text" required class="form-control" />
                        <span style="color:red">{{  $errors->first('food_menu_name') }}</span>
                    </div>
                </div>
            </div>

        </div>
        <div class="panel-footer">
            <button class="btn btn-primary pull-right">Submit</button>
        </div>
   </form>
  

{{-- Section End --}}