@extends('admin.layout.head')
@section('admin')
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Hello, <span>Welcome {{Auth::user()->first_name}}</span></h1>
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
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>       
                                                    <th>S. No.</th>
                                                    <th>Amount</th>                                             
                                                    <th>Date</th>
                                                    <th>Action</th>                                                                                                    
                                                </tr>
                                            </thead>    
                                            <tbody>
                                                <?php if($get_data){
                                                    foreach ($get_data as $key => $data) {  ?>
                                                        <tr>
                                                            <td>{{$key+1}}</td>
                                                            <td>${{$data->total_amt}}</td>
                                                            <td>{{date('d M Y', strtotime($data->created_at))}}</td> 
                                                            <td><a class="btn btn-primary" href="{{url('/admin/history_detail')}}/<?php echo $data->id; ?>">View</a></td>                                                                                                                                                                                                                                                             
                                                        </tr>  
                                                <?php }
                                                 } ?>                                                                                                                                                                                                                                                                                      
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

   