@extends('manager.layout.head')
@section('manager')

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
                                <form action="{{route('addRoom')}}" method="post" enctype="multipart/form-data">
                                    @csrf  
                                    <div class="row">
                                        <div class=" col-sm-4 form-group">
                                            <label for="room_number"><strong>Room Number <span style='color: red'>*</span></strong></label>
                                            <input type="text" class="form-control" value="{{old('room_number')}}" placeholder="Enter room number" name="room_number">
                                            <p class="text-danger">@error('room_number') {{$message}}@enderror</p>
                                        </div>                                        
                                    </div>                                                                  
                                    <div class="row">                                       
                                        <div class=" col-sm-6 form-group">
                                            <label for="date"><strong>Date <span style='color: red'>*</span></strong></label>
                                            <input type="date" class="form-control" placeholder="Select" name="date">
                                            <p class="text-danger">@error('date') {{$message}}@enderror</p>
                                        </div>                                       
                                    </div>
                                    <div class="row">
                                        <div class=" col-sm-6 form-group">
                                            <label for="amount"><strong>Amount <span style='color: red'>*</span></strong></label>
                                            <input type="text" class="form-control" value="{{old('amount')}}" placeholder="Enter amount" onkeypress="return isNumberKey(event)" name="amount">
                                            <p class="text-danger">@error('amount') {{$message}}@enderror</p>
                                        </div>                                              
                                    </div>                                 
                                    <div class="row padsubmit">                              
                                        <button type="submit" class="btn btn-outline-info">Add Room</button>
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

   