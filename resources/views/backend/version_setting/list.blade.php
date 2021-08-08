@extends('backend.layouts.app')
  @section('style')
    <style type="text/css">
      
    </style>
  @endsection 
@section('content')

        <ul class="breadcrumb">
            <li><a href="">Version Setting</a></li>
            <li><a href="">Version Setting Update</a></li>
        </ul>
        
        <div class="page-title">                    
            <h2><span class="fa fa-arrow-circle-o-left"></span> Version Setting Update</h2>
        </div>

         <div class="page-content-wrap">
            <div class="row">
                <div class="col-md-12">

                		@include('message')
                	{{-- Section Start --}}
                <form class="form-horizontal" method="post" action="{{ url('admin/version_setting/add') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"> Update Version Setting</h3>
                        </div>
                        <div class="panel-body">
                        
                          <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">App Version<span style="color:red"> *</span></label>
                                <div class="col-md-8 col-xs-12">
                                    <div class="">
                                        <input name="app_version" value="{{ $getrecord->app_version }}" placeholder="App Version" type="text" required class="form-control" />
                                        <span style="color:red">{{  $errors->first('app_version') }}</span>
                                    </div>
                                </div>
                          </div>
        
                        </div>
                        <div class="panel-footer">
                            <button class="btn btn-primary pull-right">Update</button>
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
