@extends('admin.layout.head')
@section('admin')

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Managers List</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <a href="{{route('viewAddManager')}}" class="btn btn-primary">+ Add Manager</a>
                            </div>
                        </div>
                    </div>                     
                </div>

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
                
                <section id="main-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>S. No.</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Mobile</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if($get_managers){
                                                    foreach ($get_managers as $key => $get_manager) { ?>
                                                        <tr>
                                                            <td>{{$key+1}}</td>
                                                            <td>{{$get_manager->first_name}} {{$get_manager->last_name}}</td>
                                                            <td>{{$get_manager->email}}</td>
                                                            <td>{{$get_manager->mobile}}</td>
                                                            <td><a class="btn btn-info" href="{{url('admin/manager-edit/'.base64_encode($get_manager->id))}}">Edit</a>
                                                                <a class="btn btn-danger" href="{{url('admin/manager-delete/'.$get_manager->id)}}" onclick="return confirm('Are you sure you want to delete this manager?');">Delete</a>
                                                            </td>
                                                        </tr>
                                                   <?php }} ?>                                                                                      
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

@endsection

   