@extends('manager.layout.head')
@section('manager')
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                               
                            </div>
                        </div>
                    </div>                    
                </div>
                
                <section id="main-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                            @if(session()->has('success'))
			                    <div class="alert alert-success" id="myDIV" role="alert">
			                        <strong>{{session()->get('success')}}</strong> 
			                        <i class="fa fa-close closeicon" onclick="hide()" aria-hidden="true"></i>                                                   
			                    </div>
			                @endif

			                @if(session()->has('error'))
			                    <div class="alert alert-danger" id="myDIV" role="alert">
			                        <strong>{{session()->get('error')}}</strong> 
			                        <i class="fa fa-close closeicon" onclick="hide()" aria-hidden="true"></i>                                                  
			                    </div>
                			@endif
                                <form action="{{url('/manager/updatepassword')}}" method="post" enctype="multipart/form-data">
                                    @csrf  
                                    <div class="row">
                                        <div class=" col-sm-12 form-group">
                                            <label for="current_password"><strong>Current Password <span style='color: red'>*</span></strong></label>
                                            <input type="password" class="form-control" value="" placeholder="Enter Current Password" name="current_password">
                                            <p class="text-danger">@error('current_password') {{$message}}@enderror</p>
                                        </div>
                                        <div class=" col-sm-12 form-group">
                                            <label for="new_password"><strong>New Password</strong></label>
                                            <input type="password" class="form-control" value="" placeholder="Enter New Password" name="new_password">
                                            <p class="text-danger">@error('new_password') {{$message}}@enderror</p>
                                        </div>
                                        <div class=" col-sm-12 form-group">
                                            <label for="confirm_password"><strong>Confirm Password <span style='color: red'>*</span></strong></label>
                                            <input type="password" class="form-control" value="" placeholder="Enter Confirm Password" name="confirm_password">
                                            <p class="text-danger">@error('confirm_password') {{$message}}@enderror</p>
                                        </div>
                                    </div>                                                                  
                                    
                                                                  
                                    <div class="row padsubmit">                              
                                        <button type="submit" class="btn btn-outline-info">Update Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

@endsection

