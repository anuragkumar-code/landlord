@extends('admin.layout.head')
@section('admin')

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Hello, <span>Welcome Here</span></h1>
                            </div>
                        </div>
                    </div>                    
                </div>
                
                <section id="main-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <form action="{{url('/admin/manager-edited')}}" method="post" enctype="multipart/form-data">
                                    @csrf  
                                    <div class="row">
                                        <div class=" col-sm-4 form-group">
                                            <label for="first_name"><strong>First Name <span style='color: red'>*</span></strong></label>
                                            <input type="text" class="form-control" value="{{$get_manager->first_name}}" placeholder="Enter first name" name="first_name">
                                            <p class="text-danger">@error('first_name') {{$message}}@enderror</p>
                                        </div>
                                        <div class=" col-sm-4 form-group">
                                            <label for="last_name"><strong>Last Name (optional)</strong></label>
                                            <input type="text" class="form-control" value="{{$get_manager->last_name}}" placeholder="Enter last name" name="last_name">
                                            <p class="text-danger">@error('last_name') {{$message}}@enderror</p>
                                        </div>
                                        <div class=" col-sm-4 form-group">
                                            <label for="email"><strong>Email <span style='color: red'>*</span></strong></label>
                                            <input type="text" class="form-control" value="{{$get_manager->email}}" placeholder="Enter manager email id" name="email" readonly>
                                            <p class="text-danger">@error('email') {{$message}}@enderror</p>
                                        </div>
                                    </div>                                                                  
                                    <div class="row">                                       
                                        <div class=" col-sm-6 form-group">
                                            <label for="password"><strong>Password <span style='color: red'>*</span></strong></label>
                                            <input type="password" class="form-control" placeholder="Enter password" id="password-field" name="password">
                                            <p class="text-danger">@error('password') {{$message}}@enderror</p>
                                        </div>
                                        <div class=" col-sm-6 form-group">
                                            <label for="confirm_password"><strong>Confirm Password <span style='color: red'>*</span></strong></label>
                                            <input type="password" class="form-control" placeholder="Enter password" id="password-field" name="confirm_password">
                                            <p class="password-instruction">Confirm password should match with password.</p>
                                            <p class="text-danger">@error('confirm_password') {{$message}}@enderror</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class=" col-sm-6 form-group">
                                            <label for="mobile"><strong>Mobile <span style='color: red'>*</span></strong></label>
                                            <input type="text" class="form-control" value="{{$get_manager->mobile}}" placeholder="Enter mobile number" onkeypress="return isNumberKey(event)" name="mobile">
                                            <p class="text-danger">@error('mobile') {{$message}}@enderror</p>
                                        </div>                                              
                                    </div>        
                                    <input type="hidden" name="id" value="{{$get_manager->id}}">                         
                                    <div class="row padsubmit">                              
                                        <button type="submit" class="btn btn-outline-info">Edit Manager</button>
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

   