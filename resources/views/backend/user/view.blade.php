@extends('backend.layouts.app')
  @section('style')
    <style type="text/css">
      
    </style>
  @endsection 
@section('content')

        <ul class="breadcrumb">
            <li><a href="">User</a></li>
            <li><a href="">View User</a></li>
        </ul>
        
        <div class="page-title">                    
            <h2><span class="fa fa-arrow-circle-o-left"></span> View User</h2>
        </div>

         <div class="page-content-wrap">
            <div class="row">
                <div class="col-md-12">

                    {{-- start --}}
                     <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
            
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              <h3 class="panel-title">View User</h3>
                           </div>
                           <div class="panel-body">
                              
                              <div class="form-group">
                                 <label class="col-md-3 control-label">
                                 User ID :
                                 </label>
                                 <div class="col-sm-5" style="margin-top: 8px;">
                                    
                                    {{ $getrecord->id }}

                                 </div>
                              </div>

                              <div class="form-group">
                                 <label class="col-md-3 control-label">
                                 First Name :
                                 </label>
                                 <div class="col-sm-5" style="margin-top: 8px;">
                                    
                                  {{ $getrecord->name }}
                                    
                                 </div>
                              </div>

                               <div class="form-group">
                                 <label class="col-md-3 control-label">
                                 Last Name :
                                 </label>
                                 <div class="col-sm-5" style="margin-top: 8px;">
                                  {{ $getrecord->lastname }}
                                 </div>
                              </div>

                                <div class="form-group">
                                 <label class="col-md-3 control-label">
                                 Email ID :
                                 </label>
                                 <div class="col-sm-5" style="margin-top: 8px;">
                                   {{ $getrecord->email }}
                                 </div>
                              </div>

                              <div class="form-group">
                                 <label class="col-md-3 control-label">
                                 Mobile Number :
                                 </label>
                                 <div class="col-sm-5" style="margin-top: 8px;">
                                   {{ $getrecord->mobile }}
                                 </div>
                              </div>
                              
                              <div class="form-group">
                                 <label class="col-md-3 control-label">
                                 User Profile :
                                 </label>
                                 <div class="col-sm-5" style="margin-top: 8px;">
                                @if(!empty($getrecord->user_profile))
                                       <img src="{{ url('upload/profile/'.$getrecord->user_profile) }}" style="height: 100px;">
                                       @endif
                                 </div>
                              </div>

                               <div class="form-group">
                                 <label class="col-md-3 control-label">
                                 Address :
                                 </label>
                                 <div class="col-sm-5" style="margin-top: 8px;">
                                   {{ $getrecord->address }}
                                 </div>
                              </div>

                               <div class="form-group">
                                 <label class="col-md-3 control-label">
                                 City :
                                 </label>
                                 <div class="col-sm-5" style="margin-top: 8px;">
                                   {{ $getrecord->city }}
                                 </div>
                              </div>

                              <div class="form-group">
                                 <label class="col-md-3 control-label">
                                 State :
                                 </label>
                                 <div class="col-sm-5" style="margin-top: 8px;">
                                   {{ $getrecord->state }}
                                 </div>
                              </div>

                              <div class="form-group">
                                 <label class="col-md-3 control-label">
                                 Country :
                                 </label>
                                 <div class="col-sm-5" style="margin-top: 8px;">
                                   {{ $getrecord->country }}
                                 </div>
                              </div>

                              <div class="form-group">
                                 <label class="col-md-3 control-label">
                                 Postcode :
                                 </label>
                                 <div class="col-sm-5" style="margin-top: 8px;">
                                   {{ $getrecord->postcode }}
                                 </div>
                              </div>

                           </div>
                           <div class="panel-footer">
                              <a class="btn btn-primary pull-right" href="{{ url('admin/user') }}">Back</a>
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



