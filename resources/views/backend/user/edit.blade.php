@extends('backend.layouts.app')
  @section('style')
    <style type="text/css">
      
    </style>
  @endsection 
@section('content')

        <ul class="breadcrumb">
            <li><a href="">User</a></li>
            <li><a href="">Edit User</a></li>
        </ul>
        
        <div class="page-title">                    
            <h2><span class="fa fa-arrow-circle-o-left"></span> Edit User</h2>
        </div>

         <div class="page-content-wrap">
            <div class="row">
                <div class="col-md-12">
                    {{-- Section Start --}}
                    <form class="form-horizontal" method="post" action="{{ url('admin/user/edit/'.$getrecord->id) }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> Edit User</h3>
                                </div>
                                <div class="panel-body">
                                
                                    <div class="form-group">
                                     <label class="col-md-2 col-xs-12 control-label">First Name <span style="color:red"> *</span></label>
                                        <div class="col-md-8 col-xs-12">
                                            <div class="">
                                                <input name="name" value="{{ $getrecord->name }}" placeholder="First Name" type="text" required class="form-control" />
                                                <span style="color:red">{{  $errors->first('name') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="col-md-2 col-xs-12 control-label">Last Name <span style="color:red"> </span></label>
	                                    <div class="col-md-8 col-xs-12">
	                                        <div class="">
	                                            <input name="lastname" value="{{ $getrecord->lastname }}" placeholder="Last Name" type="text"  class="form-control" />
	                                            <span style="color:red">{{  $errors->first('lastname') }}</span>
	                                        </div>
	                                    </div>
                                    </div>

                                   <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Email ID<span style="color:red"> *</span></label>
                                        <div class="col-md-8 col-xs-12">
                                            <div class="">
                                                <input name="email" value="{{ $getrecord->email }}" placeholder="Email ID" type="text" readonly class="form-control" />
                                                <span style="color:red">{{  $errors->first('email') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                     <label class="col-md-2 col-xs-12 control-label">Mobile Number <span style="color:red"> *</span></label>
                                        <div class="col-md-8 col-xs-12">
                                            <div class="">
                                                <input name="mobile" maxlength="10" minlength="10" value="{{ $getrecord->mobile }}" placeholder="Mobile Number" type="text" readonly class="form-control" />
                                                <span style="color:red">{{  $errors->first('mobile') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                     <div class="form-group">
					                     <label class="col-md-2 col-xs-12 control-label">Password <span style="color:red"> </span></label>
					                     <div class="col-md-8 col-xs-12">
					                        <div class="">
					                           <input name="password" value="" placeholder="Password" type="text" class="form-control" />
					                             <span style="color:red">{{  $errors->first('password') }}</span>
					                               (Leave blank if you are not changing the password)
					                        </div>
					                     </div>
					                  </div>

					                <div class="form-group">
                                     <label class="col-md-2 col-xs-12 control-label">User Profile <span style="color:red"> </span></label>
                                        <div class="col-md-8 col-xs-12">
                                            <div class="">
                                                <input name="user_profile" type="file" class="form-control"/>
                                                  @if(!empty($getrecord->user_profile))
						                           <img src="{{ url('upload/profile/'.$getrecord->user_profile) }}" style="height: 100px;">
						                           @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Address <span style="color:red"> *</span></label>
                                        <div class="col-md-8 col-xs-12">
                                            <div class="">
                                                <input name="address" value="{{ $getrecord->address }}" placeholder="Address" type="text" required class="form-control" />
                                                <span style="color:red">{{  $errors->first('address') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">City <span style="color:red"> *</span></label>
                                        <div class="col-md-8 col-xs-12">
                                            <div class="">
                                                <input name="city" value="{{ $getrecord->city }}" placeholder="City" type="text" required class="form-control" />
                                                <span style="color:red">{{  $errors->first('city') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">State <span style="color:red"> *</span></label>
                                        <div class="col-md-8 col-xs-12">
                                            <div class="">
                                                <input name="state" value="{{ $getrecord->state }}" placeholder="State" type="text" required class="form-control" />
                                                <span style="color:red">{{  $errors->first('state') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Country <span style="color:red"> *</span></label>
                                        <div class="col-md-8 col-xs-12">
                                            <div class="">
                                                <input name="country" value="{{ $getrecord->country }}" placeholder="Country" type="text" required class="form-control" />
                                                <span style="color:red">{{  $errors->first('country') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                    <label class="col-md-2 col-xs-12 control-label">Postcode <span style="color:red"> *</span></label>
                                        <div class="col-md-8 col-xs-12">
                                            <div class="">
                                                <input name="postcode" value="{{ $getrecord->postcode }}" placeholder="Postcode" type="text" required class="form-control" />
                                                <span style="color:red">{{  $errors->first('postcode') }}</span>
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
