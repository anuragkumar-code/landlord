@extends('manager.layout.head')
@section('manager')

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
                                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>S. No.</th>
                                                    <th>Room Number</th>
                                                    <th>Payment Received Date</th>
                                                    <th>Price</th>
                                                    <th>Pay Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                                                                                                                                                        
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

   